<?php
session_start();
require_once '../backend/connection.php';

if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {
    $id = $_GET['user_id'];
    $sql_select_user = "SELECT * FROM user_customer WHERE id = $id";
    $result_user = mysqli_query($connection, $sql_select_user);
    $user = mysqli_fetch_assoc($result_user);
//    echo '<pre>';
//    print_r($user);
//    echo '</pre>';
}

$sql_select_cate = "SELECT * FROM category WHERE status = 1";
$result_cate = mysqli_query($connection, $sql_select_cate);
$categories = mysqli_fetch_all($result_cate, MYSQLI_ASSOC);

if (!empty($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
}
elseif (empty($_SESSION['cart'])) {
    header('Location: Cart.php');
    exit();
}
//echo '<pre>';
//print_r($cart);
//echo '</pre>';
//
//echo '<pre>';
//print_r($_POST);
//echo '</pre>';

$error = '';

if (isset($_POST['submit']) && $_POST['pay_method'] == 0) {
    $pay_method = $_POST['pay_method'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $note = $_POST['note'];

    if (empty($name) || empty($email) || empty($phone) || empty($address)) {
        $error = 'Hãy nhập đầy đủ thông tin';
    }
    elseif ($_POST['city'] == 'null') {
        $error = 'Vui lòng chọn tỉnh/thành';
    }
    elseif ($_POST['district'] == 'null') {
        $error = 'Vui lòng chọn quận/huyện';
    }
    elseif ($_POST['ward'] == 'null') {
        $error = 'Vui lòng chọn phường/xã';
    }

    if (empty($error)) {
        if ($pay_method == 0) {
            $pay_method = 'Ship COD';
        }
        $sql_insert = "INSERT INTO orders (id_user, name, email, note, address, city, district, ward, phone, pay_method, status)
        VALUES('$user[id]', '$name', '$email', '$note', '$address', '$_POST[city]', '$_POST[district]', '$_POST[ward]' , '$phone', '$pay_method', 'Đang khởi tạo') ";
        $is_insert = mysqli_query($connection, $sql_insert);
        if ($is_insert) {
            // Lấy id của bảng orders và gán vào biến id_order của bảng order_detail
            $id_order = mysqli_insert_id($connection);
            var_dump($id_order);
            //Foreach cart ra để dùng biến value lấy thông tin của sản phẩm
            foreach ($cart AS $key1 => $value1) {
                if ($value1['sale_price'] != 0) {
                    $sql_insert_detail = "INSERT INTO order_detail(id_orders, id_products, quantity, price)
                VALUES ('$id_order', '$value1[id]', '$value1[quantity]', '$value1[sale_price]')";
                }
                if ($value1['sale_price'] == 0) {
                    $sql_insert_detail = "INSERT INTO order_detail(id_orders, id_products, quantity, price)
                VALUES ('$id_order', '$value1[id]', '$value1[quantity]', '$value1[price]')";
                }
                $is_insert_detail = mysqli_query($connection, $sql_insert_detail);
                var_dump($is_insert_detail);
            }
            unset($_SESSION['cart']);
            unset($_SESSION['new_number_in_cart']);
            header('Location: Homepage.php?user_id=' . $user['id']);
        }
    }
}



?>

<!-- Pay.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trang thanh toán - ZOMBIE OFFICIAL STORE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/style9.css">
</head>
<body>
<div class="container-fluid">
    <!-- HEADER -->
    <div class="ContainerHeader">
        <!-- HEADER -->
        <div class="Header">
            <div class="row">
                <div class="Logo">
                    <img src="../backend/assets/images/Logo_Youg.jpg" class="LogoImg" style="margin-left: 50%;">
                </div>
                <div class="IconAnchor">
                    <?php if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {?>
                        <a href="Profile/Profile.php?user_id=<?php echo $user['id']; ?>" title="Profile" style="font-size: 22px;"><i class="fa-solid fa-user"></i></a>
                    <?php }
                    else {
                        echo '';
                    }
                    ?>

                    <?php if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {
                        echo '<a href="Login&&out/Logout.php" class="Logout" style="font-size: 22px; padding: 0px 20px;" title="Đăng xuất"><i class="fa-solid fa-right-from-bracket"></i></a>';
                    }
                    else {
                        echo '<a href="Login&&out/Login.php" class="Login" style="font-size: 22px; padding: 0px 20px;" title="Đăng nhập"><i class="fas fa-sign-in-alt"></i></a>';
                    }
                    ?>

                    <?php if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {?>
                        <a href="Cart.php?user_id=<?php echo $user['id']; ?>" title="Giỏ hàng"><i class="fas fa-shopping-cart iconawesome"></i></a>
                    <?php }
                    else {
                        echo '<a href="Cart.php" title="Giỏ hàng"><i class="fas fa-shopping-cart iconawesome"></i></a>';
                    }
                    ?>

                </div>
            </div>
            <p style="color: red"><?php
                if (isset($_SESSION['error'])) {
                    echo '<div class="alert alert-danger">';
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    echo '</div>';
                }
                ?>
            </p>
            <p style="color: green"><?php
                if (isset($_SESSION['success'])) {
                    echo '<div class="alert alert-success">';
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    echo '</div>';
                }
                ?>
            </p>
            <div class="MenuHeader">
                <ul class="ulMenu">
                    <li class="liMenu"><?php if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {?>
                            <a href="Homepage.php?user_id=<?php echo $user['id']; ?>" class="anchorList">Trang Chủ</a>
                        <?php }
                        else {
                            echo '<a href="Homepage.php" class="anchorList">Trang Chủ</a>';
                        }
                        ?>
                    </li>
                    <li class="liMenu"><?php if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {?>
                            <a href="Products_Frontend.php?user_id=<?php echo $user['id']; ?>" class="anchorList">Sản phẩm</a>
                        <?php }
                        else {
                            echo '<a href="Products_Frontend.php" class="anchorList">Sản phẩm</a>';
                        }
                        ?>
                        <ul class="subMenu">
                            <li class="liSubMenu"><?php if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {?>
                                    <a href="Products_Frontend.php?user_id=<?php echo $user['id']; ?>" class="anchorSubMenu">Tất cả sản phẩm - All Products</a>
                                <?php }
                                else {
                                    echo '<a href="Products_Frontend.php" class="anchorSubMenu">Tất cả sản phẩm - All Products</a>';
                                }
                                ?>
                                <?php foreach ($categories AS $key => $value):?>
                            <li class="liSubMenu"><?php if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {?>
                                    <a href="Products_Category.php?id=<?php echo $value['id_cat']; ?>&&user_id=<?php echo $user['id']; ?>" class="anchorSubMenu"><?php echo $value['name']; ?></a>
                                <?php }
                                else { ?>
                                    <a href="Products_Category.php?id=<?php echo $value['id_cat']; ?>" class="anchorSubMenu"><?php echo $value['name']; ?></a>
                                <?php } endforeach; ?>
                        </ul>
                    </li>
                    <li class="liMenu"><?php if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {?>
                            <a href="News_Frontend.php?user_id=<?php echo $user['id']; ?>" class="anchorList">Tin tức</a>
                        <?php }
                        else {
                            echo '<a href="News_Frontend.php" class="anchorList">Tin tức</a>';
                        }
                        ?>
                    </li>
                    <li class="liMenu"><?php if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {?>
                            <a href="Introduce.php?user_id=<?php echo $user['id']; ?>" class="anchorList">Giới thiệu</a>
                        <?php }
                        else {
                            echo '<a href="Introduce.php" class="anchorList">Giới thiệu</a>';
                        }
                        ?></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /HEADER -->

    <!-- MAIN CONTENT -->
    <div class="MainContent">
        <div class="bar">
            <div class="BarBackground">
                <span class="BarItems"><a href="Homepage.php">Trang chủ</a> / <a href="Cart.php">Giỏ hàng</a> / <a href="Pay.php">Thanh toán</a>
            </div>
        </div>
        <div class="YourCart">
            <h2>Trang thanh toán</h2>
<!--            <p class="pDesh2">Có <span style="color: red"> --><?php
//                    if (isset($_SESSION['new_number'])) {
//                        echo $_SESSION['new_number'];
//                    }
//                    else {
//                        echo '0';
//                    }
//                    ?><!-- </span> sản phẩm trong giỏ hàng</p>-->
            <div class="crossbar"></div>
        </div>
        <div class="CartContainer">
            <table class="tableCart" border="1" cellspacing="0" cellpadding="8">
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Ảnh sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                </tr>
                <?php
                $number = 1;
                $total_price = 0;
                foreach ($cart AS $key => $value):
                    $price_number = 0;
                    if ($value['sale_price'] != 0) {
                        $price_number = $price_number + ($value['sale_price'] * $value['quantity']);
                    }
                    else {
                        $price_number = $price_number + ($value['price'] * $value['quantity']);
                    }
                    $total_price = $total_price + $price_number;
                    ?>
                    <tr>
                        <td><?php
                            $_SESSION['number'] = $number;
                            echo $number++;
                            $_SESSION['new_number'] = $_SESSION['number'];
                            ?>
                        </td>
                        <td><?php echo $value['name']; ?></td>
                        <td style="padding: 20px 0px;"><img src="../backend/Products/uploads/<?php echo $value['img']; ?>" width="150px" height="100px"></td>
                        <td>
                            <input type="number" name="quantity" class="quantity" value="<?php echo $value['quantity']; ?>" readonly>
                        </td>
                        <td><?php if ($value['sale_price'] != 0 ) {
                                echo '<span style="color:red;">' . number_format($value['sale_price']) . 'đ</span>' ;
                            }
                            else {
                                echo number_format($value['price']) . 'đ';
                            }?>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <div class="Total">
                <h5>Tổng số tiền: <span style="color: red"><?php echo number_format($total_price) . 'đ'; ?></span> </h5>
            </div>
            <form action="" method="post">
            <div class="Method">
                <h5 style="margin-bottom: 30px">Chọn phương thức thanh toán</h5>
            <input type="radio" name="pay_method" value="0" checked="checked"> Thanh toán COD
            <br>
            <br>
                <p class="error_alert" style="color: red"><?php echo $error; ?></p>
                <div class="Form_COD">
                    <table border="0px" cellpadding="8" cellspacing="0" class="table_COD">
                        <tr>
                            <td style="padding: 20px 0px;"><label for="input">Họ và tên:</label></td>
                            <td><input type="text" name="name" id="input" placeholder="Họ và tên" value="<?php echo $user['full_name']; ?>"></td>
                        </tr>
                        <tr>
                            <td style="padding: 20px 0px;"><label for="input">E-mail:</label></td>
                            <td><input type="email" name="email" id="input" placeholder="E-mail" value="<?php echo $user['email']; ?>"></td>
                        </tr>
                        <tr>
                            <td style="padding: 20px 0px;"><label for="input">Số điện thoại:</label></td>
                            <td><input type="text" name="phone" id="input" placeholder="Số điện thoại" value="<?php echo $user['phone']; ?>"></td>
                        </tr>
                        <tr>
                            <td style="padding: 20px 0px;"><label for="input">Địa chỉ:</label></td>
                            <td><input type="text" name="address" id="input" placeholder="Địa chỉ"></td>
                        </tr>
                        <tr>
                            <td style="padding: 20px 0px;"><label for="input">Ghi chú:</label></td>
                            <td><textarea name="note" id="input" placeholder="Ghi chú..."></textarea></td>
                        </tr>
                    </table>
                <br>
                    <div class="select_location">
                <select name="city">
                    <option value="null">Chọn tỉnh/thành</option>
                    <option value="HN">Hà Nội</option>
                    <option value="HCM">Hồ Chí Minh</option>
                    <option value="ĐN">Đà Nẵng</option>
                </select>
                <select name="district" style="margin: 0px 10px;">
                    <option value="null">Chọn quận/huyện</option>
                    <option value="HĐ">Quận Hà Đông</option>
                    <option value="Q1">Quận 1</option>
                    <option value="CL">Quận Cẩm Lệ</option>
                </select>
                <select name="ward">
                    <option value="null">Chọn phường/xã</option>
                    <option value="QT">Phường Quang Trung</option>
                    <option value="PNL">Phường Phạm Ngũ Lão</option>
                    <option value="HP">Phường Hòa Phát</option>
                </select>
                    </div>
                </div>
            </div>
                <div class="Online_Payment">
                <input type="radio" name="pay_method" value="1"> Thanh toán Online
                </div>
            <div class="Payment">
                <button type="submit" href="#" name="submit" class="Pay" onclick="return confirm('Xán nhận thanh toán ?')">Thanh toán</button>
            </div>
            </form>
        </div>
        <div class="SupportBackground">
            <div class="Support">
                <div class="row">
                    <div class="Signup">
                        <i class="fas fa-envelope-open-text"></i>
                        <span class="SupportandBuy">Đăng kí nhận tin</span>
                    </div>
                    <div class="emailInput">
                        <input type="email" name="email" placeholder="Nhập email của bạn">
                        <a href="#" class="BoxSignUp" class="anchor_text">
                            <span class="spSignUp">ĐĂNG KÍ</span>
                        </a>
                    </div>
                    <div class="telephone">
                        <i class="fas fa-phone-square-alt"></i>
                        <span class="SupportandBuy"> Hỗ trợ/Mua hàng:<a href="#" class="anchor_text">           079 939 1168</a></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /MAIN CONTENT -->

    <!-- FOOTER -->
    <div class="Footer">
        <div class="row">
            <div class="AboutUs">
                <h3 class="FooterInformation">Về chúng tôi</h3>
                <p><a href="#" style="color: #CD0439;">Youg 2T Clothing Store</a> là website bán hàng Online chuyên cung cấp
                    và phân phối các loại quần, áo, phụ kiện,... đậm chất tính thời thượng và luôn chạy theo xu hướng của thời trang trong
                    xã hội hiện đại.
                </p>
                <img src="img/GOV.jpg" class="gov">
            </div>
            <div class="Link">
                <h3 class="FooterInformation">Liên kết</h3>
                <ul class="ulFooter">
                    <li class="lilink"><a href="https://www.facebook.com/thanhs.lider.5/">FACEBOOK</a></li>
                    <li class="lilink"><a href="https://www.instagram.com/justlathahh/?fbclid=IwAR02WQLMgBrSweKmDcPI2iSwtQaWGlV00FscyrGOYfARGk9SGJvIlxqYg3A">INSTAGRAM</a></li>
                    <li class="lilink"><a href="#">SHOPEE</a></li>
                    <li class="lilink"><a href="#">LAZADA</a></li>
                    <li class="lilink"><a href="#">TIKI</a></li>
                </ul>
            </div>
            <div class="ShopInfo">
                <h3 class="FooterInformation">Thông tin cửa hàng</h3>
                <div class="ShopLocationInfo">
                    <i class="fas fa-map-marker-alt"></i><span class="ShopInfoLocation">Hà Đông, Hà Nội</span>
                    <br>
                </div>
                <div class="ShopLocationInfo">
                    <i class="fas fa-mobile-alt"></i><span class="ShopInfoLocation">094 392 0250</span>
                    <br>
                </div>
                <div class="ShopLocationInfo">
                    <i class="fas fa-envelope"></i><span class="ShopInfoLocation">trungthanhla1110@gmail.com</span>
                </div>
            </div>
            <div class="Fanpage">
                <h3 class="FooterInformation">Fanpage</h3>
                <a href="https://www.facebook.com/thanhs.lider.5/"><img src="../backend/assets/images/Logo_Youg.jpg" class="FanpageShop" style="width: 150px;margin-left: 100px;"></a>
            </div>
        </div>
    </div>
    <!-- /FOOTER -->
</div>
</body>
</html>
