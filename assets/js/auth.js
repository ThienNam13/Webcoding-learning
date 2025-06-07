document.getElementById('btnLogin').addEventListener('click', () => {
  document.getElementById('authFrame').src = 'login.html';
  document.getElementById('popupFrame').style.display = 'block';
});

// Cho iframe đóng lại từ bên trong khi login thành công:
window.addEventListener('message', function(e) {
  if (e.data === 'login-success') {
    document.getElementById('popupFrame').style.display = 'none';
    // TODO: cập nhật tên user, hoặc lưu token vào localStorage/session
  }
});
