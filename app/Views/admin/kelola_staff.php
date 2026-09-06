<?= $this->extend('layout/templateAdmin') ?>
<?= $this->section('content') ?>

<style>
    .page-wrapper {
        margin-left: 280px;
        background-color: #f0f2f5;
        min-height: 100vh;
    }

    .page-content {
        padding: 2rem;
    }

    .search-actions-bar {
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        margin-bottom: 1.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
    }

    .search-form {
        display: flex;
        gap: 0.75rem;
        flex: 1;
        max-width: 600px;
    }

    .search-input-wrapper {
        position: relative;
        flex: 1;
    }

    .search-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        width: 1.25rem;
        height: 1.25rem;
    }

    .search-input {
        width: 100%;
        padding: 0.75rem 1rem 0.75rem 2.75rem;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 0.875rem;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .search-input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    .btn {
        padding: 0.75rem 1.25rem;
        font-size: 0.875rem;
        font-weight: 600;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-primary {
        background: #3b82f6;
        color: white;
    }

    .btn-primary:hover {
        background: #2563eb;
    }

    .btn-secondary {
        background: #e5e7eb;
        color: #374151;
    }

    .btn-secondary:hover {
        background: #d1d5db;
    }

    .btn-success {
        background: #10b981;
        color: white;
    }

    .btn-success:hover {
        background: #059669;
    }

    .alert-info {
        background: #d1fae5;
        border: 1px solid #a7f3d0;
        border-radius: 8px;
        padding: 0.875rem 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }

    .alert-dot {
        width: 0.625rem;
        height: 0.625rem;
        background: #10b981;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .alert-text {
        font-size: 0.875rem;
        color: #065f46;
        font-weight: 500;
    }

    .alert-error {
        background: #fee2e2;
        border-color: #fecaca;
    }

    .alert-error .alert-dot {
        background: #ef4444;
    }

    .alert-error .alert-text {
        color: #991b1b;
    }

    .content-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .table-wrapper {
        overflow-x: auto;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
    }

    .data-table thead {
        background: #f9fafb;
        border-bottom: 2px solid #e5e7eb;
    }

    .data-table th {
        padding: 1rem 1.5rem;
        text-align: left;
        font-size: 0.75rem;
        font-weight: 700;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        white-space: nowrap;
    }

    .data-table th.text-center {
        text-align: center;
    }

    .data-table td {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid #f3f4f6;
        color: #374151;
        font-size: 0.875rem;
        vertical-align: middle;
    }

    .data-table tbody tr:hover {
        background: #f9fafb;
    }

    .action-btns {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
    }

    .icon-btn {
        padding: 0.5rem;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .icon-btn-edit {
        background: #3b82f6;
        color: white;
    }

    .icon-btn-edit:hover {
        background: #2563eb;
    }

    .icon-btn-delete {
        background: #ef4444;
        color: white;
    }

    .icon-btn-delete:hover {
        background: #dc2626;
    }

    .empty-state {
        padding: 3rem;
        text-align: center;
        color: #9ca3af;
    }

    .pagination-wrapper {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 1.5rem;
        background: white;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        margin-top: 1.5rem;
    }

    .pagination-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 0.875rem;
        color: #6b7280;
    }

    .pagination-select {
        border: 1px solid #d1d5db;
        padding: 0.5rem 0.75rem;
        border-radius: 8px;
        background: white;
        font-size: 0.875rem;
        cursor: pointer;
    }

    .pagination-links {
        display: flex;
        gap: 0.5rem;
        align-items: center;
    }

    .pagination-links a,
    .pagination-links span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
        padding: 0 0.75rem;
        border-radius: 8px;
        font-size: 0.875rem;
        font-weight: 600;
        text-decoration: none;
        color: #374151;
        background: white;
        border: 1px solid #e5e7eb;
        transition: all 0.2s;
    }

    .pagination-links a:hover {
        background: #f9fafb;
        border-color: #d1d5db;
    }

    .pagination-links .active,
    .pagination-links a.active {
        background: #3b82f6;
        color: white;
        border-color: #3b82f6;
        box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    }

    @media (max-width: 1024px) {
        .page-wrapper {
            margin-left: 0;
        }

        .search-actions-bar {
            flex-direction: column;
            align-items: stretch;
        }

        .search-form {
            max-width: none;
        }
    }
</style>

<div class="page-wrapper">
    <div class="page-content">
        <!-- Flash Messages -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert-info alert-error">
                <div class="alert-dot"></div>
                <span class="alert-text"><?= session()->getFlashdata('error'); ?></span>
            </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert-info">
                <div class="alert-dot"></div>
                <span class="alert-text"><?= session()->getFlashdata('success'); ?></span>
            </div>
        <?php endif; ?>

        <!-- Search & Actions Bar -->
        <div class="search-actions-bar">
            <form method="get" class="search-form">
                <div class="search-input-wrapper">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" name="keyword" value="<?= esc(service('request')->getVar('keyword')) ?>"
                        placeholder="Cari staff..." class="search-input" />
                </div>
                <button type="submit" class="btn btn-primary">Cari</button>
                <?php if (service('request')->getVar('keyword') || service('request')->getVar('per_page')): ?>
                    <a href="<?= current_url() ?>" class="btn btn-secondary">Reset</a>
                <?php endif; ?>
            </form>

            <button type="button" onclick="openModal('modalTambah')" class="btn btn-success">
                <i class="fas fa-plus"></i>
                Tambah Staff
            </button>
        </div>

        <!-- Table Card -->
        <div class="content-card">
            <div class="table-wrapper">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Staff</th>
                            <th>Email</th>
                            <th>No HP</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($staffList)): ?>
                            <?php $no = 1; foreach ($staffList as $staff): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td style="font-weight: 600;"><?= esc($staff['nama']) ?></td>
                                    <td><?= esc($staff['email']) ?></td>
                                    <td><?= esc($staff['no_hp']) ?></td>
                                    <td>
                                        <div class="action-btns">
                                            <button type="button" onclick="openModalEdit(<?= htmlspecialchars(json_encode($staff), ENT_QUOTES, 'UTF-8') ?>)"
                                                class="icon-btn icon-btn-edit" title="Edit">
                                                <i class="fas fa-edit" style="width: 1rem; height: 1rem;"></i>
                                            </button>
                                            <form action="<?= base_url('admin/hapus-staff/' . $staff['id_user']) ?>" method="post" class="form-hapus" style="display: inline;">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="icon-btn icon-btn-delete btn-hapus" title="Hapus">
                                                    <i class="fas fa-trash" style="width: 1rem; height: 1rem;"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="empty-state">
                                    Tidak ada data staff
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="pagination-wrapper">
            <div class="pagination-info">
                <span>Baris per halaman</span>
                <form method="get">
                    <input type="hidden" name="keyword" value="<?= esc($keyword) ?>" />
                    <select name="per_page" onchange="this.form.submit()" class="pagination-select">
                        <option value="5" <?= ($perPage == 5) ? 'selected' : '' ?>>5</option>
                        <option value="10" <?= ($perPage == 10) ? 'selected' : '' ?>>10</option>
                        <option value="25" <?= ($perPage == 25) ? 'selected' : '' ?>>25</option>
                    </select>
                </form>
            </div>
            <div class="pagination-links">
                <?php if ($pager): ?>
                    <?= $pager->simpleLinks('number', 'tailwind_pagination') ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Staff -->
