document.addEventListener("DOMContentLoaded", () => {
  renderOrderItems();
  initFormValidation();
});

// ✅ Hiển thị giỏ hàng tóm tắt
function renderOrderItems() {
  const orderItemsContainer = document.querySelector(".order-items-container");
  const checkoutTotal = document.querySelector(".checkout-total span:last-child");
  const cart = JSON.parse(localStorage.getItem("cart")) || [];
  let total = 0;

  // Xóa các món cũ (giữ lại phí giao hàng)
  orderItemsContainer.querySelectorAll(".order-item:not(:last-child)").forEach(item => item.remove());

  cart.forEach(item => {
    const itemTotal = item.so_luong * item.gia;
    total += itemTotal;

    const div = document.createElement("div");
    div.className = "order-item";
    div.innerHTML = `<span>${item.ten_mon} x${item.so_luong}</span><span>${formatCurrency(itemTotal)}</span>`;
    orderItemsContainer.insertBefore(div, orderItemsContainer.querySelector(".order-item:last-child"));
  });

  const shipping = 15000;
  orderItemsContainer.querySelector(".order-item:last-child span:last-child").textContent = formatCurrency(shipping);
  checkoutTotal.textContent = formatCurrency(total + shipping);
}

function formatCurrency(number) {
  return number.toLocaleString("vi-VN") + "₫";
}

// ✅ Bắt sự kiện submit form
function initFormValidation() {
  const form = document.getElementById("checkout-form");

  form.addEventListener("submit", function (e) {
    e.preventDefault(); // Ngăn form gửi ngay

    if (!validateForm()) return; // Nếu sai thì dừng lại

    showConfirm(); // Đúng thì hỏi xác nhận
  });
}

// ✅ Kiểm tra input
function validateForm() {
  const fullname = document.getElementById("fullname").value.trim();
  const phone = document.getElementById("phone").value.trim();
  const address = document.getElementById("address").value.trim();

  const validNameRegex = /^(?=.*[\p{L}])[ \p{L}'.-]{4,}$/u;
  const validPhoneRegex = /^(0|\+84)[0-9]{8,10}$/;
  const validAddressRegex = /^\d[\d\/\-]{0,10}\s+[\p{L}\s\d'.\-]{3,}$/u;

  if (!validNameRegex.test(fullname)) {
    showError("Họ tên không hợp lệ."); return false;
  }
  if (!validPhoneRegex.test(phone)) {
    showError("Số điện thoại không hợp lệ."); return false;
  }
  if (address.length < 5 || !validAddressRegex.test(address)) {
    showError("Địa chỉ không hợp lệ."); return false;
  }

  // Nếu hợp lệ thì set dữ liệu giỏ hàng
  const cart = localStorage.getItem("cart") || "[]";
  document.getElementById("cart-data").value = cart;

  return true;
}

// ✅ Hiển thị popup cảnh báo
function showError(msg) {
  document.getElementById("popup-message").innerText = msg;
  document.getElementById("popup-alert").style.display = "flex";
}
function closePopup() {
  document.getElementById("popup-alert").style.display = "none";
}

// ✅ Hiển thị popup xác nhận
function showConfirm() {
  document.getElementById("popup-confirm").style.display = "flex";
}
function closeConfirm() {
  document.getElementById("popup-confirm").style.display = "none";
}

// ✅ Nếu xác nhận → submit form
function submitRealOrder() {
  // Xóa cart trong localStorage
  localStorage.removeItem("cart");
  document.getElementById("checkout-form").submit();
}
