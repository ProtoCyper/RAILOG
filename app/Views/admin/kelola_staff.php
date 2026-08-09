<?= $this->extend('layout/templateAdmin') ?>
<?= $this->section('content') ?>

<!-- Main Content -->
<main class="main-content p-6 md:p-8 lg:p-10">

    <!-- Flash Message -->
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

    <!-- Search & Tambah Staff -->
    <div class="mb-4 flex items-center gap-2">
        <form method="get" class="flex items-center gap-2">
            <input 
                type="text" 
                name="keyword" 
                value="<?= esc(service('request')->getVar('keyword')) ?>" 
                placeholder="Search..."
                class="px-3 py-2 border border-gray-300 rounded w-64 focus:outline-none focus:ring focus:ring-blue-200 text-sm" 
            />
            <button 
                type="submit" 
                class="px-3 py-2 bg-blue-500 text-white text-sm rounded hover:bg-blue-600 transition">
                Cari
            </button>

            <?php if (service('request')->getVar('keyword') || service('request')->getVar('per_page')): ?>
                <a 
                    href="<?= current_url() ?>" 
                    class="px-3 py-2 bg-gray-300 text-sm rounded hover:bg-gray-400 transition">
                    Reset
                </a>
            <?php endif; ?>
        </form>

        <button 
            type="button"
            onclick="openModal('modalTambah')"
            class="ml-auto px-3 py-2 bg-blue-600 text-white text-sm rounded hover:bg-blue-700 transition">
            Tambah Staff
        </button>
    </div>

    <!-- Table -->
    <div class="table">
        <table class="min-w-full text-sm bg-white rounded shadow">
            <thead class="bg-gray-200 text-gray-700 font-semibold">
                <tr>
                    <th class="p-3 text-left">No</th>
                    <th class="p-3 text-left">Nama Staff</th>
                    <th class="p-3 text-left">Email</th>
                    <th class="p-3 text-left">No HP</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($staffList)): ?>
                    <?php $no = 1; foreach ($staffList as $staff): ?>
                        <tr class="border-t hover:bg-gray-50">
                            <td class="p-3"><?= $no++ ?></td>
                            <td class="p-3"><?= esc($staff['nama']) ?></td>
                            <td class="p-3"><?= esc($staff['email']) ?></td>
                            <td class="p-3"><?= esc($staff['no_hp']) ?></td>
                            <td class="p-3 text-center space-x-2">
                                <!-- Edit -->
                                <button 
                                    type="button" 
                                    onclick="openModalEdit(<?= htmlspecialchars(json_encode($staff), ENT_QUOTES, 'UTF-8') ?>)"
                                    class="inline-flex items-center px-2 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded transition">
                                    <i data-feather="edit" class="w-4 h-4"></i>
                                </button>

                                <!-- Hapus -->
                                <form 
                                    action="<?= base_url('admin/hapus-staff/' . $staff['id_user']) ?>" 
                                    method="post" 
                                    class="form-hapus inline">
                                    <?= csrf_field() ?>
                                    <button 
                                        title="Hapus" 
                                        type="submit"
                                        class="btn-hapus inline-flex items-center px-2 py-1 bg-red-500 hover:bg-red-600 text-white rounded transition">
                                        <i data-feather="trash" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center py-4">Tidak ada data user.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="flex justify-between items-center mt-4 text-sm">
            <div class="flex items-center gap-2">
                <span>Rows per page</span>
                <form method="get">
                    <input type="hidden" name="keyword" value="<?= esc($keyword) ?>" />
                    <select 
                        name="per_page" 
                        onchange="this.form.submit()" 
                        class="border border-gray-300 px-2 py-1 rounded">
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

</main>