<div id="modalTambah" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-[9999]">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md p-6">
        <h2 class="text-xl font-bold mb-6 text-gray-900">Tambah Staff</h2>
        <form action="<?= base_url('admin/tambah-staff') ?>" method="post" id="registerForm" class="form-auth">
            <?= csrf_field() ?>
            
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Staff</label>
                <input type="text" name="nama" id="nama" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <small id="namaError" class="text-red-600 text-xs"></small>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                <input type="email" name="email" id="email" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <small id="emailError" class="text-red-600 text-xs"></small>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">No HP</label>
                <input type="text" name="no_hp" id="no_hp" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                <small id="nohpError" class="text-red-600 text-xs"></small>
            </div>

            <!-- Password -->
            <div class="mb-4 relative">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                <input id="passwordInput" type="password" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    name="password" placeholder="Masukkan password (min 8 karakter)" required />
                <span id="togglePassword" class="absolute right-3 top-9 cursor-pointer" title="Show password">
                    <i class="fas fa-eye text-gray-400"></i>
                </span>
                <small id="passwordError" class="text-red-600 text-xs"></small>
            </div>

            <!-- Confirm Password -->
            <div class="mb-6 relative">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Confirm Password</label>
                <input id="confirmPasswordInput" type="password" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" 
                    name="confirm_password" placeholder="Konfirmasi password" required />
                <span id="toggleConfirmPassword" class="absolute right-3 top-9 cursor-pointer" title="Show password">
                    <i class="fas fa-eye text-gray-400"></i>
                </span>
                <small id="confirmPasswordError" class="text-red-600 text-xs"></small>
            </div>

            <!-- Action -->
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeModal('modalTambah')" class="px-6 py-2.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-semibold text-sm">
                    Batal
                </button>
                <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold text-sm">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Staff -->
