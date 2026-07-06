/*
|--------------------------------------------------------------------------
| BreadShop Checkout
|--------------------------------------------------------------------------
*/

document.addEventListener("DOMContentLoaded", () => {
  console.log("checkout.js loaded");

  const form = document.querySelector("form");

  const recipientName = document.getElementById("recipient_name");
  const recipientPhone = document.getElementById("recipient_phone");
  const shippingAddress = document.getElementById("shipping_address");
  const postalCode = document.getElementById("postal_code");
  const note = document.getElementById("note");

  const province = document.getElementById("province");
  const city = document.getElementById("city");

  const recipientNameInfo = document.getElementById("recipient-name-info");
  const recipientPhoneInfo = document.getElementById("recipient-phone-info");
  const shippingAddressInfo = document.getElementById("shipping-address-info");
  const noteCounter = document.getElementById("note-counter");

  const postalCodeInfo = document.createElement("small");
  postalCodeInfo.className = "text-danger d-block mt-1";
  postalCode.parentNode.appendChild(postalCodeInfo);

  /*
  |--------------------------------------------------------------------------
  | Load Province
  |--------------------------------------------------------------------------
  */

  async function loadProvinces() {
    province.disabled = true;

    province.innerHTML = '<option value="">Memuat provinsi...</option>';

    try {
      const response = await fetch(BASE_URL + "/checkout/provinces");

      const result = await response.json();

      console.log(result);

      province.innerHTML = '<option value="">-- Pilih Provinsi --</option>';

      if (Array.isArray(result.data)) {
        result.data.forEach((item) => {
          province.innerHTML += `
                    <option value="${item.id}">
                        ${item.name}
                    </option>
                `;
        });
      } else {
        console.error("result.data bukan array", result);
      }

      province.disabled = false;
    } catch (err) {
      console.error(err);

      province.innerHTML = '<option value="">Gagal memuat provinsi</option>';
    }
  }

  /*
  |--------------------------------------------------------------------------
  | Load City
  |--------------------------------------------------------------------------
  */

  async function loadCities(provinceId) {
    city.disabled = true;

    city.innerHTML = '<option value="">Loading...</option>';

    try {
      const response = await fetch(
        BASE_URL + "/checkout/cities?province_id=" + provinceId,
      );

      const result = await response.json();

      console.log(result);

      city.innerHTML = '<option value="">-- Pilih Kota --</option>';

      if (Array.isArray(result.data)) {
        result.data.forEach((item) => {
          city.innerHTML += `
            <option value="${item.id}">
              ${item.name}
            </option>
          `;
        });
      }

      city.disabled = false;
    } catch (err) {
      console.error(err);

      city.innerHTML = '<option value="">Gagal memuat kota</option>';
    }
  }

  province.addEventListener("change", function () {
    postalCode.value = "";

    if (this.value === "") {
      city.disabled = true;
      city.innerHTML = '<option value="">-- Pilih Kota --</option>';
      return;
    }

    loadCities(this.value);
  });

  recipientName.addEventListener("beforeinput", (e) => {
    if (e.data === null) return;

    if (!/^[A-Za-z\s]+$/.test(e.data)) {
      e.preventDefault();
      recipientNameInfo.textContent =
        "Nama hanya boleh terdiri dari huruf dan spasi.";
    } else {
      recipientNameInfo.textContent = "";
    }
  });

  recipientPhone.addEventListener("beforeinput", (e) => {
    if (e.data === null) return;

    if (!/^[0-9]+$/.test(e.data)) {
      e.preventDefault();
      recipientPhoneInfo.textContent = "Nomor HP hanya boleh berupa angka.";
    } else {
      recipientPhoneInfo.textContent = "";
    }
  });

  recipientPhone.addEventListener("input", function () {
    if (this.value.length < 10) {
      recipientPhoneInfo.textContent = "Minimal 10 digit.";
    } else if (this.value.length > 13) {
      recipientPhoneInfo.textContent = "Maksimal 13 digit.";
    } else {
      recipientPhoneInfo.textContent = "";
    }
  });

  postalCode.addEventListener("input", function () {
    this.value = this.value.replace(/\D/g, "");

    if (this.value.length > 0 && this.value.length !== 5) {
      postalCodeInfo.textContent = "Kode pos harus terdiri dari 5 digit.";
    } else {
      postalCodeInfo.textContent = "";
    }
  });

  shippingAddress.addEventListener("input", function () {
    if (this.value.trim().length < 10) {
      shippingAddressInfo.textContent = "Alamat minimal 10 karakter.";
    } else {
      shippingAddressInfo.textContent = "";
    }
  });

  function updateCounter() {
    noteCounter.textContent = `${note.value.length} / 255 karakter`;
  }

  updateCounter();

  note.addEventListener("input", updateCounter);

  form.addEventListener("submit", (e) => {
    let valid = true;

    if (!/^[A-Za-z\s]+$/.test(recipientName.value.trim())) {
      valid = false;
    }

    if (!/^08[0-9]{8,11}$/.test(recipientPhone.value.trim())) {
      valid = false;
    }

    if (province.value === "") {
      valid = false;
    }

    if (city.value === "") {
      valid = false;
    }

    if (!/^[0-9]{5}$/.test(postalCode.value.trim())) {
      valid = false;
    }

    if (shippingAddress.value.trim().length < 10) {
      valid = false;
    }

    if (!valid) {
      e.preventDefault();
    }
  });

  loadProvinces();
});
