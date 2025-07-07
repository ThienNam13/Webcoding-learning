<?php
session_start();
require_once __DIR__ . '/../php/db.php';


$logoutMsg = !empty($_GET['logout']) ? 'Bạn đã đăng xuất thành công!' : '';
$error = '';

/* ───── Handle form ───── */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email    = trim($_POST['email'] ?? '');
  $password =       $_POST['password'] ?? '';

  /* Truy vấn user theo email */
  $sql  = "SELECT id, fullname, password, role, blocked 
           FROM users
           WHERE email = ? LIMIT 1";
  $stmt = $link->prepare($sql);
  if (!$stmt) {
      die('SQL error: ' . $link->error);
  }
  $stmt->bind_param('s', $email);
  $stmt->execute();
  $user = $stmt->get_result()->fetch_assoc();
  $stmt->close();

  /* Kiểm tra */
  if (!$user) {
      $error = 'Không tìm thấy tài khoản!';
  } elseif ($user['role'] !== 'admin') {
      $error = 'Tài khoản này không có quyền quản trị!';
  } elseif ($user['blocked']) {                     // ⇦ NEW
      $error = 'Tài khoản đã bị khóa!';  
  } elseif (!password_verify($password, $user['password'])) {
      $error = 'Sai mật khẩu!';
  } else {
      /* Thành công */
      $_SESSION['admin_id']  = $user['id'];
      $_SESSION['admin_fullname'] = $user['fullname'];
      $_SESSION['admin_role']     = 'admin';


        session_regenerate_id(true);
        header('Location: dashboard.php?loginok=1');
        exit;
  }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>Đăng nhập Admin</title>
  <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
  <div class="form-container">
    <h2>Đăng nhập quản trị</h2>

    <?php if ($logoutMsg): ?>
       <div class="success"><?= $logoutMsg ?></div>
    <?php endif; ?>

    <?php if ($error): ?>
       <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <form method="post">
      <input type="email"    name="email"
             placeholder="Email quản trị"
             autocomplete="username" required>

      <input type="password" name="password"
             placeholder="Mật khẩu"
             autocomplete="current-password" required>

      <button type="submit">Đăng nhập</button>
    </form>
  </div>
  <div 
  id="toast" class="toast" style="display:none;">
</div>

  <script>
  function showToast(msg){
    const toast=document.getElementById('toast');
    toast.textContent=msg;
    toast.classList.add('show');
    setTimeout(()=>toast.classList.remove('show'),3000);
  }
  </script>
</body>
</html>
