<?php $title = "Thực đơn | KFJoli"; $page = 'menu'; 
include("header.php"); ?>
<link rel="stylesheet" href="./assets/css/menu.css">
<script src="./assets/js/add-to-cart.js"></script>
<script src="./assets/js/search.js"></script>

<!-- Tabs danh mục -->
<div id="extra-nav">
  <div class="container-extra">
    <div class="menu-tabs">
      <a href="#khuyen-mai" class="tab active">Khuyến mãi</a>
      <a href="#mon-moi" class="tab">Món mới</a>
      <a href="#combo" class="tab">Combo</a>
      <a href="#ga-ran" class="tab">Gà rán</a>
      <a href="#burger-com-my-y" class="tab">Burger - Cơm - Mỳ ý</a>
      <a href="#trang-mieng" class="tab">Tráng Miệng</a>  
      <?php if (isset($page) && $page === 'menu'): ?>
  
              <form class="search tab">
                  <input type="text" id="searchInput" class="search-box" placeholder="Nhập món ăn cần tìm ...">
                  <button onclick="searchFood()">Tìm kiếm</button>
              </form>
              <div class="shopping-cart tab">
                  <a href="cart.php"><i class="icon-cart ti-shopping-cart"></i></a>
              </div>
          <?php endif; ?>
    </div>
  </div>
</div>

<!-- Danh mục: Khuyến mãi -->
<div class="food-title">
  <h2 id="khuyen-mai" >Khuyến mãi</h2>
    <div class="food-container">
      <div class="food-card">
        <img src="./assets/img/food/khoai_lac.png" alt="Khoai lắc phô mai">
        <h3>Khoai lắc phô mai</h3>
        <p>Khoai tây chiên giòn rắc phô mai thơm lừng</p>
        <p class="price" data-value="19000">19.000₫</p>
        <button class="btn-add" data-id="10">Thêm món</button>
      </div>
      <div class="food-card">
        <img src="./assets/img/food/ga_popcorn.png" alt="Gà popcorn">
        <h3>Gà popcorn</h3>
        <p>Miếng gà nhỏ giòn rụm, ăn vặt siêu cuốn</p>
        <p class="price" data-value="27000">27.000₫</p>
        <button class="btn-add" data-id="11">Thêm món</button>
      </div>
      <div class="food-card">
        <img src="./assets/img/food/pepsi_zero.png" alt="Pepsi không calo">
        <h3>Pepsi không calo</h3>
        <p>Pepsi không đường, không calo, mát lạnh sảng khoái</p>
        <p class="price" data-value="12000">12.000₫</p>
        <button class="btn-add" data-id="12">Thêm món</button>
      </div>
    </div>
</div>

<!-- Danh mục: Món mới -->
<div class="food-title">
  <h2 id="mon-moi">Món mới</h2>
    <div class="food-container">
      <div class="food-card">
        <img src="./assets/img/food/matcha_latte.png" alt="Matcha Latte Kem Sữa">
        <h3>Matcha Latte Kem Sữa</h3>
        <p>Matcha đậm vị, thêm lớp kem sữa béo mịn phía trên</p>
        <p class="price" data-value="32000">32.000₫</p>
        <button class="btn-add" data-id="9">Thêm món</button>
      </div>
    </div>
</div>

<!-- Danh mục: Combo -->
<div class="food-title">
  <h2 id="combo">Combo</h2>
    <div class="food-container">
      <div class="food-card">
        <img src="./assets/img/food/combo-co-don.png" alt="Combo cô đơn">
        <h3>Combo cô đơn</h3>
        <p>1 gà rán + 1 mì ý hoặc 1 hamburger + 1 nước</p>
        <p class="price" data-value="79000">79.000₫</p>
        <button class="btn-add" data-id="1">Thêm món</button>
      </div>
      <div class="food-card">
        <img src="./assets/img/food/combo_cap_doi.png" alt="Combo cặp đôi">
        <h3>Combo cặp đôi</h3>
        <p>2 gà rán + 1 mì ý + 1 hamburger + khoai + 2 nước</p>
        <p class="price" data-value="129000">129.000₫</p>
        <button class="btn-add" data-id="6">Thêm món</button>
      </div>
      <div class="food-card">
        <img src="./assets/img/food/combo_gia_dinh.png" alt="Combo gia đình">
        <h3>Combo gia đình</h3>
        <p>3 gà rán + 2 mì ý + 1 hamburger + 2 khoai + 3 nước</p>
        <p class="price" data-value="179000">179.000₫</p>
        <button class="btn-add" data-id="7">Thêm món</button>
      </div>
      <div class="food-card">
        <img src="./assets/img/food/combo_tiec_vui.png" alt="Combo tiệc vui">
        <h3>Combo tiệc vui</h3>
        <p>5 gà rán + 3 mì ý + 2 hamburger + 3 khoai + 5 nước</p>
        <p class="price" data-value="279000">279.000₫</p>
        <button class="btn-add" data-id="8">Thêm món</button>
      </div>
    </div>
</div>

<!-- Danh mục: Gà rán -->
<div class="food-title">
  <h2 id="ga-ran">Gà rán</h2>
    <div class="food-container">
      <div class="food-card">
        <img src="./assets/img/food/ga_x2.png" alt="Gà x2">
        <h3>Gà x2</h3>
        <p>2 miếng gà rán giòn tan, đậm vị truyền thống</p>
        <p class="price" data-value="65000">65.000₫</p>
        <button class="btn-add" data-id="2">Thêm món</button>
      </div>
    </div>
</div>

<!-- Danh mục: Burger - Cơm - Mỳ ý -->
<div class="food-title">
  <h2 id="burger-com-my-y">Burger - Cơm - Mỳ ý</h2>
    <div class="food-container">
      <div class="food-card">
        <img src="./assets/img/food/my_y.png" alt="Mì Ý sốt bò bằm">
        <h3>Mì Ý sốt bò bằm</h3>
        <p>Mì Ý sợi mềm, phủ sốt bò bằm đậm đà</p>
        <p class="price" data-value="35000">35.000₫</p>
        <button class="btn-add" data-id="3">Thêm món</button>
      </div>
      <div class="food-card">
        <img src="./assets/img/food/hamburger.png" alt="Hamburger gà chiên">
        <h3>Hamburger gà chiên</h3>
        <p>Bánh mì kẹp gà giòn, rau và sốt đặc trưng</p>
        <p class="price" data-value="35000">35.000₫</p>
        <button class="btn-add" data-id="4">Thêm món</button>
      </div>
    </div>
</div>

<!-- Danh mục: Tráng miệng -->
<div class="food-title">
  <h2 id="trang-mieng">Tráng miệng</h2>
    <div class="food-container">
      <div class="food-card">
        <img src="./assets/img/food/tra_dao_cheese.png" alt="Trà đào kem cheese">
        <h3>Trà đào kem cheese</h3>
        <p>Trà đào mát lạnh, phủ kem cheese béo mịn</p>
        <p class="price" data-value="30000">30.000₫</p>
        <button class="btn-add" data-id="5">Thêm món</button>
      </div>
    </div>
</div>

<?php include("footer.php"); ?>
