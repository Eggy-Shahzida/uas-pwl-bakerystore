/*
|--------------------------------------------------------------------------
| BreadShop Shipping Page
|--------------------------------------------------------------------------
| Mengelola perubahan biaya pengiriman dan total pembayaran secara
| real-time ketika pengguna memilih metode pengiriman.
|--------------------------------------------------------------------------
*/

document.addEventListener("DOMContentLoaded", function () {
  /*
  |--------------------------------------------------------------------------
  | Mengambil Elemen
  |--------------------------------------------------------------------------
  */

  const shippingOptions = document.querySelectorAll(
    'input[name="shipping_method"]',
  );

  const shippingCostElement = document.getElementById("shipping-cost");

  const grandTotalElement = document.getElementById("grand-total");

  /*
  |--------------------------------------------------------------------------
  | Pastikan elemen tersedia
  |--------------------------------------------------------------------------
  */

  if (
    shippingOptions.length === 0 ||
    !shippingCostElement ||
    !grandTotalElement
  ) {
    return;
  }

  /*
  |--------------------------------------------------------------------------
  | Mengambil subtotal awal
  |--------------------------------------------------------------------------
  */

  const subtotal = parseInt(grandTotalElement.dataset.subtotal, 10);

  /*
  |--------------------------------------------------------------------------
  | Format Rupiah
  |--------------------------------------------------------------------------
  */

  function formatRupiah(number) {
    return "Rp " + number.toLocaleString("id-ID");
  }

  /*
  |--------------------------------------------------------------------------
  | Update Ringkasan
  |--------------------------------------------------------------------------
  */

  function updateSummary() {
    const selected = document.querySelector(
      'input[name="shipping_method"]:checked',
    );

    if (!selected) {
      return;
    }

    const shippingCost = parseInt(selected.dataset.cost, 10);

    const grandTotal = subtotal + shippingCost;

    shippingCostElement.textContent = formatRupiah(shippingCost);

    grandTotalElement.textContent = formatRupiah(grandTotal);
  }

  /*
  |--------------------------------------------------------------------------
  | Event Radio Button
  |--------------------------------------------------------------------------
  */

  shippingOptions.forEach(function (option) {
    option.addEventListener("change", updateSummary);
  });

  /*
  |--------------------------------------------------------------------------
  | Hitung pertama kali
  |--------------------------------------------------------------------------
  */

  updateSummary();
});
