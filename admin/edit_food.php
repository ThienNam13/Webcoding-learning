<?php
require_once("../php/db.php");

// Lấy ID món
$id = intval($_GET['id']);
$stmt = $link->prepare("SELECT * FROM foods WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$food = $result->fetch_assoc();

if (!$food) die("Không tìm thấy món");

// Xử lý update
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $ten_mon = trim($_POST["ten_mon"]);
    $mo_ta = trim($_POST["mo_ta"]);
    $gia = floatval($_POST["gia"]);
    $hinh_anh = trim($_POST["hinh_anh"]);
    $loai = trim($_POST["loai"]);
    $is_available = intval($_POST["is_available"]);

    $stmt = $link->prepare("UPDATE foods SET ten_mon=?, mo_ta=?, gia=?, hinh_anh=?, loai=?, is_available=? WHERE id=?");
    $stmt->bind_param("ssdssii", $ten_mon, $mo_ta, $gia, $hinh_anh, $loai, $is_available, $id);
    $stmt->execute();
    header("Location: foods.php");
    exit;
}
?>

<h2>Sửa món</h2>
<form method="post">
    Tên: <input type="text" name="ten_mon" value="<?= htmlspecialchars($food['ten_mon']) ?>"><br>
    Mô tả: <input type="text" name="mo_ta" value="<?= htmlspecialchars($food['mo_ta']) ?>"><br>
    Giá: <input type="number" name="gia" value="<?= $food['gia'] ?>"><br>
    Ảnh: <input type="text" name="hinh_anh" value="<?= htmlspecialchars($food['hinh_anh']) ?>"><br>
    Loại:
    <select name="loai">
      <option <?= $food['loai']=='Combo' ? 'selected' : '' ?>>Combo</option>
      <option <?= $food['loai']=='Gà rán' ? 'selected' : '' ?>>Gà rán</option>
      <option <?= $food['loai']=='Khuyến mãi' ? 'selected' : '' ?>>Khuyến mãi</option>
      <option <?= $food['loai']=='Món mới' ? 'selected' : '' ?>>Món mới</option>
      <option <?= $food['loai']=='Burger-Cơm-Mì ý' ? 'selected' : '' ?>>Burger-Cơm-Mì ý</option>
      <option <?= $food['loai']=='Tráng miệng' ? 'selected' : '' ?>>Tráng miệng</option>
    </select><br>
    Trạng thái:
    <select name="is_available">
        <option value="1" <?= $food['is_available'] ? 'selected' : '' ?>>Còn</option>
        <option value="0" <?= !$food['is_available'] ? 'selected' : '' ?>>Hết</option>
    </select><br>
    <button type="submit">Lưu</button>
</form>
