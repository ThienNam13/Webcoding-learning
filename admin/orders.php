<?php
require_once '../php/db.php';

// --- Lọc theo trạng thái và ngày ---
$filter_status = $_GET['status'] ?? '';
$filter_date = $_GET['date'] ?? '';

// --- Cập nhật trạng thái nếu POST ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'], $_POST['new_status'])) {
    $order_id = intval($_POST['order_id']);
    $new_status = trim($_POST['new_status']);

    $stmt = $link->prepare("UPDATE orders SET trang_thai = ? WHERE id = ?");
    $stmt->bind_param("si", $new_status, $order_id);
    $stmt->execute();
    $stmt->close();
}

// --- Truy vấn có lọc ---
$sql = "SELECT * FROM orders WHERE 1";
$params = [];
$types = '';

if ($filter_status !== '') {
    $sql .= " AND trang_thai = ?";
    $params[] = $filter_status;
    $types .= 's';
}
if ($filter_date !== '') {
    $sql .= " AND DATE(thoi_gian_dat) = ?";
    $params[] = $filter_date;
    $types .= 's';
}
$sql .= " ORDER BY thoi_gian_dat DESC";

$stmt = $link->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Quản lý Đơn Hàng | Admin</title>
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>

<h1>Quản lý Đơn Hàng</h1>

<!-- FORM LỌC -->
<form method="GET" style="margin-bottom: 20px;">
  <label for="status">Trạng thái:</label>
  <select name="status" id="status">
    <option value="">-- Tất cả --</option>
    <?php
    $statuses = ['Đang xử lý', 'Đang giao', 'Hoàn thành', 'Đã hủy'];
    foreach ($statuses as $s) {
      $selected = ($filter_status === $s) ? 'selected' : '';
      echo "<option value=\"$s\" $selected>$s</option>";
    }
    ?>
  </select>

  <label for="date">Ngày đặt:</label>
  <input type="date" name="date" id="date" value="<?= htmlspecialchars($filter_date) ?>">

  <button type="submit">Lọc</button>
  
</form>

<table border="1" cellpadding="8" cellspacing="0">
  <tr>
    <th>Mã Đơn</th>
    <th>Khách Hàng</th>
    <th>Thời Gian Đặt</th>
    <th>Tổng Tiền</th>
    <th>Trạng Thái</th>
    <th>Xem chi tiết</th>
  </tr>

  <?php while ($row = $result->fetch_assoc()): ?>
<tr>
  <td><?= htmlspecialchars($row['ma_don']) ?></td>
  <td><?= htmlspecialchars($row['ho_ten']) ?></td>
  <td><?= date("d/m/Y H:i", strtotime($row['thoi_gian_dat'])) ?></td>
  <td><?= number_format($row['tong_tien'], 0, ',', '.') ?>₫</td>
  <td>
    <form method="post">
      <input type="hidden" name="order_id" value="<?= $row['id'] ?>">
      <select name="new_status">
        <?php foreach ($statuses as $status): ?>
          <option value="<?= $status ?>" <?= $row['trang_thai'] == $status ? 'selected' : '' ?>><?= $status ?></option>
        <?php endforeach; ?>
      </select>
      <button type="submit">Cập nhật</button>
    </form>
  </td>
  <td>
    <a href="order_detail.php?id=<?= $row['id'] ?>">
      <i class="icon-edit ti-eye"></i>
    </a>
  </td>


</tr>
<?php endwhile; ?>

</table>
<a href="dashboard.php"><button>← Quay lại danh sách</button></a>
</body>
</html>
