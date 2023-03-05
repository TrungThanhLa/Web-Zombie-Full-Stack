<?php
session_start();
require_once '../backend/connection.php';

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
echo '<pre>';
print_r($cart);
echo '</pre>';


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
        <div class="Header">
            <div class="row">
                <div class="Logo">
                    <img src="img/Logo Zombie.jpg" class="LogoImg">
                </div>
                <div class="IconAnchor">
                    <i class="fab fa-facebook-f iconawesome"></i>
                    <i class="fab fa-instagram iconawesome"></i>
                    <i class="fas fa-search iconawesome"></i>
                    <i class="fas fa-user-circle iconawesome"></i>
                    <a href="Cart.php"><i class="fas fa-shopping-cart iconawesome"></i></a>
                </div>
            </div>
            <div class="MenuHeader">
                <ul class="ulMenu">
                    <li class="liMenu"><a href="Homepage.php" class="anchorList">Trang Chủ</a></li>
                    <li class="liMenu"><a href="Products_Frontend.php" class="anchorList">Sản phẩm</a>
                        <ul class="subMenu">
                            <li class="liSubMenu"><a href="Products_Frontend.php" class="anchorSubMenu">Tất cả sản phẩm - All Products</a></li>
                            <?php foreach ($categories AS $keys => $values):?>
                                <li class="liSubMenu"><a href="Products_Category.php?id=<?php echo $values['id_cat']; ?>" class="anchorSubMenu"><?php echo $values['name']; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li class="liMenu"><a href="News_Frontend.php" class="anchorList">Tin tức</a></li>
                    <li class="liMenu"><a href="#" class="anchorList">Tìm kiếm</a></li>
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
                foreach ($cart AS $key => $value):
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
                <h5>Tổng số tiền: <span style="color: red"><?php echo 1000 . 'đ'; ?></span> </h5>
            </div>
            <form action="" method="post">
            <div class="Method">
                <h5 style="margin-bottom: 30px">Chọn phương thức thanh toán</h5>
            <input type="radio" name="pay_method" value="0" checked="checked"> Thanh toán COD
            <br>
            <br>
                <div class="Form_COD">
                    <table border="0px" cellpadding="8" cellspacing="0" class="table_COD">
                        <tr>
                            <td style="padding: 20px 0px;"><label for="input">Họ và tên:</label></td>
                            <td><input type="text" name="name" id="input" placeholder="Họ và tên"></td>
                        </tr>
                        <tr>
                            <td style="padding: 20px 0px;"><label for="input">E-mail:</label></td>
                            <td><input type="email" name="email" id="input" placeholder="E-mail"></td>
                        </tr>
                        <tr>
                            <td style="padding: 20px 0px;"><label for="input">Số điện thoại:</label></td>
                            <td><input type="text" name="phone" id="input" placeholder="Số điện thoại"></td>
                        </tr>
                        <tr>
                            <td style="padding: 20px 0px;"><label for="input">Địa chỉ:</label></td>
                            <td><input type="text" name="address" id="input" placeholder="Địa chỉ"></td>
                        </tr>
                    </table>
                <br>
                <select name="city">
                    <option value="null">Chọn tỉnh/thành</option>
                    <option value="HN">Hà Nội</option>
                    <option value="HCM">Hồ Chí Minh</option>
                    <option value="ĐN">Đà Nẵng</option>
                </select>
                <select name="district" style="margin: 0px 10px;">
                    <option value="null">Chọn quận/huyện</option>
                    <option value="HN">Quận Hà Đông</option>
                    <option value="HCM">Quận 1</option>
                    <option value="ĐN">Quận Cẩm Lệ</option>
                </select>
                <select name="ward">
                    <option value="null">Chọn phường/xã</option>
                    <option value="HN">Hà Nội</option>
                    <option value="HCM">Hồ Chí Minh</option>
                    <option value="ĐN">Đà Nẵng</option>
                </select>
                </div>
            <input type="radio" name="pay_method" value="1"> Thanh toán Online
            </div>
            <div class="Payment">
                <button type="submit" href="#" name="submit" class="Pay">Thanh toán</button>
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
                <p class="Description">Thành lập tại Việt Nam, ZOMBIE® là một dự án ấp ủ đầy nhiệt huyết ra đời vào năm 2012. Những sản phẩm được truyền cảm hứng từ những bạn trẻ có sức ảnh hưởng lớn trong giới thời trang. ZOMBIE® đã và đang mang đến rất nhiều sản phẩm đẹp và giá cả phải chăng.</p>
                <img src="img/GOV.jpg" class="gov">
            </div>
            <div class="Link">
                <h3 class="FooterInformation">Liên kết</h3>
                <ul class="ulFooter">
                    <li class="lilink"><a href="#" class="anchor_text">FACEBOOK</a></li>
                    <li class="lilink"><a href="#" class="anchor_text">INSTAGRAM</a></li>
                    <li class="lilink"><a href="#" class="anchor_text">SHOPEE</a></li>
                    <li class="lilink"><a href="#" class="anchor_text">LAZADA</a></li>
                    <li class="lilink"><a href="#" class="anchor_text">TIKI</a></li>
                </ul>
            </div>
            <div class="ShopInfo">
                <h3 class="FooterInformation">Thông tin cửa hàng</h3>
                <div class="ShopLocationInfo">
                    <i class="fas fa-map-marker-alt"></i><span class="ShopInfoLocation">805 Hoàng Sa, P9, Q3, TP.HCM</span>
                    <br>
                </div>
                <div class="ShopLocationInfo">
                    <i class="fas fa-mobile-alt"></i><span class="ShopInfoLocation">079 939 1168</span>
                    <br>
                </div>
                <div class="ShopLocationInfo">
                    <i class="fas fa-envelope"></i><span class="ShopInfoLocation">zombiestudio6@gmail.com</span>
                </div>
            </div>
            <div class="Fanpage">
                <h3 class="FooterInformation">Fanpage</h3>

                <a href="https://www.facebook.com/thanhs.lider.5/" class="anchor_text"><img src="img/Fanpage.jpg" class="FanpageShop"></a>
            </div>
        </div>
    </div>
    <!-- /FOOTER -->
</div>
</body>
</html>
