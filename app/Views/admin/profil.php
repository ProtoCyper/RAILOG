<?= $this->extend('layout/templateAdmin') ?>

<?= $this->section('content') ?>

<!-- Main Content -->
<div class="main-content">


  <!-- Content Area -->
  <div class="content-area">
    <div class="content-grid">
      <!-- Informasi Akun -->
      <div class="content-card">
        <div class="card-header">
          <h2 class="card-title">Informasi Akun</h2>
        </div>

        <!-- Flashdata -->
        <?php if (session()->getFlashdata('error')): ?>
          <div class="error-message bg-red-100 text-red-700 p-2 rounded mb-3">
            <?= session()->getFlashdata('error'); ?>
          </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('success')): ?>
          <div class="success-message bg-green-100 text-green-700 p-2 rounded mb-3">
            <?= session()->getFlashdata('success'); ?>
          </div>
        <?php endif; ?>

        <form id="formProfil" action="<?= base_url('admin/profil/update') ?>" method="post" enctype="multipart/form-data">
          <?= csrf_field() ?>
          <div class="mb-3">
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
            <input type="text" name="nama" value="<?= esc($admin['nama']) ?>" class="w-full border border-gray-300 px-3 py-2 rounded text-sm" required>
            <?php if (session()->getFlashdata('error_nama')): ?>
              <small class="text-red-600"><?= session()->getFlashdata('error_nama'); ?></small>
            <?php endif; ?>
          </div>

          <div class="mb-3">
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" name="email" value="<?= esc($admin['email']) ?>" class="w-full border border-gray-300 px-3 py-2 rounded text-sm" required>
            <?php if (session()->getFlashdata('error_email')): ?>
              <small class="text-red-600"><?= session()->getFlashdata('error_email'); ?></small>
            <?php endif; ?>
          </div>

          <!-- Button -->
          <div class="mt-6 flex gap-3">
            <button type="submit" id="btnUpdateProfil" class="bg-gray-800 text-white px-4 py-2 rounded text-sm">Simpan</button>
            <button type="reset" class="bg-gray-300 text-gray-700 px-4 py-2 rounded text-sm">Batal</button>
          </div>
        </form>
      </div>

      <!-- Ganti Password & Logout -->
      <div class="content-card">
        <div class="card-header">
          <h2 class="card-title">Ganti Password</h2>
        </div>

        <!-- Flashdata -->
<?php if (session()->getFlashdata('errorp')): ?>
  <div id="alertError" class="bg-red-100 text-red-700 p-2 rounded mb-3">
    <?= session()->getFlashdata('errorp'); ?>
  </div>
<?php endif; ?>

<?php if (session()->getFlashdata('successp')): ?>
  <div id="alertSuccess" class="bg-green-100 text-green-700 p-2 rounded mb-3">
    <?= session()->getFlashdata('successp'); ?>
  </div>
<?php endif; ?>


<form action="<?= base_url('admin/profil/ganti-password') ?>" method="post" id="formGantiPassword">
  <?= csrf_field() ?>

  <!-- Password Lama -->
  <div class="mb-3 relative">
    <label class="block text-sm font-medium text-gray-700 mb-1">Password Lama</label>
    <input type="password" name="password_lama" placeholder="Masukkan password lama" class="w-full border border-gray-300 px-3 py-2 rounded text-sm" required>
    <span class="toggle-password absolute top-9 right-3 cursor-pointer">
      <i class="fas fa-eye"></i>
    </span>
  </div>

  <!-- Password Baru -->
  <div class="mb-3 relative">
    <label class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
    <input type="password" name="password_baru" id="passwordBaru" placeholder="Masukkan password baru" class="w-full border border-gray-300 px-3 py-2 rounded text-sm" required>
    <span class="toggle-password absolute top-9 right-3 cursor-pointer">
      <i class="fas fa-eye"></i>
    </span>
    <small id="passwordError" class="text-red-600"></small>
  </div>

  <!-- Konfirmasi Password -->
  <div class="mb-4 relative">
    <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password Baru</label>
    <input type="password" name="konfirmasi_password" id="konfirmasiPassword" placeholder="Masukkan konfirmasi" class="w-full border border-gray-300 px-3 py-2 rounded text-sm" required>
    <span class="toggle-password absolute top-9 right-3 cursor-pointer">
      <i class="fas fa-eye"></i>
    </span>
    <small id="confirmPasswordError" class="text-red-600"></small>
  </div>

  <div class="flex gap-3">
    <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded text-sm">Ubah</button>
    <button type="reset" class="bg-gray-300 text-gray-700 px-4 py-2 rounded text-sm">Batal</button>
  </div>
</form>

</div>
</div>
</div>
</div>


<!-- Script -->
<script>
  document.addEventListener("DOMContentLoaded", function() {
    // ✅ Flash message auto hide
    const alertError = document.getElementById("alertError");
    const alertSuccess = document.getElementById("alertSuccess");

    [alertError, alertSuccess].forEach(alert => {
      if (alert) {
        setTimeout(() => {
          alert.style.transition = "opacity 0.5s ease";
          alert.style.opacity = "0";
          setTimeout(() => alert.remove(), 500);
        }, 3000);
      }
    });

    // ✅ Toggle show/hide password
    document.querySelectorAll(".toggle-password").forEach(function(toggle) {
      toggle.addEventListener("click", function() {
        const input = this.previousElementSibling;
        const icon = this.querySelector("i");

        if (input.type === "password") {
          input.type = "text";
          icon.classList.remove("fa-eye");
          icon.classList.add("fa-eye-slash");
        } else {
          input.type = "password";
          icon.classList.remove("fa-eye-slash");
          icon.classList.add("fa-eye");
        }
      });
    });

    // ✅ Validasi password baru
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
    konfirmasiPassword.addEventListener("input", validatePasswordMatch);

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
  });

  // ✅ Konfirmasi Update Profil
  const formProfil = document.getElementById("formProfil");
  const btnUpdateProfil = document.getElementById("btnUpdateProfil");
  if (btnUpdateProfil) {
    btnUpdateProfil.addEventListener("click", function(e) {
      e.preventDefault();
      Swal.fire({
        title: 'Update Profil?',
        text: "Perubahan data akan disimpan.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Simpan'
      }).then((result) => {
        if (result.isConfirmed) {
          formProfil.submit();
        }
      });
    });
  }
</script>

<?= $this->endSection() ?>