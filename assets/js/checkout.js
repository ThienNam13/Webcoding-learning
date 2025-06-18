document.addEventListener("DOMContentLoaded", () => {
  const orderItemsContainer = document.querySelector(".order-items-container");
  const checkoutTotal = document.querySelector(".checkout-total span:last-child");

  const cart = JSON.parse(localStorage.getItem("cart")) || [];

  function formatCurrency(number) {
    return number.toLocaleString("vi-VN") + "₫";
  }

  function renderOrderItems() {
    let total = 0;

    // Xóa tất cả món cũ (trừ dòng phí giao hàng cuối cùng)
    const allItems = orderItemsContainer.querySelectorAll(".order-item");
    if (allItems.length > 1) {
      allItems.forEach((item, index) => {
        if (index < allItems.length - 1) item.remove(); // giữ lại dòng phí giao hàng
      });
    }

    cart.forEach(item => {
      const itemTotal = item.so_luong * item.gia;
      total += itemTotal;

      const itemEl = document.createElement("div");
      itemEl.className = "order-item";
      itemEl.innerHTML = `<span>${item.ten_mon} x${item.so_luong}</span><span>${formatCurrency(itemTotal)}</span>`;
      orderItemsContainer.insertBefore(itemEl, orderItemsContainer.querySelector(".order-item:last-child"));
    });

    const shippingFee = 15000;
    const totalAmount = total + shippingFee;

    // Cập nhật phí giao hàng và tổng tiền
    orderItemsContainer.querySelector(".order-item:last-child span:last-child").textContent = formatCurrency(shippingFee);
    checkoutTotal.textContent = formatCurrency(totalAmount);
  }

  renderOrderItems();
});
