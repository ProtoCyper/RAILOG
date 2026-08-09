<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\BarangModel;
use App\Models\LaporanModel;
use App\Models\NotifikasiModel;
use CodeIgniter\HTTP\ResponseInterface;
use Endroid\QrCode\QrCode;
use Dompdf\Dompdf;
use Dompdf\Options;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use App\Models\LogAktivitasModel;

class UserController extends BaseController
{
    protected $userModel,
        $barangModel,
        $laporanModel,
        $logAktivitasModel,
        $notifikasiModel;

    public function __construct()
    {
        $this->userModel = new UserModel;
        $this->barangModel = new BarangModel;
        $this->laporanModel = new LaporanModel;
        $this->logAktivitasModel = new LogAktivitasModel;
        $this->notifikasiModel = new NotifikasiModel;
    }

    public function index()
    {
        $dataUser = session()->get('id_user');
        $user = $this->userModel->find($dataUser);

        $totalMasuk = $this->laporanModel->where('jenis', 'Masuk')->countAllResults();
        $totalDipakai = $this->laporanModel->where('jenis', 'Dipakai')->countAllResults();
        $totalBarang = $this->barangModel->selectSum('jumlah')->get()->getRow()->jumlah;
        $barangMinimum = $this->barangModel->where('jumlah <= minimum_stok')->countAllResults();

        $laporanData = $this->laporanModel
            ->select('laporan.tanggal, barang.nama_barang, laporan.jenis, laporan.jumlah')
            ->join('barang', 'barang.id_barang = laporan.id_barang')
            ->orderBy('laporan.tanggal', 'DESC')
            ->limit(10)
            ->findAll();
        $data = [
            'title' => 'Dashboard User - CargoWing',
            'currentPage' => 'dashboard',
            'totalMasuk' => $totalMasuk,
            'totalDipakai' => $totalDipakai,
            'totalBarang' => $totalBarang,
            'barangMinimum' => $barangMinimum,
            'laporanData' => $laporanData,
            'user' => $user,
            'notif' => $this->notifikasiModel->getUnreadNotif(5)
        ];

        return view('user/dashboard', $data);
    }

    public function kelolaBarang()
    {
        $dataUser = session()->get('id_user');
        $user     = $this->userModel->find($dataUser);

        // Ambil jumlah per halaman (default 10)
        $perPage  = $this->request->getVar('per_page') ?? 10;
        // Ambil keyword pencarian
        $keyword  = $this->request->getVar('keyword');

        // Query ke tabel barang
        $barangQuery = $this->barangModel;

        if (!empty($keyword)) {
            $barangQuery = $barangQuery->groupStart()
                ->like('nama_barang', $keyword)
                ->orLike('jumlah', $keyword)
                ->orLike('satuan', $keyword)
                ->orLike('barcode', $keyword)
                ->groupEnd();
        }

        // Ambil data barang dengan pagination
        $barangList = $barangQuery
            ->orderBy('barang.id_barang', 'ASC')->orderBy('nama_barang', 'ASC')
            ->paginate($perPage, 'number');

        $uniqueBarang = $this->barangModel
            ->select('id_barang, nama_barang, jumlah, satuan')
            ->orderBy('nama_barang', 'ASC')
            ->findAll();

        $data = [
            'title'      => 'Kelola Barang User - CargoWing',
            'currentPage' => 'kelolabarang',
            'user'       => $user,
            'keyword'    => $keyword,
            'perPage'    => $perPage,
            'barangList' => $barangList,
            'uniqueBarang' => $uniqueBarang,
            'pager'      => $this->barangModel->pager, // Pastikan pager diambil dari model
            'notif' => $this->notifikasiModel->getUnreadNotif(5)
        ];

        return view('user/kelola_barang', $data);
    }

    public function simpanBarang()
    {
        $data = [
            'nama_barang'   => $this->request->getPost('nama_barang'),
            'jumlah'        => $this->request->getPost('jumlah'),
            'satuan'        => $this->request->getPost('satuan'),
            'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
            'barcode'       => $this->request->getPost('barcode'),
            'minimum_stok'  => $this->request->getPost('minimum_stok'),
        ];

        $this->barangModel->insert($data);
        // Notifikasi jika stok awal berada di bawah/== minimum
        if ((int)$data['jumlah'] <= (int)$data['minimum_stok']) {
            $this->notifikasiModel->save([
                'pesan'  => "Stok {$data['nama_barang']} tersisa {$data['jumlah']} (minimum: {$data['minimum_stok']})⚠️",
                'status' => 'unread'
            ]);
        }
        return redirect()->back()->with('success', 'Barang berhasil disimpan!');
    }


