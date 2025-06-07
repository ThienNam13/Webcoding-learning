// KFJoli-ordering/assets/js/cart.js
document.addEventListener("DOMContentLoaded", () => {
  const cartBody = document.getElementById("cart-body");
  const totalPriceEl = document.getElementById("total-price");
  const checkoutBtn = document.getElementById("checkout-btn");

  let cart = JSON.parse(localStorage.getItem("cart")) || [];

  function formatCurrency(number) {
    return number.toLocaleString("vi-VN") + " đ";
  }

  function renderCart() {
    cartBody.innerHTML = "";
    let total = 0;

    cart.forEach((item, index) => {
      const itemTotal = item.so_luong * item.gia;
      total += itemTotal;

      const row = document.createElement("tr");
      row.innerHTML = `
        <td><img src="${item.hinh_anh}" alt="${item.ten_mon}" width="60"></td>
        <td>${item.ten_mon}</td>
        <td>${formatCurrency(item.gia)}</td>
        <td>
          <input type="number" min="1" value="${item.so_luong}" data-index="${index}" class="qty-input">
        </td>
        <td>${formatCurrency(itemTotal)}</td>
        <td><button data-index="${index}" class="btn-delete">X</button></td>
      `;
      cartBody.appendChild(row);
    });

    totalPriceEl.textContent = formatCurrency(total);
    checkoutBtn.disabled = cart.length === 0;
  }

  // Cập nhật số lượng
  cartBody.addEventListener("change", (e) => {
    if (e.target.classList.contains("qty-input")) {
      const index = e.target.dataset.index;
      const newQty = parseInt(e.target.value);
      if (newQty > 0) {
        cart[index].so_luong = newQty;
        localStorage.setItem("cart", JSON.stringify(cart));
        renderCart();
      }
    }
  });

  // Xóa món
  cartBody.addEventListener("click", (e) => {
    if (e.target.classList.contains("btn-delete")) {
      const index = e.target.dataset.index;
      cart.splice(index, 1);
      localStorage.setItem("cart", JSON.stringify(cart));
      renderCart();
    }
  });

  renderCart();
});
