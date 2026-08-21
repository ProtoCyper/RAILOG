<?= $this->extend('layout/templateUser') ?>
<?= $this->section('content') ?>

<style>
    /* Page Wrapper */
    .profile-page-wrapper {
        margin-left: 280px;
        background-color: #f0f2f5;
        min-height: 100vh;
    }

    .profile-page-header {
        background: white;
        padding: 1.5rem 2rem;
        border-bottom: 1px solid #e5e7eb;
    }

    .profile-page-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1f2937;
        margin: 0;
    }

    .profile-page-subtitle {
        font-size: 0.875rem;
        color: #6b7280;
        margin: 0.25rem 0 0 0;
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

    .profile-btn-danger {
        background: #dc2626;
        color: white;
        width: 100%;
        padding: 0.75rem 1.5rem;
    }

    .profile-btn-danger:hover {
        background: #b91c1c;
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

    /* Logout Section */
    .profile-logout-section {
        margin-top: 2rem;
        padding-top: 2rem;
        border-top: 1px solid #e5e7eb;
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
    <!-- Page Header -->
    <div class="profile-page-header">
        <h1 class="profile-page-title"><?= esc($user['nama']) ?></h1>
        <p class="profile-page-subtitle">Kelola informasi akun dan keamanan Anda</p>
    </div>

    <div class="profile-content">
        <div class="profile-grid">
            <!-- Card Informasi Akun -->
            <div class="profile-form-card">
                <h2 class="profile-card-title">Informasi Akun</h2>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="profile-alert profile-alert-error">
                        <?= session()->getFlashdata('error'); ?>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="profile-alert profile-alert-success">
                        <?= session()->getFlashdata('success'); ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('user/profil/update') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    
                    <div class="profile-form-group">
                        <label class="profile-form-label">Nama</label>
                        <input type="text" name="nama" value="<?= esc($user['nama']) ?>" 
                            class="profile-form-input" required />
                    </div>

                    <div class="profile-form-group">
                        <label class="profile-form-label">Email</label>
                        <input type="email" name="email" value="<?= esc($user['email']) ?>" 
                            class="profile-form-input" required />
                    </div>

                    <div class="profile-form-group">
                        <label class="profile-form-label">No HP</label>
                        <input type="text" name="no_hp" value="<?= esc($user['no_hp']) ?>" 
                            class="profile-form-input" required />
                    </div>

                    <div class="profile-button-group">
                        <button type="submit" class="profile-btn profile-btn-primary">Simpan</button>
                        <button type="reset" class="profile-btn profile-btn-secondary">Batal</button>
                    </div>
                </form>
            </div>

            <!-- Card Ganti Password -->
            <div class="profile-form-card">
                <h2 class="profile-card-title">Ganti Password</h2>

                <?php if (session()->getFlashdata('errorp')): ?>
                    <div class="profile-alert profile-alert-error">
                        <?= session()->getFlashdata('errorp'); ?>
                    </div>
                <?php endif; ?>
                <?php if (session()->getFlashdata('successp')): ?>
                    <div class="profile-alert profile-alert-success">
                        <?= session()->getFlashdata('successp'); ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('user/profil/ganti-password') ?>" method="post">
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
                    </div>

                    <div class="profile-button-group">
                        <button type="submit" class="profile-btn profile-btn-primary">Ubah</button>
                        <button type="reset" class="profile-btn profile-btn-secondary">Batal</button>
                    </div>
                </form>

                <!-- Logout Section -->
                <div class="profile-logout-section">
                    <a href="<?= base_url('user/logout') ?>" id="profileLogoutBtn" class="profile-btn profile-btn-danger" style="display:block; text-align:center; text-decoration:none;">Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
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

    // Confirm logout (sama seperti admin - menggunakan SweetAlert2)
    document.getElementById('profileLogoutBtn')?.addEventListener('click', function(e) {
        e.preventDefault();

        Swal.fire({
            title: 'Yakin ingin logout?',
            text: 'Kamu akan keluar dari sesi sekarang.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Logout',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = this.href;
            }
        });
    });
</script>

<?= $this->endSection() ?>
