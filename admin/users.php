<?php
require_once '../php/db.php';
require_once 'auth_check.php';
// Xử lý filter role
$roleFilter = $_GET['role'] ?? '';

// Xử lý thay đổi vai trò
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id   = intval($_POST['id']);
    $type = $_POST['action'];

    if ($type === 'toggle_role') {
        $sql = "UPDATE users SET role = IF(role = 'admin', 'user', 'admin') WHERE id = ?";
    } elseif ($type === 'toggle_block') {
        $sql = "UPDATE users SET blocked = IF(blocked = 1, 0, 1) WHERE id = ?";
    }

    $stmt = $link->prepare($sql);
      if (!$stmt) {
        die("Không thể chuẩn bị câu lệnh SQL: " . $link->error);
      }
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();

    header("Location: users.php?success=1&role=$roleFilter");
    exit;
}

// Truy vấn danh sách người dùng
$sql = "SELECT id, fullname, email, role, blocked FROM users";
if ($roleFilter && in_array($roleFilter, ['admin', 'user'])) {
    $sql .= " WHERE role = ?";
    $stmt = $link->prepare($sql);
    $stmt->bind_param('s', $roleFilter);
} else {
    $stmt = $link->prepare($sql);
}
$stmt->execute();
$users = $stmt->get_result();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Quản lý người dùng</title>
  <link rel="stylesheet" href="assets/css/users.css">
  <script src="assets/js/users.js"></script>

</head>
<body>
<!-- Quay lại -->
<div class="back-home">
  <a href="dashboard.php" class="back-link">← Quay lại trang chủ</a>
</div>
<h1>👥 Danh sách người dùng</h1>

<form method="get" class="filter-form">
<form method="post" class="ajax-action" style="display:inline;">
  <label>Lọc theo vai trò:</label>
  <select name="role" onchange="this.form.submit()">
    <option value="">Tất cả</option>
    <option value="admin" <?= $roleFilter == 'admin' ? 'selected' : '' ?>>Admin</option>
    <option value="user" <?= $roleFilter == 'user' ? 'selected' : '' ?>>User</option>
  </select>
</form>

<?php if (!empty($_GET['success'])): ?>
  <div id="toast">Cập nhật thành công!</div>
  <script>
    setTimeout(() => document.getElementById('toast').classList.add('show'), 100);
    setTimeout(() => document.getElementById('toast').classList.remove('show'), 3000);
  </script>
<?php endif; ?>

<table>
  <thead>
    <tr>
      <th>Họ tên</th>
      <th>Email</th>
      <th>Vai trò</th>
      <th>Trạng thái</th>
      <th>Hành động</th>
    </tr>
  </thead>
  <tbody>
    <?php while ($row = $users->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($row['fullname']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td><?= $row['role'] ?></td>
        <td><?= $row['blocked'] ? 'Bị chặn' : 'Hoạt động' ?></td>
        <td>
          <form method="post" style="display:inline;">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <input type="hidden" name="action" value="toggle_role">
            <button type="submit" class="btn btn-role">Đổi vai trò</button>
          </form>
          <form method="post" style="display:inline;">
            <input type="hidden" name="id" value="<?= $row['id'] ?>">
            <input type="hidden" name="action" value="toggle_block">
            <button type="submit" class="btn <?= $row['blocked'] ? 'btn-unblock' : 'btn-block' ?>">
              <?= $row['blocked'] ? 'Bỏ chặn' : 'Chặn' ?>
            </button>
          </form>
        </td>
      </tr>
    <?php endwhile; ?>
  </tbody>
</table>

</body>
</html>
