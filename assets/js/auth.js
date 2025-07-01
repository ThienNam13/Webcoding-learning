
(() => {
  const btnLogin    = document.getElementById('btnLogin');
  const popupFrame  = document.getElementById('popupFrame');
  const authFrame   = document.getElementById('authFrame');

  /* 1. Mở popup đăng nhập */
  if (btnLogin && popupFrame && authFrame) {
    btnLogin.addEventListener('click', () => {
      authFrame.src = 'login.php';
      popupFrame.style.display = 'block';
    });
  }

  /* 2. Hàm toast thông báo */
  function showToast(message, bg = '#4CAF50') {
    const toast = document.createElement('div');
    toast.textContent = message;
    Object.assign(toast.style, {
      position   : 'fixed',
      top        : '20px',
      left       : '50%',
      transform  : 'translateX(-50%)',
      background : bg,
      color      : '#fff',
      padding    : '10px 24px',
      borderRadius: '8px',
      boxShadow  : '0 2px 6px rgba(0,0,0,0.2)',
      zIndex     : 10000,
      fontWeight : '600',
      transition : 'opacity .3s'
    });
    document.body.appendChild(toast);
    setTimeout(() => { toast.style.opacity = '0'; }, 1400);
    setTimeout(() => toast.remove(), 1700);
  }

  /* 3. Hàm ẩn popup + (tùy chọn) reload */
  function closePopupAndReload(delay = 1000) {
    popupFrame.style.display = 'none';
    authFrame.src = '';
    setTimeout(() => window.location.reload(), delay);
  }

  /* 4. Lắng nghe thông điệp từ iframe */
  window.addEventListener('message', (e) => {
    console.log('[auth.js] message:', e.data);

    switch (e.data) {
      /* ĐĂNG KÝ */
      case 'register-success':
        showToast('Đăng ký thành công!');
        authFrame.src = 'login.php';          // chuyển sang form login
        break;

      /* ĐĂNG NHẬP */
      case 'login-success':
        showToast('Đăng nhập thành công!');
        popupFrame.remove();  
        setTimeout(() => location.reload(), 800);                
        break;

      case 'login-fail':
        showToast('Email / mật khẩu sai!', '#e74c3c');
        break;

      case 'login-empty':
        showToast('Điền đủ Email và Mật khẩu!', '#f39c12');
        break;

      case 'login-error':
        showToast('Lỗi hệ thống – thử lại sau!', '#e74c3c');
        break;

      /* Chuyển form thủ công (nếu iframe gửi) */
      case 'gotoLogin':
        authFrame.src = 'login.php';
        break;
      case 'gotoRegister':
        authFrame.src = 'register.php';
        break;
    }
  });

  console.log('[auth.js] ready');
})();
