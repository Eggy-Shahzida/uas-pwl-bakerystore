/*
|--------------------------------------------------------------------------
| BreadShop Register Page
|--------------------------------------------------------------------------
| File ini hanya digunakan oleh halaman Register.
| Seluruh validasi frontend ditempatkan di sini agar View tetap bersih.
|--------------------------------------------------------------------------
*/

document.addEventListener("DOMContentLoaded", function () {
  /*
    |--------------------------------------------------------------------------
    | Mengambil Elemen Form
    |--------------------------------------------------------------------------
    */

  const nameInput = document.getElementById("name");

  const nameInfo = document.getElementById("name-info");

  const passwordInput = document.getElementById("password");

  const confirmPasswordInput = document.getElementById("confirm_password");

  const confirmPasswordInfo = document.getElementById("confirm-password-info");

  /*
    |--------------------------------------------------------------------------
    | Password Strength
    |--------------------------------------------------------------------------
    */

  const strengthBar = document.getElementById("password-strength-bar");

  const strengthText = document.getElementById("password-strength-text");

  /*
    |--------------------------------------------------------------------------
    | Show / Hide Password
    |--------------------------------------------------------------------------
    */

  const togglePasswordButton = document.getElementById("toggle-password");

  const passwordIcon = document.getElementById("password-icon");

  const toggleConfirmPasswordButton = document.getElementById(
    "toggle-confirm-password",
  );

  const confirmPasswordIcon = document.getElementById("confirm-password-icon");

  /*
    |--------------------------------------------------------------------------
    | Validasi Nama Lengkap
    |--------------------------------------------------------------------------
    | Hanya memperbolehkan:
    | - Huruf
    | - Spasi
    |--------------------------------------------------------------------------
    */

  nameInput.addEventListener("beforeinput", function (event) {
    /*
        |--------------------------------------------------------------------------
        | Backspace / Delete
        |--------------------------------------------------------------------------
        */

    if (event.data === null) {
      return;
    }

    /*
        |--------------------------------------------------------------------------
        | Selain huruf dan spasi ditolak
        |--------------------------------------------------------------------------
        */

    if (!/^[a-zA-Z\s]+$/.test(event.data)) {
      event.preventDefault();

      nameInfo.textContent = "Nama hanya boleh terdiri dari huruf dan spasi.";
    } else {
      nameInfo.textContent = "";
    }
  });

  /*
    |--------------------------------------------------------------------------
    | Password Strength Meter
    |--------------------------------------------------------------------------
    */

  passwordInput.addEventListener("input", function () {
    const password = this.value;

    let score = 0;

    /*
        |--------------------------------------------------------------------------
        | Minimal 8 karakter
        |--------------------------------------------------------------------------
        */

    if (password.length >= 8) {
      score++;
    }

    /*
        |--------------------------------------------------------------------------
        | Huruf kecil
        |--------------------------------------------------------------------------
        */

    if (/[a-z]/.test(password)) {
      score++;
    }

    /*
        |--------------------------------------------------------------------------
        | Huruf besar
        |--------------------------------------------------------------------------
        */

    if (/[A-Z]/.test(password)) {
      score++;
    }

    /*
        |--------------------------------------------------------------------------
        | Angka
        |--------------------------------------------------------------------------
        */

    if (/[0-9]/.test(password)) {
      score++;
    }

    /*
        |--------------------------------------------------------------------------
        | Simbol
        |--------------------------------------------------------------------------
        */

    if (/[^A-Za-z0-9]/.test(password)) {
      score++;
    }

    updateStrength(score);

    validateConfirmPassword();
  });

  /*
    |--------------------------------------------------------------------------
    | Mengubah Tampilan Password Strength
    |--------------------------------------------------------------------------
    */

  function updateStrength(score) {
    switch (score) {
      case 0:
        strengthBar.style.width = "0%";

        strengthBar.className = "progress-bar";

        strengthText.textContent = "Password belum diisi.";

        break;

      case 1:
        strengthBar.style.width = "20%";

        strengthBar.className = "progress-bar bg-danger";

        strengthText.textContent = "Password sangat lemah.";

        break;

      case 2:
        strengthBar.style.width = "40%";

        strengthBar.className = "progress-bar bg-warning";

        strengthText.textContent = "Password lemah.";

        break;

      case 3:
        strengthBar.style.width = "60%";

        strengthBar.className = "progress-bar bg-info";

        strengthText.textContent = "Password sedang.";

        break;

      case 4:
        strengthBar.style.width = "80%";

        strengthBar.className = "progress-bar bg-primary";

        strengthText.textContent = "Password kuat.";

        break;

      case 5:
        strengthBar.style.width = "100%";

        strengthBar.className = "progress-bar bg-success";

        strengthText.textContent = "Password sangat kuat.";

        break;
    }
  }

  /*
    |--------------------------------------------------------------------------
    | Show / Hide Password
    |--------------------------------------------------------------------------
    |
    | Fungsi ini digunakan untuk mengubah tipe input password
    | menjadi text dan sebaliknya.
    | Fungsi ini bersifat reusable sehingga dapat digunakan oleh
    | Password maupun Konfirmasi Password.
    |--------------------------------------------------------------------------
    */

  function togglePassword(inputElement, iconElement) {
    const isHidden = inputElement.type === "password";

    inputElement.type = isHidden ? "text" : "password";

    iconElement.classList.toggle("bi-eye", !isHidden);

    iconElement.classList.toggle("bi-eye-slash", isHidden);
  }

  /*
    |--------------------------------------------------------------------------
    | Event Show / Hide Password
    |--------------------------------------------------------------------------
    */

  togglePasswordButton.addEventListener("click", function () {
    togglePassword(passwordInput, passwordIcon);
  });

  /*
    |--------------------------------------------------------------------------
    | Event Show / Hide Konfirmasi Password
    |--------------------------------------------------------------------------
    */

  toggleConfirmPasswordButton.addEventListener("click", function () {
    togglePassword(confirmPasswordInput, confirmPasswordIcon);
  });

  /*
    |--------------------------------------------------------------------------
    | Event Input Konfirmasi Password
    |--------------------------------------------------------------------------
    |
    | Setiap kali pengguna mengetik pada kolom konfirmasi password,
    | lakukan pengecekan apakah password sudah sama.
    |--------------------------------------------------------------------------
    */

  confirmPasswordInput.addEventListener("input", function () {
    validateConfirmPassword();
  });

  /*
    |--------------------------------------------------------------------------
    | Validasi Konfirmasi Password
    |--------------------------------------------------------------------------
    */

  function validateConfirmPassword() {
    const password = passwordInput.value;

    const confirmPassword = confirmPasswordInput.value;

    /*
        |--------------------------------------------------------------------------
        | Jika kolom konfirmasi masih kosong
        |--------------------------------------------------------------------------
        */

    if (confirmPassword === "") {
      confirmPasswordInfo.textContent = "";

      confirmPasswordInfo.className = "d-block mt-1 text-muted";

      return;
    }

    /*
        |--------------------------------------------------------------------------
        | Password cocok
        |--------------------------------------------------------------------------
        */

    if (password === confirmPassword) {
      confirmPasswordInfo.textContent = "✓ Password cocok.";

      confirmPasswordInfo.className = "d-block mt-1 text-success";
    } else {

    /*
        |--------------------------------------------------------------------------
        | Password tidak cocok
        |--------------------------------------------------------------------------
        */
      confirmPasswordInfo.textContent = "✗ Password tidak cocok.";

      confirmPasswordInfo.className = "d-block mt-1 text-danger";
    }
  }
});
