<?php
require_once("../php/db.php");
// require_once 'auth_check.php'; 

// // Kiểm tra quyền admin
// if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
//   header("Location: login.php");
//   exit;
// }

// Xử lý thêm món
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["submit"])) {
  $ten_mon     = trim($_POST["ten_mon"]);
  $mo_ta       = trim($_POST["mo_ta"]);
  $gia         = floatval($_POST["gia"]);
  $hinh_anh    = trim($_POST["hinh_anh"]);
  $loai        = trim($_POST["loai"]);
  $is_available = intval($_POST["is_available"]);

  if (!$ten_mon || !$mo_ta || !$gia || !$hinh_anh || !$loai) {
    $error = "Vui lòng điền đầy đủ thông tin.";
  } else {
    // Kiểm tra món trùng
    $check = $link->prepare("SELECT id FROM foods WHERE ten_mon = ?");
    $check->bind_param("s", $ten_mon);
    $check->execute();
    $check->store_result();

    if ($check->num_rows === 0) {
      $insert = $link->prepare("INSERT INTO foods (ten_mon, mo_ta, gia, hinh_anh, loai, is_available) VALUES (?, ?, ?, ?, ?, ?)");
      $insert->bind_param("ssdssi", $ten_mon, $mo_ta, $gia, $hinh_anh, $loai, $is_available);
      $insert->execute();
    } else {
      $error = "Tên món đã tồn tại.";
    }
    $check->close();
  }
}

// Truy vấn danh sách món ăn
$foods = $link->query("SELECT * FROM foods ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Quản lý món ăn | KFJoli</title>
  <link rel="stylesheet" href="assets/css/foods.css" />
  <link rel="stylesheet" href="../assets/themify-icons-font/themify-icons/themify-icons.css">
</head>
<body>

<div id="content">
  <div class="button-add-food">
    <button onclick="toggleForm()">
      <i class="icon-add">+</i> Thêm món ăn
    </button>
  </div>

  <div class="form-add-food" id="formAddFood" style="display: none;">
    <h3>Thêm món ăn</h3>
    <?php if (isset($error)): ?>
      <p style="color:red"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <form method="post">
      <div class="attri"><div class="name-attri">Ảnh:</div><input type="text" name="hinh_anh"></div>
      <div class="attri"><div class="name-attri">Tên món:</div><input type="text" name="ten_mon"></div>
      <div class="attri"><div class="name-attri">Mô tả:</div><input type="text" name="mo_ta"></div>
      <div class="attri"><div class="name-attri">Giá tiền:</div><input type="number" name="gia" step="1000"></div>
      <div class="attri">
        <div class="name-attri">Loại:</div>
        <select name="loai">
          <option>Khuyến mãi</option>
          <option>Món mới</option>
          <option>Combo</option>
          <option>Gà rán</option>
          <option>Burger - Cơm - Mì ý</option>
          <option>Tráng miệng</option>
        </select>
      </div>
      <div class="attri">
        <div class="name-attri">Trạng thái:</div>
        <select name="is_available">
          <option value="1">Còn</option>
          <option value="0">Hết</option>
        </select>
      </div>
      <div class="button-submit">
        <input type="submit" name="submit" value="Thêm">
      </div>
    </form>
  </div>

  <div class="foods-list" align="center">
    <h3 style="margin-top: 40px;">Danh sách món ăn</h3>
    <table>
      <thead>
        <tr>
          <th>STT</th>
          <th>Ảnh</th>
          <th>Tên món</th>
          <th>Mô tả</th>
          <th>Giá</th>
          <th>Loại</th>
          <th>Trạng thái</th>
          <th>Thao tác</th>
        </tr>
      </thead>
      <tbody>
        <?php $i = 1; while($row = $foods->fetch_assoc()): ?>
          <tr>
            <td><?= $i++ ?></td>
            <td><img src="../<?= htmlspecialchars($row['hinh_anh']) ?>" width="60"></td>
            <td><?= htmlspecialchars($row['ten_mon']) ?></td>
            <td><?= htmlspecialchars($row['mo_ta']) ?></td>
            <td><?= number_format($row['gia']) ?>₫</td>
            <td><?= htmlspecialchars($row['loai']) ?></td>
            <td><?= $row['is_available'] ? "Còn" : "Hết" ?></td>
            <td>
              <a href="edit_food.php?id=<?= $row['id'] ?>">
                <i class="icon-edit ti-pencil"></i>
              </a>
            </td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>
<script src="assets/js/foods.js"></script>
</body>
</html>

?>
