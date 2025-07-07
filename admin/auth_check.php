<?php
if (empty($_SESSION['admin_id']) || $_SESSION['admin_role'] !== 'admin') {
    header("Location: login.php");
    exit;
}
?>