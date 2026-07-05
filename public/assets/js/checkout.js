/*
|--------------------------------------------------------------------------
| BreadShop Checkout Page
|--------------------------------------------------------------------------
| Validasi frontend halaman Checkout.
| Seluruh validasi hanya bertujuan meningkatkan User Experience.
| Validasi utama tetap dilakukan oleh server (PHP).
|--------------------------------------------------------------------------
*/

document.addEventListener("DOMContentLoaded", function () {
  /*
  |--------------------------------------------------------------------------
  | Mengambil Elemen
  |--------------------------------------------------------------------------
  */

  const form = document.querySelector("form");

  const recipientName = document.getElementById("recipient_name");
  const recipientPhone = document.getElementById("recipient_phone");
  const shippingAddress = document.getElementById("shipping_address");
  const note = document.getElementById("note");

  const recipientNameInfo = document.getElementById("recipient-name-info");
  const recipientPhoneInfo = document.getElementById("recipient-phone-info");
  const shippingAddressInfo = document.getElementById("shipping-address-info");
  const noteCounter = document.getElementById("note-counter");

  /*
|--------------------------------------------------------------------------
| Shipping Elements
|--------------------------------------------------------------------------
*/

  const province = document.getElementById("province");
  const city = document.getElementById("city");
  const postalCode = document.getElementById("postal_code");
  const postalCodeInfo = document.createElement("small");

  postalCodeInfo.className = "text-danger d-block mt-1";

  postalCode.parentNode.appendChild(postalCodeInfo);

  /*
|--------------------------------------------------------------------------
| Load Provinsi
|--------------------------------------------------------------------------
*/

  async function loadProvinces() {
    try {
      const response = await fetch("/bakery/public/checkout/provinces");

      const result = await response.json();

      province.innerHTML = '<option value="">-- Pilih Provinsi --</option>';

      result.value.forEach(function (item) {
        province.innerHTML += `
        <option value="${item.id}">
            ${item.name}
        </option>
      `;
      });
    } catch (error) {
      console.error(error);
    }
  }

  /*
|--------------------------------------------------------------------------
| Load Kota
|--------------------------------------------------------------------------
*/

  async function loadCities(provinceId) {
    city.innerHTML = '<option value="">Memuat kota...</option>';

    city.disabled = true;

    postalCode.value = "";

    try {
      const response = await fetch(
        `/bakery/public/checkout/cities/${provinceId}`,
      );

      const result = await response.json();

      city.innerHTML = '<option value="">-- Pilih Kota --</option>';

      result.value.forEach(function (item) {
        city.innerHTML += `
        <option
            value="${item.id}"
            data-postal="${item.postal_code}">
            ${item.name}
        </option>
      `;
      });

      city.disabled = false;
    } catch (error) {
      console.error(error);
    }
  }

  /*
|--------------------------------------------------------------------------
| Ketika Provinsi dipilih
|--------------------------------------------------------------------------
*/

  province.addEventListener("change", function () {
    if (this.value === "") {
      city.disabled = true;

      city.innerHTML = '<option value="">-- Pilih Kota --</option>';

      return;
    }

    loadCities(this.value);
  });

  /*
|--------------------------------------------------------------------------
| Isi kode pos otomatis
|--------------------------------------------------------------------------
*/

  city.addEventListener("change", function () {
    // const option = this.options[this.selectedIndex];

    // postalCode.value = option.dataset.postal ?? "";
    postalCode.focus();
  });

  /*
  |--------------------------------------------------------------------------
  | Nama Penerima
  |--------------------------------------------------------------------------
  | Hanya huruf dan spasi.
  |--------------------------------------------------------------------------
  */

  recipientName.addEventListener("beforeinput", function (event) {
    if (event.data === null) {
      return;
    }

    if (!/^[a-zA-Z\s]+$/.test(event.data)) {
      event.preventDefault();

      recipientNameInfo.textContent =
        "Nama hanya boleh terdiri dari huruf dan spasi.";
    } else {
      recipientNameInfo.textContent = "";
    }
  });

  /*
  |--------------------------------------------------------------------------
  | Nomor HP
  |--------------------------------------------------------------------------
  | Hanya angka.
  |--------------------------------------------------------------------------
  */

  recipientPhone.addEventListener("beforeinput", function (event) {
    if (event.data === null) {
      return;
    }

    if (!/^[0-9]+$/.test(event.data)) {
      event.preventDefault();

      recipientPhoneInfo.textContent =
        "Nomor HP hanya boleh terdiri dari angka.";
    } else {
      recipientPhoneInfo.textContent = "";
    }
  });

  /*
  |--------------------------------------------------------------------------
  | Validasi Panjang Nomor HP
  |--------------------------------------------------------------------------
  */

  recipientPhone.addEventListener("input", function () {
    if (this.value.length === 0) {
      recipientPhoneInfo.textContent = "";
      return;
    }

    if (this.value.length < 10) {
      recipientPhoneInfo.textContent =
        "Nomor HP minimal terdiri dari 10 digit.";
    } else if (this.value.length > 13) {
      recipientPhoneInfo.textContent =
        "Nomor HP maksimal terdiri dari 13 digit.";
    } else {
      recipientPhoneInfo.textContent = "";
    }
  });

  /*
|--------------------------------------------------------------------------
| Kode Pos
|--------------------------------------------------------------------------
*/

  postalCode.addEventListener("input", function () {
    this.value = this.value.replace(/\D/g, "");

    if (this.value.length === 0) {
      postalCodeInfo.textContent = "";

      return;
    }

    if (this.value.length !== 5) {
      postalCodeInfo.textContent = "Kode pos harus terdiri dari 5 digit.";
    } else {
      postalCodeInfo.textContent = "";
    }
  });

  /*
  |--------------------------------------------------------------------------
  | Alamat
  |--------------------------------------------------------------------------
  */

  shippingAddress.addEventListener("input", function () {
    const length = this.value.trim().length;

    if (length === 0) {
      shippingAddressInfo.textContent = "";
      return;
    }

    if (length < 10) {
      shippingAddressInfo.textContent =
        "Alamat minimal terdiri dari 10 karakter.";
    } else {
      shippingAddressInfo.textContent = "";
    }
  });

  /*
  |--------------------------------------------------------------------------
  | Counter Catatan
  |--------------------------------------------------------------------------
  */

  function updateNoteCounter() {
    noteCounter.textContent = note.value.length + " / 255 karakter";
  }

  updateNoteCounter();

  note.addEventListener("input", updateNoteCounter);

  /*
|--------------------------------------------------------------------------
| Validasi Kode Pos
|--------------------------------------------------------------------------
*/

  if (!/^[0-9]{5}$/.test(postalCode.value.trim())) {
    postalCodeInfo.textContent = "Kode pos harus terdiri dari 5 digit.";

    valid = false;
  }

  /*
  |--------------------------------------------------------------------------
  | Validasi Sebelum Submit
  |--------------------------------------------------------------------------
  */

  form.addEventListener("submit", function (event) {
    let valid = true;

    /*
    |--------------------------------------------------------------------------
    | Nama
    |--------------------------------------------------------------------------
    */

    if (!/^[A-Za-z\s]+$/.test(recipientName.value.trim())) {
      recipientNameInfo.textContent =
        "Nama hanya boleh terdiri dari huruf dan spasi.";

      valid = false;
    }

    /*
    |--------------------------------------------------------------------------
    | Nomor HP
    |--------------------------------------------------------------------------
    */

    if (!/^08[0-9]{8,11}$/.test(recipientPhone.value.trim())) {
      recipientPhoneInfo.textContent = "Format nomor HP tidak valid.";

      valid = false;
    }

    /*
    |--------------------------------------------------------------------------
    | Alamat
    |--------------------------------------------------------------------------
    */

    if (shippingAddress.value.trim().length < 10) {
      shippingAddressInfo.textContent =
        "Alamat minimal terdiri dari 10 karakter.";

      valid = false;
    }

    /*
    |--------------------------------------------------------------------------
    | Batalkan Submit
    |--------------------------------------------------------------------------
    */

    if (!valid) {
      event.preventDefault();
    }
  });
  loadProvinces();
});
