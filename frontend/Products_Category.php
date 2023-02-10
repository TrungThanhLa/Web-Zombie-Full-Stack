<?php
require_once '../backend/connection.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['error'] = 'ID danh mục sản phẩm không hợp lệ';
    header('Location: Homepage.php');
    exit();
}

$id = $_GET['id'];

$sql_select_all = "SELECT * FROM products WHERE id_cat = $id AND status = 1";
$result_all = mysqli_query($connection, $sql_select_all);
$products = mysqli_fetch_all($result_all, MYSQLI_ASSOC);
//echo '<pre>';
//print_r($products);
//echo '</pre>';

$sql_select_one = "SELECT * FROM category WHERE id_cat = $id AND status = 1";
$result_one = mysqli_query($connection, $sql_select_one);
$category = mysqli_fetch_assoc($result_one);
//echo '<pre>';
//print_r($category);
//echo '</pre>';

$sql_select_cate = "SELECT * FROM category WHERE status = 1";
$result_cate = mysqli_query($connection, $sql_select_cate);
$categories = mysqli_fetch_all($result_cate, MYSQLI_ASSOC);
//echo '<pre>';
//print_r($categories);
//echo '</pre>';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $category['name']; ?> - ZOMBIE OFFICIAL</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/style2.css">
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
                    <i class="fas fa-shopping-cart iconawesome"></i>
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
                <span class="BarItems"><a href="Homepage.php">Trang chủ</a> / <a href="#">Danh mục</a> / <a href="Products_Category.php?id=<?php echo $category['id_cat'];?>"><?php echo $category['name']; ?></a></span>
            </div>
        </div>
        <div class="AllProducts">
            <div class="AllProducts">
                <h2 class="h2Products"><?php echo $category['name']; ?></h2>
            </div>
            <div class="ContainerContent">
                <div class="r_products">
                    <?php foreach ($products AS $key => $value):?>
                    <div class="ProductClothing">
                        <div class="ProductImage">
                        <a href="#" ><img src="../backend/Products/uploads/<?php echo $value['img']; ?>" class="imgProduct"></a>
                        </div>
                        <div class="Product_Info">
                        <a href="#" class="anchor_text"><p class="TitleProduct"><?php echo $value['name']; ?></p></a>
                            <div class="Prices">
                                <a href="#" class="Price"><?php
                                    if ($value['sale_price'] == 0) {
                                        echo number_format($value['price'], 0 , '.', ',') . 'đ';
                                    }
                                    else {
                                        echo '<a href="#" class="Price" style="text-decoration: line-through">' . number_format($value['price'], 0 , '.', ',') . 'đ' . '</a>';
                                        echo '<a href="#" class="Sale_Price">' . number_format($value['sale_price'], 0, '.', ',') . 'đ' . '</a>' ;
                                    }
                                    ?>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
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

