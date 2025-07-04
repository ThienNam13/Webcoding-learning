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
</body>
</html>
