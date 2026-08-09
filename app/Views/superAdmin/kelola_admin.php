<?= $this->extend('layout/templateSuperAdmin') ?>

<?= $this->section('content') ?>
<!-- Main Content -->
<div class="main-content">

    <!-- Header -->
    <div class="header">
        <div class="header-content">
            <div class="header-title">
                <h1>Kelola Admin</h1>
                <p>Daftar semua Admin pada sistem.</p>
            </div>
            <div class="header-actions">
                <div class="user-profile">
                    <div class="user-avatar">SA</div>
                    <a href="<?= base_url('superadmin/pengaturan-akun') ?>" class="a-info">
                        <div class="user-info">
                            <h6><?= esc($superAdmin['nama']) ?></h6>
                            <p><?= esc($superAdmin['role']) ?></p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Area -->
    <div class="content-area">

        <!-- Search & Filter -->
        <div class="mb-4 flex items-center gap-2">
            <form method="get" class="flex items-center gap-2">
                <input type="text" name="keyword" value="<?= esc(service('request')->getVar('keyword')) ?>"
                    placeholder="Cari admin..."
                    class="px-3 py-2 border border-gray-300 rounded w-64 focus:outline-none focus:ring focus:ring-blue-200 text-sm" />

                <button type="submit"
                    class="px-3 py-2 bg-blue-500 text-white text-sm rounded hover:bg-blue-600 transition">
                    Cari
                </button>

                <?php if (service('request')->getVar('keyword') || service('request')->getVar('per_page')): ?>
                    <a href="<?= current_url() ?>"
                        class="px-3 py-2 bg-gray-300 text-sm rounded hover:bg-gray-400 transition">
                        Reset
                    </a>
                <?php endif; ?>
            </form>

            <button type="button"
                onclick="openModalTambah()"
                class="ml-auto px-3 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition">
                Tambah Admin
            </button>
        </div>

        <?php if (session()->getFlashdata('error')): ?>
            <div id="errorAlert" class="error-message">
                <?= session()->getFlashdata('error'); ?>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('success')): ?>
            <div id="successAlert" class="success-message">
                <?= session()->getFlashdata('success'); ?>
            </div>
        <?php endif; ?>

        <!-- Content Grid -->
        <div class="content-grid">

            <!-- Admin Table -->
            <div class="content-card">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm bg-white rounded shadow">
                        <thead class="bg-gray-200 text-gray-700 font-semibold">
                            <tr>
                                <th class="p-3 text-left">No</th>
                                <th class="p-3 text-left">Nama</th>
                                <th class="p-3 text-left">Email</th>
                                <th class="p-3 text-left">Status</th>
                                <th class="p-3 text-left">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($dataAdmin)): ?>
                                <?php foreach ($dataAdmin as $index => $admin): ?>
                                    <tr class="border-t hover:bg-gray-50">
                                        <td class="p-3"><?= $index + 1 ?></td>
                                        <td class="p-3"><?= esc($admin['nama']) ?></td>
                                        <td class="p-3"><?= esc($admin['email']) ?></td>
                                        <td class="p-3">
                                            <?php if (($admin['aktif'] == 1)): ?>
                                                <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full">
                                                    Aktif
                                                </span>
                                            <?php else: ?>
                                                <span class="px-2 py-1 bg-red-100 text-red-700 text-xs font-semibold rounded-full">
                                                    Tidak Aktif
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="p-3 flex gap-2">
                                            <button type="button" onclick="openModalEdit(<?= htmlspecialchars(json_encode($admin), ENT_QUOTES, 'UTF-8') ?>)"
                                                class="inline-flex items-center px-2 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded transition">
                                                <i data-feather="edit" class="w-4 h-4"></i>
                                            </button>
                                            <form action="<?= base_url('superadmin/kelola-admin/hapus/' . $admin['id_admin']) ?>" method="post" class="form-hapus inline">
                                                <?= csrf_field() ?>
                                                <button title="Hapus" type="submit"
                                                    class="btn-hapus inline-flex items-center px-2 py-1 bg-red-500 hover:bg-red-600 text-white rounded transition">
                                                    <i data-feather="trash" class="w-4 h-4"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="p-3 text-center">Belum ada data admin.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Footer Pagination -->
                <div class="flex justify-between items-center mt-4 text-sm">
                    <div class="flex items-center gap-2">
                        <span>Rows per page</span>
                        <form method="get">
                            <input type="hidden" name="keyword" value="<?= esc($keyword) ?>" />
                            <select name="per_page" onchange="this.form.submit()" class="border border-gray-300 px-2 py-1 rounded">
                                <option value="5" <?= ($perPage == 5) ? 'selected' : '' ?>>5</option>
                                <option value="10" <?= ($perPage == 10) ? 'selected' : '' ?>>10</option>
                                <option value="25" <?= ($perPage == 25) ? 'selected' : '' ?>>25</option>
                            </select>
                        </form>
                    </div>

                    <div class="flex items-center justify-center gap-2 mt-4">
                        <?php if ($pager): ?>
                            <div class="flex items-center space-x-1">
                                <?= $pager->simpleLinks('number', 'tailwind_pagination') ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Admin -->
<div id="modalTambah" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded shadow-lg p-6 w-96">
        <h2 class="text-lg font-bold mb-4">Tambah Admin</h2>
        <form action="<?= base_url('superadmin/kelola-admin/tambah') ?>" method="post">
            <?= csrf_field() ?>
            <div class="mb-4">
                <label class="block text-sm font-medium">Nama</label>
                <input type="text" name="nama" class="w-full px-3 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium">Email</label>
                <input type="email" name="email" class="w-full px-3 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium">Password</label>
                <input type="password" name="password" class="w-full px-3 py-2 border rounded" required>
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModalTambah()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Admin -->
<div id="modalEdit" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded shadow-lg p-6 w-96">
        <h2 class="text-lg font-bold mb-4">Edit Admin</h2>
        <form id="formEditAdmin" method="post">
            <?= csrf_field() ?>
            <input type="hidden" name="id_admin" id="editIdAdmin">
            <div class="mb-4">
                <label class="block text-sm font-medium">Nama</label>
                <input type="text" name="nama" id="editNama" class="w-full px-3 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium">Email</label>
                <input type="email" name="email" id="editEmail" class="w-full px-3 py-2 border rounded" required>
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModalEdit()" class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Tambah Modal
    function openModalTambah() {
        document.getElementById('modalTambah').classList.remove('hidden');
    }

    function closeModalTambah() {
        document.getElementById('modalTambah').classList.add('hidden');
    }

    // Edit Modal
    function openModalEdit(admin) {
        const modal = document.getElementById('modalEdit');
        document.getElementById('editIdAdmin').value = admin.id_admin;
        document.getElementById('editNama').value = admin.nama;
        document.getElementById('editEmail').value = admin.email;

        const form = document.getElementById('formEditAdmin');
        form.action = "<?= base_url('superadmin/kelola-admin/edit') ?>/" + admin.id_admin;

        modal.classList.remove('hidden');
    }

    function closeModalEdit() {
        document.getElementById('modalEdit').classList.add('hidden');
    }
</script>

<?= $this->endSection() ?>