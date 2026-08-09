document.addEventListener("DOMContentLoaded", function () {
  // Background image slider
  const backgrounds = ["assets/img/bg1.jpg", "assets/img/bg2.jpg", "assets/img/bg3.jpg"];
  let current = 0;
  const bgDiv = document.querySelector(".background-slider");

  function changeBackground() {
    if (bgDiv) {
      bgDiv.style.backgroundImage = `url('${backgrounds[current]}')`;
      current = (current + 1) % backgrounds.length;
    }
  }
  changeBackground();
  setInterval(changeBackground, 4000);

  // Password toggle
  const eyeIcon = `
    <svg viewBox="0 0 24 24">
      <path d="M12 5c-7 0-10 7-10 7s3 7 10 7 10-7 10-7-3-7-10-7zm0 12c-2.76 0-5-2.24-5-5s2.24-5 
      5-5 5 2.24 5 5-2.24 5-5 5zm0-8a3 3 0 100 6 3 3 0 000-6z"/>
    </svg>`;

  const eyeOffIcon = `
    <svg viewBox="0 0 24 24">
      <path d="M12 6a9.77 9.77 0 018.94 6A9.77 9.77 0 0112 18a9.77 9.77 0 01-8.94-6A9.77 9.77 0 0112 6m0-2C6 4 
      2 12 2 12s4 8 10 8 10-8 10-8-4-8-10-8zm0 5a3 3 0 100 6 3 3 0 000-6z"/>
    </svg>`;

  function setupTogglePassword(toggleId, inputId) {
    const toggle = document.getElementById(toggleId);
    const input = document.getElementById(inputId);
    if (toggle && input) {
      toggle.addEventListener("click", function () {
        const isPassword = input.type === "password";
        input.type = isPassword ? "text" : "password";
        toggle.title = isPassword ? "Hide password" : "Show password";
        // Ubah path SVG saja agar event listener tetap aktif
        const svg = toggle.querySelector("svg");
        if (svg) {
          const path = svg.querySelector("path");
          if (path) {
            path.setAttribute(
              "d",
              isPassword
                ? "M12 6a9.77 9.77 0 018.94 6A9.77 9.77 0 0112 18a9.77 9.77 0 01-8.94-6A9.77 9.77 0 0112 6m0-2C6 4 2 12 2 12s4 8 10 8 10-8 10-8-4-8-10-8zm0 5a3 3 0 100 6 3 3 0 000-6z"
                : "M12 5c-7 0-10 7-10 7s3 7 10 7 10-7 10-7-3-7-10-7zm0 12c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8a3 3 0 100 6 3 3 0 000-6z"
            );
          }
        }
      });
    }
  }

  // Setup untuk semua kemungkinan toggle password
  setupTogglePassword("togglePassword", "passwordInput"); // Register
  setupTogglePassword("toggleConfirmPassword", "confirmPasswordInput"); // Register
  setupTogglePassword("toggleLoginPassword", "loginPasswordInput"); // Login

  // Auto-hide alerts
  setTimeout(() => {
    const success = document.getElementById("successAlert");
    const error = document.getElementById("errorAlert");
    [success, error].forEach((el) => {
      if (el) {
        el.classList.add("fade-out");
        setTimeout(() => el.remove(), 500);
      }
    });
  }, 3500);

  // Ambil elemen form
  const loginForm = document.getElementById("loginForm");
  const registerForm = document.getElementById("registerForm");

  // Ambil elemen input umum
  const email = document.getElementById("email");
  const emailError = document.getElementById("emailError");
  const passwordError = document.getElementById("passwordError");

  function validateEmail() {
    if (!email) return;
    const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,}$/i;
    if (!emailPattern.test(email.value.trim())) {
      emailError.innerText = "Email tidak valid.";
      email.classList.add("invalid");
    } else {
      emailError.innerText = "";
      email.classList.remove("invalid");
    }
  }

  // Event listener umum
  if (email) email.addEventListener("input", validateEmail);

  // Register form
  if (registerForm) {
    const nama = document.getElementById("nama");
    const password = document.getElementById("passwordInput");
    const confirmPassword = document.getElementById("confirmPasswordInput");
    const no_hp = document.getElementById("no_hp");

    const namaError = document.getElementById("namaError");
    const confirmPasswordError = document.getElementById(
      "confirmPasswordError"
    );
    const nohpError = document.getElementById("nohpError");

    function validateNama() {
      if (nama.value.trim() === "") {
        namaError.innerText = "Nama wajib diisi.";
        nama.classList.add("invalid");
      } else {
        namaError.innerText = "";
        nama.classList.remove("invalid");
      }
    }

    function validatePassword() {
      if (password.value.length < 8) {
        passwordError.innerText = "Password minimal 8 karakter.";
        password.classList.add("invalid");
      } else {
        passwordError.innerText = "";
        password.classList.remove("invalid");
      }
    }

    function validateConfirmPassword() {
      if (confirmPassword.value === "") {
        confirmPasswordError.innerText = "Konfirmasi password wajib diisi.";
        confirmPassword.classList.add("invalid");
      } else if (confirmPassword.value !== password.value) {
        confirmPasswordError.innerText = "Konfirmasi password tidak sama.";
        confirmPassword.classList.add("invalid");
      } else {
        confirmPasswordError.innerText = "";
        confirmPassword.classList.remove("invalid");
      }
    }

    function validateNoHp() {
      const noHpPattern = /^\d{10,}$/;
      if (!noHpPattern.test(no_hp.value.trim())) {
        nohpError.innerText = "No HP harus berupa angka minimal 10 digit.";
        no_hp.classList.add("invalid");
      } else {
        nohpError.innerText = "";
        no_hp.classList.remove("invalid");
      }
    }

    nama.addEventListener("input", validateNama);
    password.addEventListener("input", validatePassword);
    // Pastikan validasi konfirmasi password dipanggil setiap kali password atau konfirmasi password berubah
    password.addEventListener("input", function () {
      validatePassword();
      validateConfirmPassword();
    });
    confirmPassword.addEventListener("input", function () {
      validateConfirmPassword();
    });
    no_hp.addEventListener("input", function () {
      no_hp.value = no_hp.value.replace(/[^0-9]/g, "");
      validateNoHp();
    });

    registerForm.addEventListener("submit", function (event) {
      validateNama();
      validateEmail();
      validatePassword();
      validateConfirmPassword();
      validateNoHp();

      const fields = [nama, email, password, confirmPassword, no_hp];
      let hasInvalid = false;
      fields.forEach((input) => {
        if (input && input.classList.contains("invalid")) {
          input.classList.add("shake");
          hasInvalid = true;
          setTimeout(() => input.classList.remove("shake"), 400);
        }
      });

      if (hasInvalid) {
        event.preventDefault();
      } else {
        // Konfirmasi dengan SweetAlert sebelum submit
        event.preventDefault(); // Mencegah pengiriman form default
        Swal.fire({
          title: "Konfirmasi Pendaftaran",
          text: "Apakah Anda yakin dengan data yang dimasukkan?",
          icon: "question",
          showCancelButton: true,
          confirmButtonText: "Ya, Daftar",
          cancelButtonText: "Batal",
        }).then((result) => {
          if (result.isConfirmed) {
            registerForm.submit(); // Kirim form jika dikonfirmasi
          }
        });
      }
    });
  }

  // Login form
  if (loginForm) {
    const loginEmail = document.getElementById("loginEmail");
    const loginEmailError = document.getElementById("loginEmailError");
    const loginPassword = document.getElementById("loginPasswordInput");
    const loginPasswordError = document.getElementById("loginPasswordError");

    function validateLoginEmail() {
      if (!loginEmail) return;
      const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,}$/i;
      if (!emailPattern.test(loginEmail.value.trim())) {
        loginEmailError.innerText = "Email tidak valid.";
        loginEmail.classList.add("invalid");
      } else {
        loginEmailError.innerText = "";
        loginEmail.classList.remove("invalid");
      }
    }

    function validatePassword() {
      if (loginPassword.value.length < 8) {
        loginPasswordError.innerText = "Password minimal 8 karakter.";
        loginPassword.classList.add("invalid");
      } else {
        loginPasswordError.innerText = "";
        loginPassword.classList.remove("invalid");
      }
    }

    if (loginEmail) loginEmail.addEventListener("input", validateLoginEmail);
    loginPassword.addEventListener("input", validatePassword);

    loginForm.addEventListener("submit", function (event) {
      validateLoginEmail();
      validatePassword();

      const fields = [loginEmail, loginPassword];
      let hasInvalid = false;
      fields.forEach((input) => {
        if (input && input.classList.contains("invalid")) {
          input.classList.add("shake");
          hasInvalid = true;
          setTimeout(() => input.classList.remove("shake"), 400);
        }
      });

      if (hasInvalid) {
        event.preventDefault();
      }
    });
  }
});
