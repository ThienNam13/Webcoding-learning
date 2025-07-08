// Ẩn hiện form add food
function toggleForm() {
  const form = document.getElementById("formAddFood");
  if (form.style.display === "none") {
    form.style.display = "block";
    form.scrollIntoView({ behavior: "smooth" });
  } else {
    form.style.display = "none";
  }
}

// Edit food
document.addEventListener("DOMContentLoaded", () => {
  initEditButtons();  // gọi lần đầu
});

function initEditButtons() {
  const editButtons = document.querySelectorAll(".edit-btn");

  editButtons.forEach(button => {
    button.addEventListener("click", () => {
      const row = button.closest("tr");
      const id = button.dataset.id;

      const cells = row.querySelectorAll("td");
      const imgCell = cells[1];
      const nameCell = cells[2];
      const descCell = cells[3];
      const priceCell = cells[4];
      const typeCell = cells[5];
      const statusCell = cells[6];
      const actionCell = cells[7];

      const oldData = {
        name: nameCell.innerText,
        desc: descCell.innerText,
        price: priceCell.innerText.replace(/[^\d]/g, ""),
        type: typeCell.innerText,
        status: statusCell.innerText === "Còn" ? 1 : 0,
      };

      nameCell.innerHTML = `<input type="text" value="${oldData.name}">`;
      descCell.innerHTML = `<textarea rows="2">${oldData.desc}</textarea>`;
      priceCell.innerHTML = `<input type="number" value="${oldData.price}">`;

      const optionsLoai = ["Khuyến mãi", "Món mới", "Combo", "Gà rán", "Burger - Cơm - Mì ý", "Tráng miệng"];
      typeCell.innerHTML = `<select>${optionsLoai.map(o => `<option ${o === oldData.type ? "selected" : ""}>${o}</option>`).join("")}</select>`;

      statusCell.innerHTML = `
        <select>
          <option value="1" ${oldData.status == 1 ? "selected" : ""}>Còn</option>
          <option value="0" ${oldData.status == 0 ? "selected" : ""}>Hết</option>
        </select>`;

      actionCell.innerHTML = `
        <button class="save-btn">💾</button>
        <button type="button" class="cancel-btn">❌</button>
      `;

      actionCell.querySelector(".cancel-btn").addEventListener("click", () => {
        nameCell.innerText = oldData.name;
        descCell.innerText = oldData.desc;
        priceCell.innerText = parseInt(oldData.price).toLocaleString() + "₫";
        typeCell.innerText = oldData.type;
        statusCell.innerText = oldData.status ? "Còn" : "Hết";
        actionCell.innerHTML = `<button class="edit-btn" data-id="${id}">✏️</button>`;

        initEditButtons(); // gán lại sự kiện cho nút mới
      });

      actionCell.querySelector(".save-btn").addEventListener("click", (e) => {
        e.preventDefault();
        const updated = {
          id: id,
          ten_mon: nameCell.querySelector("input").value,
          mo_ta: descCell.querySelector("textarea").value,
          gia: priceCell.querySelector("input").value,
          loai: typeCell.querySelector("select").value,
          is_available: statusCell.querySelector("select").value
        };

        fetch("foods.php", {
          method: "POST",
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify(updated)
        })
        .then(res => res.json())
        .then(res => {
          if (res.success) {
            const formattedPrice = parseInt(updated.gia).toLocaleString() + "₫";
            const formattedStatus = updated.is_available == 1 ? "Còn" : "Hết";

            nameCell.innerText = updated.ten_mon;
            descCell.innerText = updated.mo_ta;
            priceCell.innerText = formattedPrice;
            typeCell.innerText = updated.loai;
            statusCell.innerText = formattedStatus;

            // Thay nút về nút Edit ban đầu
            const newEditButton = document.createElement("button");
            newEditButton.className = "edit-btn";
            newEditButton.dataset.id = id;
            newEditButton.textContent = "✏️";
            actionCell.innerHTML = ""; // clear cũ
            actionCell.appendChild(newEditButton);

            showToast("Đã lưu thành công!", "#2ecc71"); // Thêm thông báo

            initEditButtons(); // Gán lại sự kiện cho nút Edit mới
          } else {
            alert("Lỗi: " + res.message);
          }
        });
      });
    });
  });
}

function showToast(message, bg = '#333') {
  let toast = document.getElementById("toast");
  if (!toast) {
    toast = document.createElement("div");
    toast.id = "toast";
    toast.style.position = "fixed";
    toast.style.bottom = "20px";
    toast.style.left = "50%";
    toast.style.transform = "translateX(-50%)";
    toast.style.padding = "10px 20px";
    toast.style.borderRadius = "8px";
    toast.style.color = "#fff";
    toast.style.background = bg;
    toast.style.zIndex = 9999;
    toast.style.fontSize = "15px";
    toast.style.transition = "opacity 0.3s";
    document.body.appendChild(toast);
  }
  toast.textContent = message;
  toast.style.opacity = "1";

  setTimeout(() => { toast.style.opacity = "0"; }, 1800);
}
