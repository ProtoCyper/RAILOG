<?= $this->extend('layout/templateAuth'); ?>
<?= $this->section('content') ?>

<h2><?= esc($title) ?> ke Loginkan</h2>
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

<form id="loginForm" action="<?= base_url('loginProcess') ?>" method="post">
    <?= csrf_field() ?>
    <input id="loginEmail" class="form-input" name="email" type="email" placeholder="Masukkan email" />
    <small id="loginEmailError" class="error-text"></small>

    <div class="password-wrapper">
        <input id="loginPasswordInput" class="form-input" name="password" type="password" placeholder="Masukkan password" />
        <span id="toggleLoginPassword" class="toggle-password" title="Show password">
            <svg viewBox="0 5 24 24">
                <path d="M12 5c-7 0-10 7-10 7s3 7 10 7 10-7 10-7-3-7-10-7zm0 12c-2.76 0-5-2.24-5-5s2.24-5 
                    5-5 5 2.24 5 5-2.24 5-5 5zm0-8a3 3 0 100 6 3 3 0 000-6z" />
            </svg>
        </span>
    </div>
    <small id="loginPasswordError" class="error-text"></small>
    <button class="btn" type="submit">Masuk</button>
</form>

<div class="footer-links">
    <a href="<?= base_url('register') ?>">Belum punya akun?</a>
</div>

<div class="copyright">
    © RAILOG – Smart Logistics for Oil & Gas
</div>
</div>



<?= $this->endSection() ?>