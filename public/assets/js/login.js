/*
|--------------------------------------------------------------------------
| BreadShop Login Page
|--------------------------------------------------------------------------
| File ini hanya digunakan oleh halaman Login.
| Berisi validasi frontend sederhana dan fitur show/hide password.
|--------------------------------------------------------------------------
*/

document.addEventListener("DOMContentLoaded", function () {
  /*
    |--------------------------------------------------------------------------
    | Mengambil Elemen
    |--------------------------------------------------------------------------
    */

  const loginForm = document.querySelector("form");

  const emailInput = document.getElementById("email");

  const passwordInput = document.getElementById("password");

  const togglePasswordButton = document.getElementById("toggle-password");

  const passwordIcon = document.getElementById("password-icon");

  /*
    |--------------------------------------------------------------------------
    | Show / Hide Password
    |--------------------------------------------------------------------------
    */

  togglePasswordButton.addEventListener("click", function () {
    const isHidden = passwordInput.type === "password";

    passwordInput.type = isHidden ? "text" : "password";

    passwordIcon.classList.toggle("bi-eye", !isHidden);

    passwordIcon.classList.toggle("bi-eye-slash", isHidden);
  });

  /*
    |--------------------------------------------------------------------------
    | Validasi Form Sebelum Submit
    |--------------------------------------------------------------------------
    */

  loginForm.addEventListener("submit", function (event) {
    const email = emailInput.value.trim();

    const password = passwordInput.value.trim();

    /*
        |--------------------------------------------------------------------------
        | Email kosong
        |--------------------------------------------------------------------------
        */

    if (email === "") {
      event.preventDefault();

      alert("Email wajib diisi.");

      emailInput.focus();

      return;
    }

    /*
        |--------------------------------------------------------------------------
        | Password kosong
        |--------------------------------------------------------------------------
        */

    if (password === "") {
      event.preventDefault();

      alert("Password wajib diisi.");

      passwordInput.focus();

      return;
    }
  });
});