    public function updateBarang($id_barang)
    {
        $data = [
            'nama_barang'   => $this->request->getPost('nama_barang'),
            'jumlah'        => $this->request->getPost('jumlah'),
            'satuan'        => $this->request->getPost('satuan'),
            'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
            'barcode'       => $this->request->getPost('barcode'),
            'minimum_stok'  => $this->request->getPost('minimum_stok'),
        ];

        // Validasi sederhana
        foreach ($data as $key => $value) {
            if ($value === null || $value === '') {
                return redirect()->back()->withInput()->with('error', 'Field ' . $key . ' wajib diisi.');
            }
        }

        // Ambil data lama dari DB
        $barangLama = $this->barangModel->find($id_barang);
        if (!$barangLama) {
            return redirect()->back()->with('error', 'Barang tidak ditemukan.');
        }

        // Cek apakah ada perubahan
        $tidakBerubah = true;
        foreach ($data as $key => $value) {
            if ($barangLama[$key] != $value) {
                $tidakBerubah = false;
                break;
            }
        }

        if ($tidakBerubah) {
            return redirect()->back()->with('error', 'Tidak ada perubahan data.');
        }

        // Update data
        if ($this->barangModel->update($id_barang, $data)) {
            // ✅ Tambahin notif stok minimum di sini
            if ($data['jumlah'] <= $data['minimum_stok']) {
                $this->notifikasiModel->save([
                    'pesan'  => "Stok {$data['nama_barang']} tersisa {$data['jumlah']} (minimum: {$data['minimum_stok']})⚠️",
                    'status' => 'unread'
                ]);
            }

            // ✅ Log aktivitas perubahan data barang dengan rincian field yang berubah
            $changes = [];
            foreach ($data as $key => $value) {
                if (isset($barangLama[$key]) && $barangLama[$key] != $value) {
                    $changes[] = "$key: '{$barangLama[$key]}' -> '{$value}'";
                }
            }
            $detailPerubahan = empty($changes) ? 'Tidak ada field yang berubah.' : implode(', ', $changes);
            logAktivitas("Memperbarui barang: {$barangLama['nama_barang']} (ID: {$id_barang}) Perubahan: $detailPerubahan");

            return redirect()->back()->with('success', 'Barang berhasil diperbarui.');
        } else {
            $error = $this->barangModel->errors();
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui barang. ' . json_encode($error));
        }
    }

    public function hapusBarang($id)
    {
        // Ambil data barang sebelum dihapus untuk log
        $barang = $this->barangModel->find($id);
        if (!$barang) {
            return redirect()->back()->with('error', 'Barang tidak ditemukan.');
        }

        $this->barangModel->delete($id);

        // ✅ Log aktivitas penghapusan
        logAktivitas("Menghapus barang: {$barang['nama_barang']} (ID: {$id}, Jumlah: {$barang['jumlah']} {$barang['satuan']})");

        return redirect()->back()->with('success', 'Barang berhasil dihapus.');
    }

    public function scanBarcode($barcode)
    {
        // Cari barang berdasarkan barcode
        $barang = $this->barangModel->where('barcode', $barcode)->first();

        if (!$barang) {
            return redirect()->back()->with('error', 'Barang tidak ditemukan.');
        }

        // Tampilkan halaman informasi barang
        return view('user/informasi_barang', [
            'barang' => $barang
        ]);
    }


    public function informasiBarang($barcode)
    {
        // ambil barang berdasarkan barcode
        $barang = $this->barangModel->where('barcode', $barcode)->first();
        if (!$barang) {
            return redirect()->back()->with('error', 'Barang dengan barcode tersebut tidak ditemukan.');
        }

        $dataUser = session()->get('id_user');
        $user = $this->userModel->find($dataUser);

        $data = [
            'title' => 'Informasi Barang - CargoWing',
            'currentPage' => 'kelolabarang',
            'user' => $user,
            'barang' => $barang
        ];

        return view('informasi_barang', $data);
    }

    public function downloadBarcode($id)
    {
        $barang = $this->barangModel->find($id);
        if (!$barang) {
            return redirect()->back()->with('error', 'Barang tidak ditemukan.');
        }

        // Data untuk QR mengarah ke fungsi generate PDF
        $urlPDF = base_url('barang/info/' . $barang['barcode']);
        $fileName = 'barcode_' . preg_replace('/[^A-Za-z0-9_\-]/', '_', $barang['nama_barang']) . '.png';

        $result = Builder::create()
            ->writer(new PngWriter())
            ->data($urlPDF)
            ->size(300)
            ->margin(10)
            ->build();

        // Ambil isi biner dari QR
        $imageData = $result->getString();

        // Simpan sementara ke file tmp
        $tempFile = WRITEPATH . 'uploads/' . $fileName;
        file_put_contents($tempFile, $imageData);

        // Kembalikan file untuk diunduh
        return $this->response->download($tempFile, null)->setFileName($fileName);
    }

    public function previewSuratJalan($id)
    {
        $barang = $this->barangModel->find($id);

        if (!$barang || empty($barang['surat_jalan'])) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Surat jalan tidak ditemukan');
        }

        $filePath = FCPATH . 'uploads/surat_jalan/' . $barang['surat_jalan'];

        if (!is_file($filePath)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('File surat jalan tidak ditemukan');
        }