<!-- Modal Tambah Staff -->
<div 
    id="modalTambah" 
    class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
        <h2 class="text-lg font-bold mb-4">Tambah Staff</h2>
        <form 
            action="<?= base_url('admin/tambah-staff') ?>" 
            method="post" 
            id="registerForm" 
            class="form-auth">
            <?= csrf_field() ?>
            
            <div class="mb-3">
                <label class="block text-sm font-medium">Nama Staff</label>
                <input type="text" name="nama" id="nama" class="w-full border rounded px-3 py-2 form-input" required>
                <small id="namaError" class="error-text"></small>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium">Email</label>
                <input type="email" name="email" id="email" class="w-full border rounded px-3 py-2 form-input" required>
                <small id="emailError" class="error-text"></small>
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium">No HP</label>
                <input type="text" name="no_hp" id="no_hp" class="w-full border rounded px-3 py-2 form-input" required>
                <small id="nohpError" class="error-text"></small>
            </div>

            <!-- Password -->
            <div class="mb-3 password-wrapper relative">
                <label class="block text-sm font-medium">Password</label>
                <input 
                    id="passwordInput" 
                    type="password" 
                    class="w-full border rounded px-3 py-2 form-input" 
                    name="password" 
                    placeholder="Masukkan password (min 8 karakter)" 
                    required 
                />
                <span 
                    id="togglePassword" 
                    class="toggle-password absolute right-3 top-9 cursor-pointer" 
                    title="Show password">
                    <svg viewBox="0 5 24 24" width="20" height="20" fill="currentColor">
                        <path d="M12 5c-7 0-10 7-10 7s3 7 10 7 10-7 10-7-3-7-10-7zm0 12c-2.76 
                                 0-5-2.24-5-5s2.24-5 5-5 
                                 5 2.24 5 5-2.24 5-5 5zm0-8a3 
                                 3 0 100 6 3 3 0 000-6z"/>
                    </svg>
                </span>
                <small id="passwordError" class="error-text text-red-600 mt-1"></small>
            </div>

            <!-- Confirm Password -->
            <div class="mb-3 password-wrapper relative">
                <label class="block text-sm font-medium">Confirm Password</label>
                <input 
                    id="confirmPasswordInput" 
                    type="password" 
                    class="w-full border rounded px-3 py-2 form-input" 
                    name="confirm_password" 
                    placeholder="Konfirmasi password" 
                    required 
                />
                <span 
                    id="toggleConfirmPassword" 
                    class="toggle-password absolute right-3 top-9 cursor-pointer" 
                    title="Show password">
                    <svg viewBox="0 5 24 24" width="20" height="20" fill="currentColor">
                        <path d="M12 5c-7 0-10 7-10 7s3 7 10 7 10-7 10-7-3-7-10-7zm0 12c-2.76 
                                 0-5-2.24-5-5s2.24-5 5-5 
                                 5 2.24 5 5-2.24 5-5 5zm0-8a3 
                                 3 0 100 6 3 3 0 000-6z"/>
                    </svg>
                </span>
                <small id="confirmPasswordError" class="error-text text-red-600 mt-1"></small>
            </div>

            <!-- Action -->
            <div class="flex justify-end gap-2 mt-4">
                <button 
                    type="button" 
                    onclick="closeModal('modalTambah')" 
                    class="px-4 py-2 bg-gray-400 rounded text-white hover:bg-gray-500">
                    Batal
                </button>
                <button 
                    type="submit" 
                    class="px-4 py-2 bg-blue-600 rounded text-white hover:bg-blue-700">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit Staff -->
<div 
    id="modalEdit" 
    class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
        <h2 class="text-lg font-bold mb-4">Edit Staff</h2>
        <form id="formEdit" method="post">
            <?= csrf_field() ?>
            <input type="hidden" id="edit_id_user" name="id_user">

            <div class="mb-3">
                <label class="block text-sm font-medium">Nama Staff</label>
                <input type="text" id="edit_nama" name="nama" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-3">
                <label class="block text-sm font-medium">Email</label>
                <input type="email" id="edit_email" name="email" class="w-full border rounded px-3 py-2" required>
            </div>

            <div class="mb-3">
                <label class="block text-sm font-medium">No HP</label>
                <input type="text" id="edit_no_hp" name="no_hp" class="w-full border rounded px-3 py-2" required>
            </div>
            <div class="flex justify-end gap-2 mt-4">
                <button 
                    type="button" 
                    onclick="closeModal('modalEdit')" 
                    class="px-4 py-2 bg-gray-400 rounded text-white hover:bg-gray-500">
                    Batal
                </button>
                <button 
                    type="submit" 
                    class="px-4 py-2 bg-blue-600 rounded text-white hover:bg-blue-700">
                    Update
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
<script> feather.replace(); </script>

<script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
    }
    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }
    function openModalEdit(data) {
        document.getElementById('modalEdit').classList.remove('hidden');
        document.getElementById('formEdit').action = "<?= base_url('admin/edit-staff/') ?>" + data.id_user;
        document.getElementById('edit_id_user').value = data.id_user;
        document.getElementById('edit_nama').value = data.nama;
        document.getElementById('edit_email').value = data.email;
        document.getElementById('edit_no_hp').value = data.no_hp;
    }

    // Auto hide alert
    setTimeout(() => {
        let errorAlert   = document.getElementById('errorAlert');
        let successAlert = document.getElementById('successAlert');
        if (errorAlert) errorAlert.style.display = 'none';
        if (successAlert) successAlert.style.display = 'none';
    }, 3000);

    // Password validation & toggle
    document.addEventListener('DOMContentLoaded', function () {
        function setupToggle(inputId, toggleId) {
            const input  = document.getElementById(inputId);
            const toggle = document.getElementById(toggleId);
            if (!input || !toggle) return;
            toggle.addEventListener('click', function () {
                input.type = input.type === 'password' ? 'text' : 'password';
            });
        }

        const password      = document.getElementById('passwordInput');
        const confirm       = document.getElementById('confirmPasswordInput');
        const passwordError = document.getElementById('passwordError');
        const confirmError  = document.getElementById('confirmPasswordError');
        const formTambah    = document.getElementById('registerForm');

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