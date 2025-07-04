// Gửi cart và kiểm tra địa chỉ + phường
document.getElementById("checkout-form").addEventListener("submit", function (e) {
  const wardInput = document.getElementById("ward");
  const addressInput = document.getElementById("address");
  const ward = wardInput.value.trim();
  const addressValue = addressInput.value.trim();

  const allowedWards = [
    "Phường Bình Thạnh", "Phường Tân Sơn Nhất", "Phường Cầu Kiệu",
    "Phường An Nhơn", "Phường Hạnh Thông", "Phường Sài Gòn",
    "Phường Minh Phụng", "Phường Tân Sơn Hòa", "Phường Phú Nhuận",
    "Phường An Hội Đông"
  ];

  const validAddressRegex = /^\d[\d\/\-]{0,10}\s+[\p{L}\s\d'.\-]{3,}$/u;

  if (!allowedWards.includes(ward)) {
    e.preventDefault();
    document.getElementById("popup-message").innerText =
      "Phường không nằm trong khu vực giao hàng. Vui lòng chọn phường gần Bình Thạnh (trong 10km).";
    document.getElementById("popup-alert").style.display = "flex";
    wardInput.focus();
    return;
  }

  if (addressValue.length < 10 || !validAddressRegex.test(addressValue)) {
    e.preventDefault();
    document.getElementById("popup-message").innerText =
      "Địa chỉ không hợp lệ. Vui lòng nhập rõ số nhà và tên đường (VD: 576/2 Nguyễn Văn Cừ).";
    document.getElementById("popup-alert").style.display = "flex";
    addressInput.focus();
    return;
  }

  const cart = localStorage.getItem("cart") || "[]";
  document.getElementById("cart-data").value = cart;
});

function closePopup() {
  document.getElementById("popup-alert").style.display = "none";
}
