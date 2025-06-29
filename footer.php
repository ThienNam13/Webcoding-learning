<?php
// footer.php
?>
<!-- FOOTER -->
<div id="footer">
  <div class="container-footer">
    <div class="logo-footer"><img src="./assets/img/logo.png" alt="Logo"></div>

    <div class="address">
      <div class="address-name">CỬA HÀNG KFJOLI</div>
      <p>Địa chỉ: XX Đường số 1, Phường 2, quận Bình Thạnh, TP.Hồ Chí Minh, Việt Nam</p>
      <p>Điện thoại: 033673XXXX</p>
      <p>Email hỗ trợ: <span class="highlight">kfjolifeedback@kfjoli.com.vn</span></p>
    </div>

    <div class="link-web">
      <div class="link-name">Hãy Liên hệ với chúng tôi qua</div>
      <div class="web-link"><i class="icon-web ti-facebook"></i><span class="web-name">Facebook</span></div>
      <div class="web-link"><i class="icon-web ti-email"></i><span class="web-name">E-mail</span></div>
    </div>
  </div>
</div>

</div> <!-- end #app -->

<script src="./assets/js/popup-auth.js"></script>
<script>
  var slideIndex = 0;
  slideShow();

  function slideShow() {
    var slide = document.getElementsByClassName("slide");
    for (var i = 0; i < slide.length; i++) slide[i].style.display = "none";
    slideIndex++;
    if (slideIndex > slide.length) slideIndex = 1;
    slide[slideIndex - 1].style.display = "block";
    setTimeout(slideShow, 2500);
  }
</script>

<!-- Popup đăng nhập/đăng ký -->
<div id="popupFrame" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:#0008; z-index:9999; justify-content:center; align-items:center;">
  <div style="position:relative; display:flex; justify-content:center; align-items:center; width:100%; height:100%;">
    <div style="position:relative; width:420px; height:600px;">
      <button onclick="closePopup()" style="position:absolute; top:-20px; right:-20px; font-size:36px; background:#fff; color:#f00; border-radius:50%; border:2px solid #f00; width:50px; height:50px; cursor:pointer; z-index:10000;">&times;</button>
      <div style="width:100%; height:100%; display:flex; justify-content:center; align-items:center;">
        <iframe id="authFrame" src="" style="width:400px; height:600px; border:none; border-radius:20px;"></iframe>
      </div>
    </div>
  </div>
</div>

<script>
  document.getElementById("btnLogin").addEventListener("click", function () {
    document.getElementById("popupFrame").style.display = "flex";
    document.getElementById("authFrame").src = "login.php";
  });

  function closePopup() {
    document.getElementById("popupFrame").style.display = "none";
    document.getElementById("authFrame").src = "";
  }

  window.addEventListener("message", function (event) {
    if (event.data === "closePopup") {
      closePopup();
    }
    if (event.data === "gotoRegister") {
      document.getElementById("authFrame").src = "register.php";
    }
    if (event.data === "gotoLogin") {
      document.getElementById("authFrame").src = "login.php";
    }
  });
</script>
</body>
</html>
