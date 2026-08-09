<?= $this->extend('layout/templateUser') ?>
<?= $this->section('content') ?>

<main class="px-8 py-10 max-w-full mx-auto">
  <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
    <!-- Informasi Akun -->
    <div class="bg-white p-8 rounded-lg shadow-lg border">
      <h2 class="text-xl font-bold mb-6">Informasi Akun</h2>
      <?php if (session()->getFlashdata('error')): ?>
        <div id="errorAlert" class="error-message mb-6">
          <?= session()->getFlashdata('error'); ?>
        </div>
      <?php endif; ?>
      <?php if (session()->getFlashdata('success')): ?>
        <div id="successAlert" class="success-message mb-6">
          <?= session()->getFlashdata('success'); ?>
        </div>
      <?php endif; ?>
      <form action="<?= base_url('user/profil/update') ?>" method="post" enctype="multipart/form-data">
        <div class="mb-5">
          <label class="block text-base font-medium text-gray-700 mb-2">Nama</label>
          <input type="text" name="nama" value="<?= $user['nama'] ?>" class="w-full border border-gray-300 px-4 py-3 rounded-lg text-base focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required />
        </div>
        <div class="mb-5">
          <label class="block text-base font-medium text-gray-700 mb-2">Email</label>
          <input type="email" name="email" value="<?= $user['email'] ?>" class="w-full border border-gray-300 px-4 py-3 rounded-lg text-base focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required />
        </div>
        <div class="mb-5">
          <label class="block text-base font-medium text-gray-700 mb-2">No HP</label>
          <input type="text" name="no_hp" value="<?= $user['no_hp'] ?>" class="w-full border border-gray-300 px-4 py-3 rounded-lg text-base focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required />
        </div>

        <!-- Button -->
        <div class="mt-8 flex gap-4">
          <button type="submit" class="bg-gray-800 text-white px-6 py-3 rounded-lg text-base font-medium hover:bg-gray-900 transition">Simpan</button>
          <button type="reset" class="bg-gray-300 text-gray-700 px-6 py-3 rounded-lg text-base font-medium hover:bg-gray-400 transition">Batal</button>
        </div>
      </form>
    </div>

    <!-- Ganti Password -->
    <div class="bg-white p-8 rounded-lg shadow-lg border">
      <h2 class="text-xl font-bold mb-6">Ganti Password</h2>
      <?php if (session()->getFlashdata('errorp')): ?>
        <div id="errorAlert" class="error-message mb-6">
          <?= session()->getFlashdata('errorp'); ?>
        </div>
      <?php endif; ?>
      <?php if (session()->getFlashdata('successp')): ?>
        <div id="successAlert" class="success-message mb-6">
          <?= session()->getFlashdata('successp'); ?>
        </div>
      <?php endif; ?>
      <form action="<?= base_url('user/profil/ganti-password') ?>" method="post">
        <div class="mb-5 relative">
          <label class="block text-base font-medium text-gray-700 mb-2">Password Lama</label>
          <input type="password" name="password_lama" id="passwordLama" placeholder="Masukkan password lama" class="w-full border border-gray-300 px-4 py-3 rounded-lg text-base focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent pr-12" required />
          <span class="toggle-password" id="togglePasswordLama" style="position:absolute;top:50px;right:16px;cursor:pointer;">
            <svg class="icon-hide" viewBox="0 5 24 24" width="24" height="24">
              <path d="M12 5c-7 0-10 7-10 7s3 7 10 7 10-7 10-7-3-7-10-7zm0 12c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8a3 3 0 100 6 3 3 0 000-6z" />
            </svg>
            <svg class="icon-show" viewBox="0 6 24 24" width="24" height="24" style="display:none;">
              <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12zm11 3a3 3 0 100-6 3 3 0 000 6z" fill="#888" />
              <line x1="4" y1="4" x2="20" y2="20" stroke="#e53935" stroke-width="2" />
            </svg>
          </span>
        </div>

        <div class="mb-5 relative">
          <label class="block text-base font-medium text-gray-700 mb-2">Password Baru</label>
          <input type="password" name="password_baru" id="passwordBaru" placeholder="Masukkan password baru" class="w-full border border-gray-300 px-4 py-3 rounded-lg text-base focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent pr-12" required />
          <span class="toggle-password" id="togglePasswordBaru" style="position:absolute;top:50px;right:16px;cursor:pointer;">
            <svg class="icon-hide" viewBox="0 5 24 24" width="24" height="24">
              <path d="M12 5c-7 0-10 7-10 7s3 7 10 7 10-7 10-7-3-7-10-7zm0 12c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8a3 3 0 100 6 3 3 0 000-6z" />
            </svg>
            <svg class="icon-show" viewBox="0 6 24 24" width="24" height="24" style="display:none;">
              <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12zm11 3a3 3 0 100-6 3 3 0 000 6z" fill="#888" />
              <line x1="4" y1="4" x2="20" y2="20" stroke="#e53935" stroke-width="2" />
            </svg>
          </span>
        </div>
        <small id="passwordError" class="error-text block mb-3"></small>

        <!-- Konfirmasi Password Baru -->
        <div class="mb-5 relative">
          <label class="block text-base font-medium text-gray-700 mb-2">Konfirmasi Password Baru</label>
          <input type="password" name="konfirmasi_password" id="konfirmasiPassword" placeholder="Masukkan konfirmasi" class="w-full border border-gray-300 px-4 py-3 rounded-lg text-base focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent pr-12" required />
          <span class="toggle-password" id="toggleKonfirmasiPassword" style="position:absolute;top:50px;right:16px;cursor:pointer;">
            <svg class="icon-hide" viewBox="0 5 24 24" width="24" height="24">
              <path d="M12 5c-7 0-10 7-10 7s3 7 10 7 10-7 10-7-3-7-10-7zm0 12c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8a3 3 0 100 6 3 3 0 000-6z" />
            </svg>
            <svg class="icon-show" viewBox="0 6 24 24" width="24" height="24" style="display:none;">
              <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8S1 12 1 12zm11 3a3 3 0 100-6 3 3 0 000 6z" fill="#888" />
              <line x1="4" y1="4" x2="20" y2="20" stroke="#e53935" stroke-width="2" />
            </svg>
          </span>
        </div>
        <small id="confirmPasswordError" class="error-text block mb-6"></small>

        <div class="flex gap-4">
          <button type="submit" class="bg-gray-800 text-white px-6 py-3 rounded-lg text-base font-medium hover:bg-gray-900 transition">Ubah</button>
          <button type="reset" class="bg-gray-300 text-gray-700 px-6 py-3 rounded-lg text-base font-medium hover:bg-gray-400 transition">Batal</button>
        </div>
      </form>

      <!-- Logout -->
      <form id="logoutForm" action="<?= base_url('user/logout') ?>" method="post" class="mt-10 flex justify-center">
        <button type="submit" id="logoutBtn" class="bg-red-600 text-white px-8 py-4 rounded-lg text-base font-semibold hover:bg-red-700 transition shadow-md">Logout</button>
      </form>
    </div>
  </div>
</main>

<!-- Tambahkan SweetAlert2 CDN sebelum penutup body -->

<?= $this->endSection() ?>