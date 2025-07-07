document.addEventListener("DOMContentLoaded", () => {
  fetch("php/food/list.php")
    .then(res => res.json())
    .then(data => {
      const categories = {
        "Khuyến mãi": "khuyen-mai",
        "Món mới": "mon-moi",
        "Combo": "combo",
        "Gà rán": "ga-ran",
        "Burger - Cơm - Mì ý": "burger-com-my-y",
        "Tráng miệng": "trang-mieng"
      };

      for (const [loai, foods] of Object.entries(data)) {
        const container = document.querySelector(`#${categories[loai]}`)?.nextElementSibling;
        if (!container) continue;

        foods.forEach(food => {
          if (food.is_available == 0) return;
          container.insertAdjacentHTML("beforeend", `
            <div class="food-card">
              <img src="./${food.hinh_anh}" alt="${food.ten_mon}">
              <h3>${food.ten_mon}</h3>
              <p>${food.mo_ta}</p>
              <p class="price" data-value="${food.gia}">${Number(food.gia).toLocaleString()}₫</p>
              <button class="btn-add" data-id="${food.id}">Thêm món</button>
            </div>
          `);

        });
      }

      // Khởi động lại nút thêm giỏ
      initAddToCart();
    });
    

});

function initAddToCart() {
  const buttons = document.querySelectorAll(".btn-add");
  buttons.forEach(btn => {
    btn.addEventListener("click", () => {
      const itemId = btn.dataset.id;
      
      // Gọi hàm cập nhật cookie
      updateRecentlyViewed(itemId);
      
      // Logic thêm món vào giỏ (nếu có)
      // addToCart(itemId); // giả sử bạn có hàm này
    });
  });
}