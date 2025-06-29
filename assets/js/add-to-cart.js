document.addEventListener("DOMContentLoaded", () => {
  const addButtons = document.querySelectorAll(".btn-add");

  addButtons.forEach(button => {
    button.addEventListener("click", () => {
      const card = button.closest(".food-card");
      const ten_mon = card.querySelector("h3").textContent;
      const mo_ta = card.querySelector("p").textContent;
      const gia = parseInt(card.querySelector(".price").dataset.value);
      const id = parseInt(button.dataset.id);
      const hinh_anh = card.querySelector("img").getAttribute("src");
      
      console.log("Món thêm:", { id, ten_mon, mo_ta, gia, hinh_anh });

      showPopup({ id, ten_mon, mo_ta, gia, hinh_anh });
    });
  });

  function showPopup(mon) {
    console.log("Gửi vào giỏ:", mon);
    const overlay = document.createElement("div");
    overlay.className = "popup-overlay";
    overlay.innerHTML = `
      <div class="popup-box">
        <h3>${mon.ten_mon}</h3>
        <p>${mon.mo_ta}</p>
        <p><strong>Giá:</strong> ${mon.gia.toLocaleString("vi-VN")} đ</p>
        <label>Số lượng: <input type="number" id="popup-qty" min="1" value="1"></label><br><br>
        <button id="popup-confirm">Xác nhận</button>
        <button id="popup-cancel">Hủy</button>
      </div>
    `;
    document.body.appendChild(overlay);

    document.getElementById("popup-cancel").onclick = () => document.body.removeChild(overlay);
    document.getElementById("popup-confirm").onclick = () => {
      const so_luong = parseInt(document.getElementById("popup-qty").value);
      themVaoGio({ ...mon, so_luong });
      document.body.removeChild(overlay);
    };
  }

  function themVaoGio(mon) {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];

    const index = cart.findIndex(item => item.ten_mon === mon.ten_mon);
    if (index >= 0) {
      cart[index] = {
        ...cart[index],
        so_luong: cart[index].so_luong + mon.so_luong,
        id: mon.id // ✅ đảm bảo id không bị mất
      };
    } else {
      cart.push(mon);
    }
    console.log("➡️ Đối tượng sẽ lưu:", cart);
    localStorage.setItem("cart", JSON.stringify(cart));
    alert("Đã thêm vào giỏ hàng!");
  }
});
