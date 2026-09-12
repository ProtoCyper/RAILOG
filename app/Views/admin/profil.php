<?= $this->extend('layout/templateAdmin') ?>

<?= $this->section('content') ?>

<style>
    /* Page Wrapper */
    .profile-page-wrapper {
        margin-left: 280px;
        background-color: #f0f2f5;
        min-height: 100vh;
    }

    .profile-content {
        padding: 2rem;
    }

    /* Grid Layout untuk 2 Card */
    .profile-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
        max-width: 1400px;
        margin: 0 auto;
    }

    /* Form Card */
    .profile-form-card {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        border: 1px solid #e5e7eb;
    }

    .profile-card-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1f2937;
        margin: 0 0 1.5rem 0;
    }

    /* Form Group */
    .profile-form-group {
        margin-bottom: 1.25rem;
    }

    .profile-form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 500;
        color: #374151;
        margin-bottom: 0.5rem;
    }

    .profile-form-input {
        width: 100%;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        padding: 0.75rem 1rem;
        font-size: 0.875rem;
        background: #f9fafb;
        transition: all 0.2s;
        box-sizing: border-box;
    }

    .profile-form-input:focus {
        outline: none;
        background: white;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    /* Input Wrapper untuk Password */
    .profile-input-wrapper {
        position: relative;
    }

    .profile-input-wrapper .profile-form-input {
        padding-right: 3rem;
    }

    .profile-toggle-password {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #9ca3af;
        font-size: 1.125rem;
        transition: color 0.2s;
        background: none;
        border: none;
        padding: 0;
    }

    .profile-toggle-password:hover {
        color: #4b5563;
    }

    /* Buttons */
    .profile-btn {
        padding: 0.625rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.875rem;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
    }

    .profile-btn-primary {
        background: #1565C0;
        color: white;
    }

    .profile-btn-primary:hover {
        background: #0d4a94;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(21, 101, 192, 0.3);
    }

    .profile-btn-secondary {
        background: #e5e7eb;
        color: #374151;
    }

    .profile-btn-secondary:hover {
        background: #d1d5db;
    }

    .profile-button-group {
        display: flex;
        gap: 0.75rem;
        margin-top: 2rem;
    }

    /* Alert Messages */
    .profile-alert {
        padding: 0.875rem 1rem;
        border-radius: 8px;
        margin-bottom: 1.25rem;
        font-size: 0.875rem;
    }

    .profile-alert-error {
        background: #fee2e2;
        border: 1px solid #fecaca;
        color: #991b1b;
    }

    .profile-alert-success {
        background: #d1fae5;
        border: 1px solid #a7f3d0;
        color: #065f46;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .profile-page-wrapper {
            margin-left: 0;
        }
        .profile-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="profile-page-wrapper">
    <div class="profile-content">
        <div class="profile-grid">
            <!-- Card Informasi Akun -->
            <div class="profile-form-card">
                <h2 class="profile-card-title">Informasi Akun</h2>

                <?php if (session()->getFlashdata('error')): ?>
                    <div id="errorAlert" class="profile-alert profile-alert-error">
                        <?= session()->getFlashdata('error'); ?>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('success')): ?>
                    <div id="successAlert" class="profile-alert profile-alert-success">
                        <?= session()->getFlashdata('success'); ?>
                    </div>
                <?php endif; ?>

                <form id="formProfil" action="<?= base_url('admin/profil/update') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <div class="profile-form-group">
                        <label class="profile-form-label">Nama</label>
                        <input type="text" name="nama" value="<?= esc($admin['nama']) ?>" 
                            class="profile-form-input" required />
                        <?php if (session()->getFlashdata('error_nama')): ?>
                            <small class="text-red-600"><?= session()->getFlashdata('error_nama'); ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="profile-form-group">
                        <label class="profile-form-label">Email</label>
                        <input type="email" name="email" value="<?= esc($admin['email']) ?>" 
                            class="profile-form-input" required />
                        <?php if (session()->getFlashdata('error_email')): ?>
                            <small class="text-red-600"><?= session()->getFlashdata('error_email'); ?></small>
                        <?php endif; ?>
                    </div>

                    <div class="profile-button-group">
                        <button type="submit" id="btnUpdateProfil" class="profile-btn profile-btn-primary">Simpan</button>
                        <button type="reset" class="profile-btn profile-btn-secondary">Batal</button>
                    </div>
                </form>
            </div>

            <!-- Card Ganti Password -->
            <div class="profile-form-card">
                <h2 class="profile-card-title">Ganti Password</h2>

                <?php if (session()->getFlashdata('errorp')): ?>
                    <div id="errorpAlert" class="profile-alert profile-alert-error">
                        <?= session()->getFlashdata('errorp'); ?>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('successp')): ?>
                    <div id="successpAlert" class="profile-alert profile-alert-success">
                        <?= session()->getFlashdata('successp'); ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('admin/profil/ganti-password') ?>" method="post" id="formGantiPassword">
                    <?= csrf_field() ?>

                    <div class="profile-form-group">
                        <label class="profile-form-label">Password Lama</label>
                        <div class="profile-input-wrapper">
                            <input type="password" name="password_lama" id="passwordLama" 
                                placeholder="Masukkan password lama" 
                                class="profile-form-input" required />
                            <button type="button" class="profile-toggle-password" onclick="togglePassword('passwordLama', this)">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="profile-form-group">
                        <label class="profile-form-label">Password Baru</label>
                        <div class="profile-input-wrapper">
                            <input type="password" name="password_baru" id="passwordBaru" 
                                placeholder="Masukkan password baru" 
                                class="profile-form-input" required />
                            <button type="button" class="profile-toggle-password" onclick="togglePassword('passwordBaru', this)">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <small id="passwordError" class="text-red-600"></small>
                    </div>

                    <div class="profile-form-group">
                        <label class="profile-form-label">Konfirmasi Password Baru</label>
                        <div class="profile-input-wrapper">
                            <input type="password" name="konfirmasi_password" id="konfirmasiPassword" 
                                placeholder="Masukkan konfirmasi" 
                                class="profile-form-input" required />
                            <button type="button" class="profile-toggle-password" onclick="togglePassword('konfirmasiPassword', this)">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <small id="confirmPasswordError" class="text-red-600"></small>
                    </div>

                    <div class="profile-button-group">
                        <button type="submit" class="profile-btn profile-btn-primary">Ubah</button>
                        <button type="reset" class="profile-btn profile-btn-secondary">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Auto-hide alert messages after 3 seconds
    document.querySelectorAll('.profile-alert').forEach(function(el) {
        setTimeout(function() {
            el.style.transition = 'opacity 0.5s ease';
            el.style.opacity = '0';
            setTimeout(function() { el.style.display = 'none'; }, 500);
        }, 3000);
    });

    // Toggle password visibility
    function togglePassword(inputId, button) {
        const input = document.getElementById(inputId);
        const icon = button.querySelector('i');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }

    // Validasi form ganti password
    document.addEventListener("DOMContentLoaded", function() {
        const passwordBaru = document.getElementById("passwordBaru");
        const konfirmasiPassword = document.getElementById("konfirmasiPassword");
        const confirmPasswordError = document.getElementById("confirmPasswordError");
        const passwordError = document.getElementById("passwordError");
        const formGantiPassword = document.getElementById("formGantiPassword");

        function validatePasswordMatch() {
            if (konfirmasiPassword.value !== passwordBaru.value) {
                confirmPasswordError.textContent = "Konfirmasi password tidak sama!";
                return false;
            } else {
                confirmPasswordError.textContent = "";
                return true;
            }
        }
        if (konfirmasiPassword && passwordBaru) {
            konfirmasiPassword.addEventListener("input", validatePasswordMatch);
        }

        if (formGantiPassword) {
            formGantiPassword.addEventListener("submit", function(e) {
                let valid = true;
                if (passwordBaru.value.length < 6) {
                    passwordError.textContent = "Password minimal 6 karakter!";
                    valid = false;
                } else {
                    passwordError.textContent = "";
                }
                if (!validatePasswordMatch()) valid = false;
                if (!valid) e.preventDefault();
            });
        }
    });

    // Konfirmasi Update Profil dengan SweetAlert2
    const formProfil = document.getElementById("formProfil");
    const btnUpdateProfil = document.getElementById("btnUpdateProfil");
    if (btnUpdateProfil && formProfil) {
        btnUpdateProfil.addEventListener("click", function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Update Profil?',
                text: "Perubahan data akan disimpan.",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Simpan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    formProfil.submit();
                }
            });
        });
    }
</script>

<?= $this->endSection() ?>