<?php
require_once '../php/db.php';

// Lấy giá trị filter từ form
$status_filter = $_GET['status'] ?? '';
$date_from = $_GET['date_from'] ?? '';
$date_to = $_GET['date_to'] ?? '';

// Xây dựng câu truy vấn có điều kiện
$sql = "SELECT * FROM orders WHERE 1";

if (!empty($status_filter)) {
  $sql .= " AND trang_thai = '" . $link->real_escape_string($status_filter) . "'";
}
if (!empty($date_from)) {
  $sql .= " AND DATE(thoi_gian_dat) >= '" . $link->real_escape_string($date_from) . "'";
}
if (!empty($date_to)) {
  $sql .= " AND DATE(thoi_gian_dat) <= '" . $link->real_escape_string($date_to) . "'";
}
$sql .= " ORDER BY thoi_gian_dat DESC";

$result = $link->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Quản lý Đơn Hàng | Admin</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <h1>Quản lý Đơn Hàng</h1>

  <form method="get" class="filter-form">
    <label>Trạng thái:
      <select name="status">
        <option value="">-- Tất cả --</option>
        <?php
          $statuses = ['Đang xử lý', 'Đang giao', 'Hoàn thành', 'Đã hủy'];
          foreach ($statuses as $status) {
            $selected = ($status === $status_filter) ? 'selected' : '';
            echo "<option value=\"$status\" $selected>$status</option>";
          }
        ?>
      </select>
    </label>

    <label>Từ ngày:
      <input type="date" name="date_from" value="<?= htmlspecialchars($date_from) ?>">
    </label>

    <label>Đến ngày:
      <input type="date" name="date_to" value="<?= htmlspecialchars($date_to) ?>">
    </label>

    <button type="submit">Lọc</button>
  </form>

  <table>
    <thead>
      <tr>
        <th>Mã Đơn</th>
        <th>Khách Hàng</th>
        <th>Thời Gian Đặt</th>
        <th>Tổng Tiền</th>
        <th>Trạng Thái</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($row['ma_don']) ?></td>
          <td><?= htmlspecialchars($row['ho_ten']) ?></td>
          <td><?= $row['thoi_gian_dat'] ?></td>
          <td><?= number_format($row['tong_tien'], 0, ',', '.') ?>₫</td>
          <td>
            <form method="post" action="update_status.php">
              <input type="hidden" name="order_id" value="<?= $row['id'] ?>">
              <select name="new_status">
                <?php
                  foreach ($statuses as $status) {
                    $selected = ($row['trang_thai'] == $status) ? 'selected' : '';
                    echo "<option value=\"$status\" $selected>$status</option>";
                  }
                ?>
              </select>
              <button type="submit">Cập nhật</button>
            </form>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</body>
</html>