        $ext = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));

        // Determine MIME type
        $mime = 'application/octet-stream';
        switch ($ext) {
            case 'pdf':
                $mime = 'application/pdf';
                break;
            case 'jpg':
            case 'jpeg':
                $mime = 'image/jpeg';
                break;
            case 'png':
                $mime = 'image/png';
                break;
            case 'gif':
                $mime = 'image/gif';
                break;
            case 'webp':
                $mime = 'image/webp';
                break;
            default:
                if (function_exists('mime_content_type')) {
                    $detected = @mime_content_type($filePath);
                    if ($detected) {
                        $mime = $detected;
                    }
                }
                break;
        }

        $contents = file_get_contents($filePath);

        return $this->response
            ->setHeader('Content-Type', $mime)
            ->setHeader('Content-Disposition', 'inline; filename="' . basename($filePath) . '"')
            ->setHeader('X-Content-Type-Options', 'nosniff')
            ->setHeader('Cache-Control', 'private, max-age=3600')
            ->setBody($contents);
    }

    public function pdf($barcode)
    {
        $barang = $this->barangModel->where('barcode', $barcode)->first();
        if (!$barang) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Barang tidak ditemukan');
        }

        // Buat HTML untuk PDF
        $html = view('barang/pdf_template', ['barang' => $barang]);

        // Setup Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $fileName = 'Detail_' . preg_replace('/[^A-Za-z0-9_\-]/', '_', $barang['nama_barang']) . '.pdf';
        $dompdf->stream($fileName, ["Attachment" => true]);
    }

    public function riwayat()
    {
        $dataUser = session()->get('id_user');
        $user     = $this->userModel->find($dataUser);

        // Ambil jumlah per halaman (default 10)
        $perPage  = $this->request->getVar('per_page') ?? 10;
        // Ambil keyword pencarian
        $keyword  = $this->request->getVar('keyword');
        // Jenis laporan & filter
        $type     = strtolower($this->request->getVar('type') ?? 'semua');
        $day      = $this->request->getVar('day');       // YYYY-MM-DD
        $week     = $this->request->getVar('week');      // YYYY-Www
        $monthVal = $this->request->getVar('month');     // YYYY-MM

        // Query dasar untuk riwayat
        $riwayatQuery = $this->laporanModel
            ->select('laporan.tanggal, laporan.jumlah, laporan.jenis, users.nama, barang.nama_barang, laporan.id_laporan')
            ->join('users', 'users.id_user = laporan.id_user')
            ->join('barang', 'barang.id_barang = laporan.id_barang');

        // Filter pencarian kalau ada keyword
        if (!empty($keyword)) {
            $riwayatQuery->groupStart()
                ->like('barang.nama_barang', $keyword)
                ->orLike('users.nama', $keyword)
                ->orLike('laporan.jenis', $keyword)
                ->groupEnd();
        }

        // Filter berdasarkan jenis (harian/mingguan/bulanan)
        switch ($type) {
            case 'harian':
                if (!empty($day)) {
                    $riwayatQuery->where('DATE(laporan.tanggal)', $day);
                }
                break;
            case 'mingguan':
                if (!empty($week)) {
                    // Expect format YYYY-Www
                    try {
                        [$y, $w] = explode('-W', $week);
                        $y = (int)$y;
                        $w = (int)$w;
                        $start = new \DateTime();
                        $start->setISODate($y, $w); // Monday of that ISO week
                        $startStr = $start->format('Y-m-d 00:00:00');
                        $end = clone $start;
                        $end->modify('+6 days');
                        $endStr = $end->format('Y-m-d 23:59:59');
                        $riwayatQuery->where('laporan.tanggal >=', $startStr)
                            ->where('laporan.tanggal <=', $endStr);
                    } catch (\Throwable $e) {
                        // Ignore invalid week format
                    }
                }
                break;
            case 'bulanan':
                if (!empty($monthVal)) {
                    // format YYYY-MM
                    $parts = explode('-', $monthVal);
                    if (count($parts) === 2) {
                        $yr = (int)$parts[0];
                        $mo = (int)$parts[1];
                        $riwayatQuery->where('YEAR(laporan.tanggal)', $yr)
                            ->where('MONTH(laporan.tanggal)', $mo);
                    }
                }
                break;
            case 'semua':
            default:
                // no date filter
                break;
        }

        // Ambil data riwayat dengan pagination
        $riwayatData = $riwayatQuery
            ->orderBy('laporan.tanggal', 'ASC')
            ->paginate($perPage, 'number');

        // Ambil semua nama barang unik langsung dari tabel barang
        $uniqueBarang = $this->barangModel
            ->select('nama_barang')
            ->distinct()
            ->orderBy('nama_barang', 'ASC')
            ->findAll();

        $data = [
            'title'        => 'Riwayat - CargoWing',
            'currentPage'  => 'riwayat',
            'user'         => $user,
            'riwayatData'  => $riwayatData,
            'pager'        => $this->laporanModel->pager,
            'perPage'      => $perPage,
            'keyword'      => $keyword,
            // kirim kembali filter agar UI bisa persist
            'type'         => $type,
            'day'          => $day,
            'week'         => $week,
            'month'        => $monthVal,
            'uniqueBarang' => $uniqueBarang,
            'notif' => $this->notifikasiModel->getUnreadNotif(5)
        ];

        return view('user/riwayat', $data);
    }

    // Proses input barang masuk
    public function simpanBarangMasuk()
    {
        $db = \Config\Database::connect();

        $data = [
            'nama_barang'   => $this->request->getPost('nama_barang'),
            'jumlah'        => $this->request->getPost('jumlah'),
            'satuan'        => $this->request->getPost('satuan'),
            'tanggal_masuk' => $this->request->getPost('tanggal_masuk'),
            'barcode'       => $this->request->getPost('barcode'),
            'minimum_stok'  => $this->request->getPost('minimum_stok'),
        ];

        // Validasi field kosong
        foreach ($data as $key => $value) {
            if (empty($value)) {
                return redirect()->back()->with('error', ucfirst(str_replace('_', ' ', $key)) . ' wajib diisi');
            }
        }

        // Ambil dan proses file upload (surat jalan & gambar barang) - referensi dari simpanBarangMasukExisting
        $suratJalanFile   = $this->request->getFile('surat_jalan');
        $gambarBarangFile = $this->request->getFile('gambar_barang');

        $suratJalanName = null;
        $gambarBarangName = null;

        if ($suratJalanFile && $suratJalanFile->isValid() && !$suratJalanFile->hasMoved()) {
            $suratJalanName = $suratJalanFile->getRandomName();
            $suratJalanFile->move(FCPATH . 'uploads/surat_jalan', $suratJalanName);
        }

        if ($gambarBarangFile && $gambarBarangFile->isValid() && !$gambarBarangFile->hasMoved()) {
            $gambarBarangName = $gambarBarangFile->getRandomName();
            $gambarBarangFile->move(FCPATH . 'uploads/gambar_barang', $gambarBarangName);
        }

        // Tambahkan nama file ke data jika ada
        if ($suratJalanName) {
            $data['surat_jalan'] = $suratJalanName;
        }
        if ($gambarBarangName) {
            $data['gambar'] = $gambarBarangName;
        }

        // Simpan barang + catat riwayat dalam transaction
        $db->transStart();

        $insertId = $this->barangModel->insert($data);
        if (!$insertId) {
            $db->transRollback();
            return redirect()->back()->with('error', 'Gagal menyimpan barang.');
        }

        // Siapkan data riwayat (laporan)
        $nowTime = date('H:i:s');
        $tanggalFull = $data['tanggal_masuk'] . ' ' . $nowTime;

        $riwayat = [
            'id_barang'  => $insertId,
            'jumlah'     => $data['jumlah'],
            'jenis'      => 'Masuk',
            'tanggal'    => $tanggalFull,
            'id_user'    => session()->get('id_user') ?? null,
            'keterangan' => 'Barang masuk (penambahan awal)'
        ];

        $this->laporanModel->insert($riwayat);

        // ✅ Tambahkan log aktivitas
        logAktivitas("Menambahkan barang baru: {$data['nama_barang']} (Jumlah: {$data['jumlah']} {$data['satuan']})");
        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', 'Gagal menyimpan transaksi. Coba lagi.');
        }

        // Notifikasi jika stok awal berada di bawah/== minimum
        if ((int)$data['jumlah'] <= (int)$data['minimum_stok']) {
            $this->notifikasiModel->save([
                'pesan'  => "Stok {$data['nama_barang']} tersisa {$data['jumlah']} (minimum: {$data['minimum_stok']})⚠️",
                'status' => 'unread'
            ]);
        }

        return redirect()->to('user/kelola_barang')->with('success', 'Barang berhasil disimpan dan dicatat di riwayat');
    }

    public function simpanBarangMasukExisting()
    {
        $db = \Config\Database::connect();

        $idBarang = $this->request->getPost('id_barang');
        $jumlahMasuk = $this->request->getPost('jumlah');
        $tanggalMasuk = $this->request->getPost('tanggal_masuk');
        $suratJalanFile = $this->request->getFile('surat_jalan');
        $gambarBarangFile = $this->request->getFile('gambar_barang');

        $suratJalanName = null;
        $gambarBarangName = null;

        if ($suratJalanFile && $suratJalanFile->isValid() && !$suratJalanFile->hasMoved()) {
            $suratJalanName = $suratJalanFile->getRandomName();
            $suratJalanFile->move(FCPATH . 'uploads/surat_jalan', $suratJalanName);
        }

        if ($gambarBarangFile && $gambarBarangFile->isValid() && !$gambarBarangFile->hasMoved()) {
            $gambarBarangName = $gambarBarangFile->getRandomName();
            $gambarBarangFile->move(FCPATH . 'uploads/gambar_barang', $gambarBarangName);
        }

        // validasi input
        if (empty($idBarang) || empty($jumlahMasuk) || empty($tanggalMasuk)) {
            return redirect()->back()->with('error', 'Data tidak lengkap');
        }

        // Ambil data barang yang sudah ada
        $barang = $this->barangModel->find($idBarang);
        if (!$barang) {
            return redirect()->back()->with('error', 'Barang tidak ditemukan');
        }

        // Mulai transaksi
        $db->transStart();

        // Update stok barang (tambahkan jumlah masuk ke stok yang ada)
        $stokBaru = $barang['jumlah'] + $jumlahMasuk;
        $updateData = [
            'jumlah' => $stokBaru,
            'tanggal_masuk' => $tanggalMasuk
        ];

        if ($suratJalanName) $updateData['surat_jalan'] = $suratJalanName;
        if ($gambarBarangName) $updateData['gambar'] = $gambarBarangName;

        $this->barangModel->update($idBarang, $updateData);

        // Catat di riwayat (laporan)
        $nowTime = date('H:i:s');
        $tanggalFull = $tanggalMasuk . ' ' . $nowTime;

        $riwayat = [
            'id_barang'  => $idBarang,
            'jumlah'     => $jumlahMasuk,
            'jenis'      => 'Masuk',
            'tanggal'    => $tanggalFull,
            'id_user'    => session()->get('id_user') ?? null,
            'keterangan' => 'Penambahan stok barang'
        ];

        $this->laporanModel->insert($riwayat);

        // Log aktivitas
        logAktivitas("Menambahkan stok barang: {$barang['nama_barang']} (Jumlah: +{$jumlahMasuk} {$barang['satuan']}, Stok sekarang: {$stokBaru})");

        $db->transComplete();

        if ($db->transStatus() === false) {
            return redirect()->back()->with('error', 'Gagal menyimpan transaksi. Coba lagi.');
        }

        // Notifikasi jika stok setelah penambahan masih <= minimum
        if ((int)$stokBaru <= (int)$barang['minimum_stok']) {
            $this->notifikasiModel->save([
                'pesan'  => "Stok {$barang['nama_barang']} tersisa {$stokBaru} (minimum: {$barang['minimum_stok']})⚠️",
                'status' => 'unread'
            ]);
        }

        return redirect()->to('user/kelola_barang')->with('success', 'Stok barang berhasil ditambahkan');
    }

    public function saveBarangKeluar()
    {
        $dataUser = session()->get('id_user');
        $idBarang = $this->request->getPost('id_barang');
        $jumlah   = $this->request->getPost('jumlah');
        $tanggal  = $this->request->getPost('tanggal');
        $ket      = $this->request->getPost('keterangan');

        // Validasi sederhana (wajib diisi)
        if (empty($idBarang) || empty($jumlah) || empty($tanggal)) {
            return redirect()->back()->withInput()->with('error', 'Semua field wajib diisi.');
        }

        // Ambil waktu sekarang (Jakarta)
        $now = new \DateTime('now', new \DateTimeZone('Asia/Jakarta'));
        $jam = $now->format('H:i:s');

        // Gabungkan jadi datetime
        $tanggalKeluar = $tanggal . ' ' . $jam;

        // Ambil stok barang dulu
        $barang = $this->barangModel->find($idBarang);
        if (!$barang) {
            return redirect()->back()->with('error', 'Barang tidak ditemukan.');
        }

        // Cek apakah stok cukup
        if ($barang['jumlah'] < $jumlah) {
            return redirect()->back()->withInput()->with('error', 'Stok tidak mencukupi!');
        }

        // Simpan ke tabel laporan
        $simpanLaporan = $this->laporanModel->save([
            'id_barang'  => $idBarang,
            'jumlah'     => $jumlah,
            'jenis'      => 'Dipakai',
            'tanggal'    => $tanggalKeluar,
            'id_user'    => $dataUser,
            'keterangan' => $ket,
        ]);

        if (!$simpanLaporan) {
            return redirect()->back()->withInput()->with('error', 'Gagal mencatat barang keluar.');
        }

        // Update stok barang (dikurangi)
        $stokBaru = $barang['jumlah'] - $jumlah;
        $updateBarang = $this->barangModel->update($idBarang, [
            'jumlah' => $stokBaru
        ]);

        if (!$updateBarang) {
            $error = $this->barangModel->errors();
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui stok barang. ' . json_encode($error));
        }

        // ✅ Tambahin notif stok minimum
        if ($stokBaru <= $barang['minimum_stok']) {
            $this->notifikasiModel->save([
                'pesan'  => "Stok {$barang['nama_barang']} tersisa {$stokBaru} (minimum: {$barang['minimum_stok']})⚠️",
                'status' => 'unread'
            ]);
        }

        // ✅ Tambahkan log aktivitas
        logAktivitas("Mengeluarkan barang: {$barang['nama_barang']} (Jumlah: {$jumlah} {$barang['satuan']})");

        return redirect()->to('/user/riwayat')
            ->with('success', 'Barang keluar berhasil dicatat & stok terupdate!');
    }

    public function hapusRiwayat($idLaporan)
    {
        // Pastikan ID ada
        if (!$idLaporan) {
            return redirect()->back()->with('error', 'ID laporan tidak valid.');
        }

        // Ambil laporan dengan join ke tabel barang
        $laporan = $this->laporanModel
            ->select('laporan.*, barang.nama_barang, barang.satuan')
            ->join('barang', 'barang.id_barang = laporan.id_barang', 'left')
            ->where('laporan.id_laporan', $idLaporan)
            ->first();

        if (!$laporan) {
            return redirect()->back()->with('error', 'Data laporan tidak ditemukan.');
        }

        // Hapus data
        if ($this->laporanModel->delete($idLaporan)) {
            logAktivitas(" Menghapus riwayat laporan: {$laporan['nama_barang']} (Jumlah: {$laporan['jumlah']} {$laporan['satuan']})");
            return redirect()->back()->with('success', 'Riwayat berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'Gagal menghapus riwayat.');
    }


    public function editRiwayat($idLaporan)
    {
        // Ambil nama barang dari input
        $namaBarang = $this->request->getPost('nama_barang');

        // Cari ID barang dari tabel barang
        $barang = $this->barangModel
            ->where('nama_barang', $namaBarang)
            ->first();

        if (!$barang) {
            return redirect()->to(base_url('user/riwayat'))
                ->with('error', 'Barang tidak ditemukan.');
        }

        // Ambil data laporan yang ada di database
        $existingData = $this->laporanModel->find($idLaporan);

        // Data baru yang akan diupdate
        $newData = [
            'tanggal'   => $this->request->getPost('tanggal')
                ?? date('Y-m-d H:i:s', strtotime('+7 hours')),
            'jumlah'    => $this->request->getPost('jumlah'),
            'jenis'     => $this->request->getPost('jenis'),
            'id_barang' => $barang['id_barang'],
            'id_user'   => session()->get('id_user'),
            'nama_user' => session()->get('nama'),
        ];

        // Cek apakah ada perubahan data
        if ($existingData && $newData == $existingData) {
            return redirect()->to(base_url('user/riwayat'))
                ->with('error', 'Tidak ada yang diperbarui.');
        }

        // Update data laporan
        $this->laporanModel->update($idLaporan, $newData);

        // ✅ Tambahkan log aktivitas
        logAktivitas("{$newData['nama_user']} Mengedit riwayat laporan. Barang: {$namaBarang}, Jumlah: {$newData['jumlah']}, Jenis: {$newData['jenis']}");

        return redirect()->to(base_url('user/riwayat'))
            ->with('success', 'Data riwayat berhasil diperbarui.');
    }

    public function printRiwayat($id_laporan)
    {
        $format = $this->request->getPost('format');

        if (!$format) {
            return redirect()->back()->with('error', 'Pilih format print terlebih dahulu.');
        }

        // Ambil data laporan berdasarkan ID
        $riwayatQuery = $this->laporanModel
            ->select('laporan.tanggal, laporan.jumlah, laporan.jenis, users.nama, barang.nama_barang, laporan.id_laporan')
            ->join('users', 'users.id_user = laporan.id_user')
            ->join('barang', 'barang.id_barang = laporan.id_barang');

        $riwayatQuery = $this->laporanModel->find($id_laporan);

        if (!$riwayatQuery) {
            return redirect()->back()->with('error', 'Data laporan tidak ditemukan.');
        }

        // Print Excel
        if ($format === 'excel') {
            // Ambil ulang data dengan join lengkap agar kolom tersedia
            $row = $this->laporanModel
                ->select('laporan.id_laporan, laporan.tanggal, laporan.jumlah, laporan.jenis, users.nama, barang.nama_barang')
                ->join('users', 'users.id_user = laporan.id_user')
                ->join('barang', 'barang.id_barang = laporan.id_barang')
                ->where('laporan.id_laporan', $id_laporan)
                ->first();

            if (!$row) {
                return redirect()->back()->with('error', 'Data laporan tidak ditemukan.');
            }

            // Build spreadsheet
            $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Header
            $sheet->setCellValue('A1', 'ID Laporan');
            $sheet->setCellValue('B1', 'Tanggal');
            $sheet->setCellValue('C1', 'Nama Barang');
            $sheet->setCellValue('D1', 'Jumlah');
            $sheet->setCellValue('E1', 'Jenis');
            $sheet->setCellValue('F1', 'Staff');

            // Data
            $sheet->setCellValue('A2', $row['id_laporan']);
            $sheet->setCellValue('B2', date('d-m-Y H:i:s', strtotime($row['tanggal'] . ' +7 hours')));
            $sheet->setCellValue('C2', $row['nama_barang']);
            $sheet->setCellValue('D2', $row['jumlah']);
            $sheet->setCellValue('E2', $row['jenis']);
            $sheet->setCellValue('F2', $row['nama']);

            // Tulis ke file sementara dan kirim via Response CI
            $fileName = 'laporan_' . $row['id_laporan'] . '.xlsx';
            $tempPath = WRITEPATH . 'uploads/' . $fileName;
            $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
            $writer->save($tempPath);

            return $this->response
                ->download($tempPath, null)
                ->setFileName($fileName)
                ->setHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        }

        // Print PDF
        if ($format === 'pdf') {
            // Load Dompdf
            $dompdf = new \Dompdf\Dompdf();
            $html = view('user/pdf_template', ['laporan' => $riwayatQuery]);

            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $dompdf->stream('laporan_' . $riwayatQuery['id_laporan'] . '.pdf', ["Attachment" => true]);
            exit;
        }

        return redirect()->back()->with('error', 'Format tidak valid.');
    }

    public function cetakRiwayatPDF()
    {
        $keyword = $this->request->getGet('keyword');
        $type    = strtolower($this->request->getGet('type') ?? 'semua');
        $day     = $this->request->getGet('day');     // YYYY-MM-DD
        $week    = $this->request->getGet('week');    // YYYY-Www
        $month   = $this->request->getGet('month');   // YYYY-MM

        $db = \Config\Database::connect();
        $builder = $db->table('laporan l')
            ->select('l.*, b.nama_barang as nama_barang, u.nama as nama_user')
            ->join('barang b', 'b.id_barang = l.id_barang', 'left')
            ->join('users u', 'u.id_user = l.id_user', 'left');

        if (!empty($keyword)) {
            $builder->groupStart()
                ->like('b.nama_barang', $keyword)
                ->orLike('u.nama', $keyword)
                ->orLike('l.jenis', $keyword)
                ->groupEnd();
        }

        switch ($type) {
            case 'harian':
                if (!empty($day)) {
                    $builder->where('DATE(l.tanggal)', $day);
                }
                break;
            case 'mingguan':
                if (!empty($week) && strpos($week, '-W') !== false) {
                    try {
                        [$y, $w] = explode('-W', $week);
                        $y = (int)$y;
                        $w = (int)$w;
                        $start = new \DateTime();
                        $start->setISODate($y, $w);
                        $startDate = $start->format('Y-m-d');
                        $end = clone $start;
                        $end->modify('+6 days');
                        $endDate = $end->format('Y-m-d');
                        $builder->where('DATE(l.tanggal) >=', $startDate)
                            ->where('DATE(l.tanggal) <=', $endDate);
                    } catch (\Throwable $e) { /* ignore */
                    }
                }
                break;
            case 'bulanan':
                if (!empty($month) && strpos($month, '-') !== false) {
                    $builder->where('DATE_FORMAT(l.tanggal, "%Y-%m")', $month);
                }
                break;
            case 'semua':
            default:
                // no date filter
                break;
        }

        $riwayatData = $builder->orderBy('l.tanggal', 'DESC')->get()->getResultArray();

        $judulPeriode = '';
        if ($type === 'harian' && !empty($day)) {
            $judulPeriode = 'Harian: ' . namaHariIndo($day) . ', ' . formatTanggalIndoTanpaJam($day);
        } elseif ($type === 'mingguan' && !empty($week) && strpos($week, '-W') !== false) {
            try {
                [$y, $w] = explode('-W', $week);
                $start = new \DateTime();
                $start->setISODate((int)$y, (int)$w);
                $end = clone $start;
                $end->modify('+6 days');
                $startDate = $start->format('Y-m-d');
                $endDate = $end->format('Y-m-d');
                $judulPeriode = 'Mingguan: ' . namaHariIndo($startDate) . ', ' . formatTanggalIndoTanpaJam($startDate)
                    . ' - ' . namaHariIndo($endDate) . ', ' . formatTanggalIndoTanpaJam($endDate);
            } catch (\Throwable $e) { /* ignore */
            }
        } elseif ($type === 'bulanan' && !empty($month)) {
            $judulPeriode = 'Bulanan: ' . formatBulanTahunIndo($month);
        } else {
            $judulPeriode = 'Semua Data';
        }

        $totalMasuk = 0;
        $totaldipakai = 0;
        foreach ($riwayatData as $row) {
            if (strtolower($row['jenis']) === 'masuk') {
                $totalMasuk += (int)$row['jumlah'];
            } elseif (strtolower($row['jenis']) === 'dipakai') {
                $totaldipakai += (int)$row['jumlah'];
            }
        }
        if ($totalMasuk > $totaldipakai) {
            $kesimpulan = 'Stok bertambah (' . ($totalMasuk - $totaldipakai) . ')';
        } elseif ($totalMasuk < $totaldipakai) {
            $kesimpulan = 'Stok berkurang (' . ($totaldipakai - $totalMasuk) . ')';
        } else {
            $kesimpulan = 'Stok seimbang';
        }

        $html = view('user/riwayat_pdf', [
            'riwayatData'  => $riwayatData,
            'keyword'      => $keyword,
            'totalMasuk'   => $totalMasuk,
            'totaldipakai' => $totaldipakai,
            'kesimpulan'   => $kesimpulan,
            'judulPeriode' => $judulPeriode,
        ]);

        $options = new Options();
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $fileName = 'laporan_' . date('Ymd_His') . '.pdf';
        $pdfOutput = $dompdf->output();

        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'attachment; filename="' . $fileName . '"')
            ->setBody($pdfOutput);
    }

    public function cetakRiwayatExcel()
    {
        $keyword = $this->request->getGet('keyword');
        $type    = strtolower($this->request->getGet('type') ?? 'semua');
        $day     = $this->request->getGet('day');
        $week    = $this->request->getGet('week');
        $month   = $this->request->getGet('month');

        $db = \Config\Database::connect();
        $builder = $db->table('laporan l')
            ->select('l.tanggal, l.jumlah, l.jenis, b.nama_barang, u.nama as nama_user')
            ->join('barang b', 'b.id_barang = l.id_barang', 'left')
            ->join('users u', 'u.id_user = l.id_user', 'left');

        if (!empty($keyword)) {
            $builder->groupStart()
                ->like('b.nama_barang', $keyword)
                ->orLike('u.nama', $keyword)
                ->orLike('l.jenis', $keyword)
                ->groupEnd();
        }

        switch ($type) {
            case 'harian':
                if (!empty($day)) {
                    $builder->where('DATE(l.tanggal)', $day);
                }
                break;
            case 'mingguan':
                if (!empty($week) && strpos($week, '-W') !== false) {
                    try {
                        [$y, $w] = explode('-W', $week);
                        $y = (int)$y;
                        $w = (int)$w;
                        $start = new \DateTime();
                        $start->setISODate($y, $w);
                        $startDate = $start->format('Y-m-d');
                        $end = clone $start;
                        $end->modify('+6 days');
                        $endDate = $end->format('Y-m-d');
                        $builder->where('DATE(l.tanggal) >=', $startDate)
                            ->where('DATE(l.tanggal) <=', $endDate);
                    } catch (\Throwable $e) { /* ignore */
                    }
                }
                break;
            case 'bulanan':
                if (!empty($month) && strpos($month, '-') !== false) {
                    $builder->where('DATE_FORMAT(l.tanggal, "%Y-%m")', $month);
                }
                break;
            case 'semua':
            default:
                break;
        }

        $riwayatData = $builder->orderBy('l.tanggal', 'DESC')->get()->getResultArray();

        $judulPeriode = '';
        if ($type === 'harian' && !empty($day)) {
            $judulPeriode = 'Harian: ' . namaHariIndo($day) . ', ' . formatTanggalIndoTanpaJam($day);
        } elseif ($type === 'mingguan' && !empty($week) && strpos($week, '-W') !== false) {
            try {
                [$y, $w] = explode('-W', $week);
                $start = new \DateTime();
                $start->setISODate((int)$y, (int)$w);
                $end = clone $start;
                $end->modify('+6 days');
                $startDate = $start->format('Y-m-d');
                $endDate = $end->format('Y-m-d');
                $judulPeriode = 'Mingguan: ' . namaHariIndo($startDate) . ', ' . formatTanggalIndoTanpaJam($startDate)
                    . ' - ' . namaHariIndo($endDate) . ', ' . formatTanggalIndoTanpaJam($endDate);
            } catch (\Throwable $e) { /* ignore */
            }
        } elseif ($type === 'bulanan' && !empty($month)) {
            $judulPeriode = 'Bulanan: ' . formatBulanTahunIndo($month);
        } else {
            $judulPeriode = 'Semua Data';
        }

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'LAPORAN RIWAYAT BARANG');
        $sheet->mergeCells('A1:F1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

        if (!empty($judulPeriode)) {
            $sheet->setCellValue('A2', 'Periode: ' . $judulPeriode);
            $sheet->mergeCells('A2:F2');
            $sheet->getStyle('A2')->getAlignment()->setHorizontal('center');
            $sheet->getStyle('A2')->getFont()->setItalic(true);
        }

        $sheet->setCellValue('A3', 'No');
        $sheet->setCellValue('B3', 'Waktu');
        $sheet->setCellValue('C3', 'Nama Barang');
        $sheet->setCellValue('D3', 'Jumlah');
        $sheet->setCellValue('E3', 'Jenis');
        $sheet->setCellValue('F3', 'Staff');

        foreach (range('A', 'F') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $row = 4;
        $no = 1;
        $totalMasuk = 0;
        $totaldipakai = 0;
        foreach ($riwayatData as $data) {
            $sheet->setCellValue('A' . $row, $no++);
            $sheet->setCellValue('B' . $row, date('d-m-Y H:i:s', strtotime($data['tanggal'])));
            $sheet->setCellValue('C' . $row, $data['nama_barang']);
            $sheet->setCellValue('D' . $row, $data['jumlah']);
            $sheet->setCellValue('E' . $row, $data['jenis']);
            $sheet->setCellValue('F' . $row, $data['nama_user']);

            if (strtolower($data['jenis']) === 'masuk') {
                $totalMasuk += (int)$data['jumlah'];
            } elseif (strtolower($data['jenis']) === 'dipakai') {
                $totaldipakai += (int)$data['jumlah'];
            }
            $row++;
        }

        $row += 2;
        $sheet->setCellValue('E' . $row, 'Total Barang Masuk:');
        $sheet->setCellValue('F' . $row, $totalMasuk);
        $row++;
        $sheet->setCellValue('E' . $row, 'Total Barang dipakai:');
        $sheet->setCellValue('F' . $row, $totaldipakai);
        $row += 2;
        $sheet->setCellValue('E' . $row, 'Kesimpulan:');
        if ($totalMasuk > $totaldipakai) {
            $sheet->setCellValue('F' . $row, 'Stok bertambah (' . ($totalMasuk - $totaldipakai) . ')');
        } elseif ($totalMasuk < $totaldipakai) {
            $sheet->setCellValue('F' . $row, 'Stok berkurang (' . ($totaldipakai - $totalMasuk) . ')');
        } else {
            $sheet->setCellValue('F' . $row, 'Stok seimbang');
        }

        $fileName = 'Laporan_Riwayat_' . date('Ymd_His') . '.xlsx';
        $tempPath = WRITEPATH . 'uploads/' . $fileName;
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save($tempPath);

        return $this->response
            ->download($tempPath, null)
            ->setFileName($fileName)
            ->setHeader('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    }

    public function profil()
    {
        $dataUser = session()->get('id_user');
        $user = $this->userModel->find($dataUser);

        $data = [
            'title' => 'Profil User - CargoWing',
            'user' => $user,
            'currentPage' => 'profil',
            'notif' => $this->notifikasiModel->getUnreadNotif(5)
        ];
        return view('user/profil', $data);
    }

    public function update()
    {
        $userId = session()->get('id_user');
        $user   = $this->userModel->find($userId);

        if (!$user) {
            return redirect()->back()->with('error', 'Data user tidak ditemukan!');
        }

        $nama  = $this->request->getPost('nama');
        $email = $this->request->getPost('email');

        $dataUpdate = [
            'nama'  => $nama,
            'email' => $email,
        ];

        // Cek perubahan (pakai data lama dari DB sebagai identitas pelaku)
        $pelaku = $user['nama'];

        if ($user['nama'] !== $nama && $user['email'] === $email) {
            logAktivitas("$pelaku mengganti nama dari '{$user['nama']}' menjadi '{$nama}'");
        } elseif ($user['nama'] === $nama && $user['email'] !== $email) {
            logAktivitas("$pelaku mengganti email dari '{$user['email']}' menjadi '{$email}'");
        } elseif ($user['nama'] !== $nama && $user['email'] !== $email) {
            logAktivitas("$pelaku mengganti nama dari '{$user['nama']}' menjadi '{$nama}', dan mengganti email dari '{$user['email']}' menjadi '{$email}'");
        }

        // Update data
        $this->userModel->update($userId, $dataUpdate);

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function gantiPassword()
    {
        $userModel = new UserModel();
        $userId = session()->get('id_user');

        $passwordLama = $this->request->getPost('password_lama');
        $passwordBaru = $this->request->getPost('password_baru');
        $konfirmasi   = $this->request->getPost('konfirmasi_password');

        $user = $userModel->find($userId);

        if (!$user || !password_verify($passwordLama, $user['password'])) {
            return redirect()->back()->with('errorp', 'Password lama salah.');
        }
        if ($passwordBaru !== $konfirmasi) {
            return redirect()->back()->with('errorp', 'Konfirmasi password tidak sama.');
        }
        if (strlen($passwordBaru) < 8) {
            return redirect()->back()->with('errorp', 'Password baru minimal 8 karakter.');
        }

        $userModel->update($userId, [
            'password' => password_hash($passwordBaru, PASSWORD_DEFAULT)
        ]);
        logAktivitas("{$user['nama']} mengganti password akun.");

        return redirect()->back()->with('successp', 'Password berhasil diubah.');
    }

    public function readNotif($id)
    {
        $this->notifikasiModel->markAsRead($id);
        return redirect()->back();
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/'));
    }
}
