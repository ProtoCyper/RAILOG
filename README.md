<p align="center">
  <img src="public/assets/img/logo.png" alt="RAILOG Logo" width="120" height="120" style="object-fit: contain;">
</p>

<h1 align="center">RAILOG</h1>

<p align="center">
  <strong>Sistem Informasi Manajemen Inventaris & Logistik Gudang Terpadu</strong><br>
  <em>Warehouse & Inventory Management System built with CodeIgniter 4</em>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-^8.1-777BB4?style=flat-square&logo=php&logoColor=white" alt="PHP Version">
  <img src="https://img.shields.io/badge/Framework-CodeIgniter%204-EF4444?style=flat-square&logo=codeigniter&logoColor=white" alt="CodeIgniter 4">
  <img src="https://img.shields.io/badge/Database-MySQL-4479A1?style=flat-square&logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/UI-Tailwind%20CSS%20%26%20Bootstrap%205-38B2AC?style=flat-square&logo=tailwind-css&logoColor=white" alt="Tailwind & Bootstrap">
  <img src="https://img.shields.io/badge/License-MIT-blue?style=flat-square" alt="License">
</p>

---

## 📌 Tentang RAILOG

**RAILOG** adalah sistem informasi manajemen pergudangan dan logistik berbasis web yang dirancang untuk mengoptimalkan pengelolaan rantai pasok barang. Aplikasi ini menyediakan solusi komprehensif mulai dari pencatatan barang masuk (*inbound*), pemakaian/pengeluaran barang (*outbound*), monitoring stok minimum, pelabelan barcode terintegrasi, hingga pelaporan otomatis dalam format PDF dan Excel.

Sistem ini dirancang dengan pendekatan **Role-Based Access Control (RBAC)** yang memisahkan tanggung jawab antara level **Super Admin**, **Admin**, dan **Staff Gudang**, serta dilengkapi sistem audit aktivitas (*activity log*) untuk transparansi dan keamanan data operasional.

---

## ✨ Fitur Utama

### 1. 🛡️ Multi-Level Access Control (RBAC)
- **Super Admin**:
  - Manajemen akun Administrator (Tambah, Edit, Hapus, Aktivasi Akun).
  - Monitoring log aktivitas seluruh Admin secara komprehensif.
  - Pengaturan profil dan kredensial akun Super Admin.
- **Admin**:
  - Manajemen master data inventaris barang & kategori.
  - Pembuatan dan pengunduhan label barcode barang.
  - Manajemen akun Staff Gudang (User).
  - Rekapitulasi laporan mutasi barang masuk dan keluar dengan filter dinamis.
  - Ekspor laporan ke format **Excel (.xlsx)** dan **PDF**.
  - Monitoring log aktivitas seluruh staff operasional.
- **Staff Gudang (User)**:
  - Dashboard operasional dengan indikator stok barang dan peringatan stok minimum.
  - Pencatatan transaksi **Barang Masuk** (stok baru atau restock item eksisting).
  - Pencatatan transaksi **Barang Keluar** (pemakaian barang operasional).
  - Unduh barcode dan cetak berkas Surat Jalan.
  - Riwayat mutasi inventaris barang pribadi.

### 2. 🏷️ Manajemen Barcode & Identifikasi Item
- Integrasi generator barcode otomatis berbasis standar SKU item menggunakan library `picqer/php-barcode-generator`.
- Kemampuan cetak dan download barcode langsung untuk kebutuhan tagging fisik di gudang.

### 3. 📊 Pelaporan & Ekspor Data Fleksibel
- Filter transaksi multi-mode:
  - **Harian** (berdasarkan tanggal spesifik)
  - **Mingguan** (berdasarkan tanggal awal minggu)
  - **Bulanan** (berdasarkan periode bulan)
  - **Rentang Kustom** (*start date* s/d *end date*)
- Ekspor laporan berkualitas cetak:
  - Format **Excel** menggunakan `PhpSpreadsheet`
  - Format **PDF** menggunakan `Dompdf`

### 4. 📝 Audit Trail & Log Aktivitas
- Pencatatan otomatis setiap aksi penting (login, perubahan data, transaksi barang, dsb.).
- Perekaman data lengkap mencakup Nama Pengguna, Jenis Aktivitas, Alamat IP (*IP Address*), dan Waktu Kejadian.

### 5. 🔔 Notifikasi & Sinkronisasi Stok
- Peringatan visual otomatis saat stok barang mencapai batas minimum.
- Fitur *Auto-Sync* mutasi laporan dengan master stok barang untuk memastikan konsistensi data riil.

---

## 🛠️ Teknologi & Pustaka

| Komponen | Teknologi / Library | Deskripsi |
|---|---|---|
| **Core Framework** | CodeIgniter 4 (PHP ^8.1) | Arsitektur MVC modern, ringan, dan cepat |
| **Database** | MySQL / MariaDB | Relational Database Management System |
| **Frontend Styling** | Tailwind CSS & Bootstrap 5 | Antarmuka responsif dan modern |
| **Icons & Alerts** | FontAwesome 6 & SweetAlert2 | Ikonografi lengkap dan modal interaktif |
| **Spreadsheet Engine** | `phpoffice/phpspreadsheet` | Pengolahan dan ekspor file Microsoft Excel |
| **PDF Renderer** | `dompdf/dompdf` | Kompilasi HTML/CSS ke dokumen PDF |
| **Barcode Engine** | `picqer/php-barcode-generator` | Pembuatan visual barcode inventaris |
| **QR Code Engine** | `endroid/qr-code` | Generator kode QR sistem |

