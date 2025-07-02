document.addEventListener("DOMContentLoaded", () => {
  const orderItemsContainer = document.querySelector(".order-items-container");
  const checkoutTotal = document.querySelector(".checkout-total span:last-child");
  const cart = JSON.parse(localStorage.getItem("cart")) || [];

  function formatCurrency(number) {
    return number.toLocaleString("vi-VN") + "₫";
  }

  function renderOrderItems() {
    let total = 0;

    // Xóa các dòng món ăn cũ (giữ lại phí giao hàng)
    const items = orderItemsContainer.querySelectorAll(".order-item");
    if (items.length > 1) {
      items.forEach((item, i) => {
        if (i < items.length - 1) item.remove();
      });
    }

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

  renderOrderItems();
});

// Gửi cart và kiểm tra phường
function closePopup() {
  document.getElementById("popup-alert").style.display = "none";
}

document.getElementById("checkout-form").addEventListener("submit", function (e) {
  const allowedWards = [
    "Phường Bình Thạnh", "Phường Tân Sơn Nhất", "Phường Cầu Kiệu",
    "Phường An Nhơn", "Phường Hạnh Thông", "Phường Sài Gòn",
    "Phường Minh Phụng", "Phường Tân Sơn Hòa", "Phường Phú Nhuận",
    "Phường An Hội Đông"
  ];

  const ward = document.getElementById("ward").value.trim();
  if (!allowedWards.includes(ward)) {
    e.preventDefault();
    document.getElementById("popup-alert").style.display = "flex";
  } else {
    const cart = localStorage.getItem("cart") || "[]";
    document.getElementById("cart-data").value = cart;
  }
});
