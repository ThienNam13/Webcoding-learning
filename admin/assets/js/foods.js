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
  const editButtons = document.querySelectorAll(".edit-btn");

  editButtons.forEach(button => {
    button.addEventListener("click", () => {
      const row = button.closest("tr");
      const id = button.dataset.id;

      // Lấy các ô
      const cells = row.querySelectorAll("td");
      const imgCell = cells[1];
      const nameCell = cells[2];
      const descCell = cells[3];
      const priceCell = cells[4];
      const typeCell = cells[5];
      const statusCell = cells[6];
      const actionCell = cells[7];

      // Lưu dữ liệu cũ
      const oldData = {
        name: nameCell.innerText,
        desc: descCell.innerText,
        price: priceCell.innerText.replace(/[^\d]/g, ""),
        type: typeCell.innerText,
        status: statusCell.innerText === "Còn" ? 1 : 0,
      };

      // Chuyển các ô thành input
      nameCell.innerHTML = `<input type="text" value="${oldData.name}">`;
      descCell.innerHTML = `<textarea rows="2">${oldData.desc}</textarea>`;
      priceCell.innerHTML = `<input type="number" value="${oldData.price}">`;

      // Dropdown loại
      const optionsLoai = ["Khuyến mãi", "Món mới", "Combo", "Gà rán", "Burger - Cơm - Mì ý", "Tráng miệng"];
      typeCell.innerHTML = `<select>${optionsLoai.map(o => `<option ${o === oldData.type ? "selected" : ""}>${o}</option>`).join("")}</select>`;

      // Dropdown trạng thái
      statusCell.innerHTML = `
        <select>
          <option value="1" ${oldData.status == 1 ? "selected" : ""}>Còn</option>
          <option value="0" ${oldData.status == 0 ? "selected" : ""}>Hết</option>
        </select>`;

      // Thêm nút Lưu và Hủy
      actionCell.innerHTML = `
        <button class="save-btn">💾</button>
        <button type="button" class="cancel-btn">❌</button>
      `;

      // Xử lý nút Hủy
      actionCell.querySelector(".cancel-btn").addEventListener("click", () => {
        nameCell.innerText = oldData.name;
        descCell.innerText = oldData.desc;
        priceCell.innerText = parseInt(oldData.price).toLocaleString() + "₫";
        typeCell.innerText = oldData.type;
        statusCell.innerText = oldData.status ? "Còn" : "Hết";
        actionCell.innerHTML = `<button class="edit-btn" data-id="${id}">✏️</button>`;
      });

      // Xử lý nút Lưu (cần AJAX để lưu vào CSDL)
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
            // Gán lại dữ liệu mới vào dòng đang chỉnh sửa
            nameCell.innerText = updated.ten_mon;
            descCell.innerText = updated.mo_ta;
            priceCell.innerText = parseInt(updated.gia).toLocaleString() + "₫";
            typeCell.innerText = updated.loai;
            statusCell.innerText = updated.is_available == 1 ? "Còn" : "Hết";
            actionCell.innerHTML = `<button class="edit-btn" data-id="${id}">✏️</button>`;
          } else {
            alert("Lỗi: " + res.message);
          }
        });
      });
    });
  });
});

