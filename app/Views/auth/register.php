<?= $this->extend('layout/templateAuth'); ?>
<?= $this->section('content') ?>

<h2><?= esc($title) ?> Akun Baru</h2>

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

<form id="registerForm" action="<?= base_url('registerProcess') ?>" method="post" novalidate>
    <?= csrf_field() ?>
    <input class="form-input" name="nama" id="nama" type="text" placeholder="Masukkan nama" required />
    <small id="namaError" class="error-text"></small>

    <input class="form-input" name="email" id="email" type="email" placeholder="Masukkan email" required />
    <small id="emailError" class="error-text"></small>

    <div class="password-wrapper">
        <input id="passwordInput" type="password" class="form-input" name="password" placeholder="Masukkan password" required />
        <span id="togglePassword" class="toggle-password" title="Show password">
            <svg viewBox="0 5    24 24">
                <path d="M12 5c-7 0-10 7-10 7s3 7 10 7 10-7 10-7-3-7-10-7zm0 12c-2.76 0-5-2.24-5-5s2.24-5 
                    5-5 5 2.24 5 5-2.24 5-5 5zm0-8a3 3 0 100 6 3 3 0 000-6z" />
            </svg>
        </span>
    </div>
    <small id="passwordError" class="error-text"></small>

    <!-- Konfirmasi Password -->
    <div class="password-wrapper">
        <input id="confirmPasswordInput" type="password" class="form-input" name="confirm_password" placeholder="Konfirmasi password" required />
        <span id="toggleConfirmPassword" class="toggle-password" title="Show password">
            <svg viewBox="0 5 24 24">
                <path d="M12 5c-7 0-10 7-10 7s3 7 10 7 10-7 10-7-3-7-10-7zm0 12c-2.76 0-5-2.24-5-5s2.24-5 
                    5-5 5 2.24 5 5-2.24 5-5 5zm0-8a3 3 0 100 6 3 3 0 000-6z" />
            </svg>
        </span>
    </div>
    <small id="confirmPasswordError" class="error-text"></small>

    <input class="form-input" name="no_hp" id="no_hp" type="text" placeholder="Masukkan nomor HP" required />
    <small id="nohpError" class="error-text"></small>

    <button class="btn" type="submit">Daftar</button>
</form>

<div class="footer-links">
    <a href="<?= base_url('/') ?>">Sudah mempunyai akun</a>
</div>

<div class="copyright">
    © CargoWing – Powered by your logistics in flight
</div>

<?= $this->endSection() ?>