<div id="modalEdit" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-[9999]">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-md p-6">
        <h2 class="text-xl font-bold mb-6 text-gray-900">Edit Staff</h2>
        <form id="formEdit" method="post">
            <?= csrf_field() ?>
            <input type="hidden" id="edit_id_user" name="id_user">

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Staff</label>
                <input type="text" id="edit_nama" name="nama" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                <input type="email" id="edit_email" name="email" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">No HP</label>
                <input type="text" id="edit_no_hp" name="no_hp" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeModal('modalEdit')" class="px-6 py-2.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-semibold text-sm">
                    Batal
                </button>
                <button type="submit" class="px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold text-sm">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Script -->
<script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    
    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
    
    function openModalEdit(data) {
        document.getElementById('modalEdit').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        document.getElementById('formEdit').action = "<?= base_url('admin/edit-staff/') ?>" + data.id_user;
        document.getElementById('edit_id_user').value = data.id_user;
        document.getElementById('edit_nama').value = data.nama;
        document.getElementById('edit_email').value = data.email;
        document.getElementById('edit_no_hp').value = data.no_hp;
    }

    // Close modal on outside click
    document.querySelectorAll('#modalTambah, #modalEdit').forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal(this.id);
            }
        });
    });

    // Delete confirmation with SweetAlert2
    document.querySelectorAll('.btn-hapus').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const form = this.closest('form');
            
            Swal.fire({
                title: 'Yakin ingin menghapus?',
                text: 'Data staff ini akan dihapus permanen.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#3b82f6',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    // Auto hide alert after 3 seconds
    setTimeout(() => {
        document.querySelectorAll('.alert-info').forEach(alert => {
            alert.style.opacity = '0';
            alert.style.transition = 'opacity 0.5s';
            setTimeout(() => alert.remove(), 500);
        });
    }, 3000);

    // Password validation & toggle
    document.addEventListener('DOMContentLoaded', function () {
        function setupToggle(inputId, toggleId) {
            const input = document.getElementById(inputId);
            const toggle = document.getElementById(toggleId);
            if (!input || !toggle) return;
            
            toggle.addEventListener('click', function () {
                const icon = toggle.querySelector('i');
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        }

        const password = document.getElementById('passwordInput');
        const confirm = document.getElementById('confirmPasswordInput');
        const passwordError = document.getElementById('passwordError');
        const confirmError = document.getElementById('confirmPasswordError');
        const formTambah = document.getElementById('registerForm');

        setupToggle('passwordInput', 'togglePassword');
        setupToggle('confirmPasswordInput', 'toggleConfirmPassword');

        if (password) {
            password.addEventListener('input', function () {
                passwordError.textContent = password.value.length < 8 ? 'Password minimal 8 karakter' : '';
            });
        }

        if (confirm) {
            confirm.addEventListener('input', function () {
                confirmError.textContent = password.value !== confirm.value ? 'Konfirmasi password tidak sama' : '';
            });
        }

        if (formTambah) {
            formTambah.addEventListener('submit', function (e) {
                let valid = true;
                if (password.value.length < 8) {
                    passwordError.textContent = 'Password minimal 8 karakter';
                    valid = false;
                }
                if (password.value !== confirm.value) {
                    confirmError.textContent = 'Konfirmasi password tidak sama';
                    valid = false;
                }
                if (!valid) e.preventDefault();
            });
        }
    });
</script>
<?= $this->endSection() ?>