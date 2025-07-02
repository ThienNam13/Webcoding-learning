<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/foods.css" />
    <link rel="stylesheet" href="../assets/themify-icons-font/themify-icons/themify-icons.css">
</head>
<body>
    <?php
    $link=@mysqli_connect("localhost","root","") or die ("Connect failed");
    mysqli_select_db($link,"orderingfooddb") or die ("No db");
    ?>
    <div id="content">
        <!-- Add food -->
        <div class="button-add-food">
            <button><i class="icon-add">+</i> Thêm món ăn</button>
        </div>
        <div class="form-add-food">
            <h3>Thêm món ăn</h3>
            <form action="" method="post">
                <div class="attri">
                    <div class="name-attri">Ảnh: </div>
                    <input type="text" name="hinh_anh"></div>
                <div class="attri">
                    <div class="name-attri">Tên món ăn: </div>
                    <input type="text"name="ten_mon"></div>
                <div class="attri">
                    <div class="name-attri">Mô tả: </div>
                    <input type="text" name="mo_ta"></div>
                <div class="attri">
                    <div class="name-attri">Giá tiền: </div>
                    <input type="text" name="gia"></div>
                <div class="attri">
                    <div class="name-attri">Loại: </div>
                    <select name="loai" id="">
                        <option value="Khuyến mãi">Khuyến mãi</option>
                        <option value="Món mới">Món mới</option>
                        <option value="Combo">Combo</option>
                        <option value="Gà rán">Gà rán</option>
                        <option value="Burger-Cơm-Mì ý">Burger-Cơm-Mì ý</option>
                        <option value="Tráng miệng">Tráng miệng</option>                        
                    </select></div>
                <div class="attri">
                    <div class="name-attri">Trạng thái: </div>
                    <select name="is_available" id="">
                        <option value="1">Còn</option>
                        <option value="0">Hết</option>
                    </select></div>
                <div class="button-submit">
                    <input type="submit" id="submit" name="submit" value="Thêm">
                </div>
            </form>
            <script>
                
            </script>
            <?php
            if (isset($_POST["submit"])){
                $ten_mon = $_POST["ten_mon"];
                $mo_ta = $_POST["mo_ta"];
                $gia = $_POST["gia"];
                $hinh_anh = $_POST["hinh_anh"];
                $loai = $_POST["loai"];
                $is_available = $_POST["is_available"];
                if($ten_mon =="" || $mo_ta =="" || $gia =="" 
                   || $hinh_anh =="" || $loai =="" || $is_available ==""){
                    echo "<script>alert('Vui lòng điền đầy đủ thông tin.');</script>";
                } else {
                    $check ="SELECT * FROM foods WHERE ten_mon='$ten_mon'";
                    $result = mysqli_query($link, $check);

                    if (mysqli_num_rows($result)==0){
                        $insert = "INSERT INTO foods (ten_mon, mo_ta, gia, hinh_anh, loai, is_available) 
                                   VALUES ('$ten_mon', '$mo_ta', '$gia', '$hinh_anh', '$loai', '$is_available')";
                        mysqli_query($link, $insert);
                    }
                }
            }
            ?>
        </div>
        
        <!-- Table foods -->
        <div class="foods-list" align= "center">
            <table>
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Hình ảnh</th>
                        <th>Tên món ăn</th>
                        <th>Mô tả</th>
                        <th>Giá tiền</th>
                        <th>Loại</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead> 
                <tbody>
                    <?php
                    $sl="select ten_mon, mo_ta, gia, hinh_anh, loai, is_available from foods";
                    $fd=mysqli_query($link, $sl);
                    $stt=1;
                    while ($d=mysqli_fetch_array($fd)){
                    ?>
                    <tr>
                        <td><?php echo $stt++;?></td>
                        <td><?php echo $d["hinh_anh"]?></td>
                        <td><?php echo $d["ten_mon"]?></td>
                        <td><?php echo $d["mo_ta"]?></td>
                        <td><?php echo $d["gia"]?></td>
                        <td><?php echo $d["loai"]?></td>
                        <td><?php echo $d["is_available"] == 1 ? "Còn" : "Hết";?></td>
                        <td>
                            <a href=""><i class="icon-edit ti-pencil"></i></a>
                            <a href=""><i class="icon-trash ti-trash"></i></a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>  
            </table>
        </div>
    </div>
    
</body>
</html>