---

## 📋 Persyaratan Sistem

Sebelum menjalankan aplikasi, pastikan sistem Anda memenuhi persyaratan berikut:

- **PHP**: Versi `8.1` atau lebih tinggi
- **Ekstensi PHP yang Diperlukan**:
  - `php-intl`
  - `php-mbstring`
  - `php-mysqlnd` / `pdo_mysql`
  - `php-gd` (untuk manipulasi gambar dan barcode)
  - `php-curl`
  - `php-xml`
- **Database**: MySQL 5.7+ atau MariaDB 10.3+
- **Dependency Manager**: [Composer](https://getcomposer.org/) 2.x

---

## 🚀 Panduan Instalasi

Ikuti langkah-langkah berikut untuk menginstal RAILOG di lingkungan lokal:

### 1. Klon Repositori
```bash
git clone https://github.com/username/railog.git
cd railog
```

### 2. Instal Dependensi Composer
Jalankan perintah berikut untuk mengunduh semua pustaka yang dibutuhkan:
```bash
composer install
```

### 3. Konfigurasi Lingkungan (`.env`)
Salin file konfigurasi `env` menjadi `.env`:
```bash
cp env .env
```
Buka file `.env` dan sesuaikan konfigurasi dasar:
```ini
CI_ENVIRONMENT = development

# URL Aplikasi
app.baseURL = 'http://localhost:8080/'

# Konfigurasi Database
database.default.hostname = localhost
database.default.database = railog
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
database.default.port     = 3306
```

### 4. Setup Database
1. Buat database baru di MySQL/phpMyAdmin dengan nama (misal: `railog`).
2. Impor file skema database `railog.sql` yang tersedia di direktori *root* ke database yang baru dibuat:
```bash
mysql -u root -p railog < railog.sql
```

### 5. Jalankan Server Pengembangan
Gunakan perintah CLI bawaan CodeIgniter 4:
```bash
php spark serve
```
Aplikasi sekarang dapat diakses melalui peramban web di:
```text
http://localhost:8080
```

---

## 👥 Akun Bawaan (Default Credentials)

Setelah mengimpor `railog.sql`, Anda dapat menggunakan akun pengujian berikut:

| Peran (Role) | Email | Password Bawaan | Hak Akses |
|---|---|---|---|
| **Super Admin** | `admin1@gmail.com` | `admin123` *(atau password hash bawaan database)* | Akses penuh manajemen admin dan audit log global |
| **Admin** | `admin2@gmail.com` | `admin123` | Manajemen stok barang, staff, dan laporan logistik |
| **Staff Gudang** | `staff1@gmail.com` | `staff123` | Entri barang masuk/keluar, cetak surat jalan & barcode |

> ⚠️ **Catatan Keamanan**: Harap segera ubah password bawaan setelah instalasi pertama kali melalui menu **Pengaturan Akun**.

---

## 📂 Struktur Direktori Proyek

```plaintext
RAILOG/
├── app/
│   ├── Config/           # Konfigurasi aplikasi, filter, dan routing
│   ├── Controllers/      # Controller utama (Admin, SuperAdmin, User, Auth)
│   ├── Helpers/          # Helper fungsi (tanggal, log aktivitas, dsb.)
│   ├── Models/           # Model data (Barang, Laporan, Admin, Users, Notifikasi)
│   └── Views/            # Template antarmuka (admin, superAdmin, user, layout)
├── public/
│   ├── assets/           # Berkas statis (CSS kustom, JavaScript, gambar, logo)
│   └── index.php         # Front Controller utama
├── writable/             # Direktori cache, logs, dan berkas unggahan
├── railog.sql            # Skema dan data awal database MySQL
├── composer.json         # Konfigurasi paket dan dependensi Composer
└── README.md             # Dokumentasi proyek
```

---

## 🔒 Keamanan & Praktik Terbaik

- **Cross-Site Request Forgery (CSRF)**: Seluruh formulir POST dilindungi dengan token `<?= csrf_field() ?>`.
- **Input Sanitization**: Menggunakan *query binding* dan escaping bawaan CodeIgniter 4 untuk mencegah serangan SQL Injection dan XSS.
- **Akses Langsung**: File inti PHP berada di luar folder `public/`, memastikan file source code terlindungi dari eksekusi web langsung.
- **Session Security**: Validasi filter berbasis peran di setiap grup routing untuk mencegah eskalasi hak akses (*privilege escalation*).

---

## 📄 Lisensi

Proyek ini didistribusikan di bawah lisensi [MIT License](LICENSE). Anda bebas menggunakan, memodifikasi, dan mengembangkan perangkat lunak ini sesuai dengan ketentuan lisensi.
