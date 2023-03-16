<?php
session_start();
require_once '../backend/connection.php';

if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {
    $id = $_GET['user_id'];
    $sql_select_user = "SELECT * FROM user_customer WHERE id = $id";
    $result_user = mysqli_query($connection, $sql_select_user);
    $user = mysqli_fetch_assoc($result_user);
    echo '<pre>';
    print_r($user);
    echo '</pre>';
}

$sql_select_products = "SELECT * FROM products ORDER BY created_at DESC LIMIT 8";
$result_all_products = mysqli_query($connection, $sql_select_products);
$products = mysqli_fetch_all($result_all_products, MYSQLI_ASSOC);
//echo '<pre>';
//print_r($products);
//echo '</pre>';

$sql_select_random = "SELECT * FROM products ORDER BY RAND() LIMIT 8";
$result_random = mysqli_query($connection, $sql_select_random);
$random_products = mysqli_fetch_all($result_random, MYSQLI_ASSOC);
//echo '<pre>';
//print_r($random_products);
//echo '</pre>';


$sql_select_all = "SELECT * FROM category WHERE status = 1";
$result_all = mysqli_query($connection, $sql_select_all);
$category = mysqli_fetch_all($result_all, MYSQLI_ASSOC);
//echo '<pre>';
//print_r($category);
//echo '</pre>';

$sql_select_homepage = "SELECT * FROM homepage ORDER BY created_at DESC";
$result_homepage = mysqli_query($connection, $sql_select_homepage);
$homepage = mysqli_fetch_assoc($result_homepage);
//echo '<pre>';
//print_r($homepage);
//echo '</pre>';

$sql_select_sale_poster = "SELECT sale_poster FROM img_sale_poster ORDER BY created_at DESC LIMIT 3";
$result_poster = mysqli_query($connection, $sql_select_sale_poster);
$sale_poster = mysqli_fetch_all($result_poster, MYSQLI_ASSOC);
//echo '<pre>';
//print_r($sale_poster);
//echo '</pre>';

$sql_select_sale_products = "SELECT sale_products FROM img_sale_products ORDER BY created_at DESC LIMIT 3";
$result_products = mysqli_query($connection, $sql_select_sale_products);
$sale_products = mysqli_fetch_all($result_products, MYSQLI_ASSOC);
//echo '<pre>';
//print_r($sale_products);
//echo '</pre>';

//echo '<pre>';
//print_r($_POST);
//echo '</pre>';

$error = '';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $sign_up = $_POST['submit'];
}
?>
<!-- Homepage.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trang Chủ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="container-fluid">
    <div class="ContainerHeader">
        <!-- HEADER -->
        <div class="Header">
            <div class="row">
                <div class="Logo">
                    <img src="img/Logo Zombie.jpg" class="LogoImg" style="margin-left: 50%;">
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
                            <?php foreach ($category AS $key => $value):?>
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
        <div class="SaleHeader">
            <img src="../backend/Homepage/main/<?php echo $homepage['main_img']; ?>" class="ImgSaleTop ImgSale" style="width: 1448px; height: 2048px;">
        </div>
    </div>
    <!-- /HEADER -->

    <!-- MAIN CONTENT -->
    <div class="MainContent">
        <div class="SaleRow">
            <div class="row">
                <?php foreach ($sale_poster AS $key1 => $value1): ?>
                <a href="#" >
                    <img src="../backend/Homepage/sale_poster/<?php echo $value1['sale_poster']; ?>" class="salerowimg" width="630px" height="630px" ">
                </a>
                <?php endforeach; ?>
            </div>
        </div>
        <a href="#" ><h2>SẢN PHẨM MỚI - NEW PRODUCTS</h2></a>
        <div class="ProductPR Top">
            <div class="ContainerContent">
                <div class="r_products">
                    <?php foreach ($products AS $key3 => $value3): ?>
                        <div class="ProductClothing">
                            <div class="ProductImage">
                                <?php if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {?>
                                    <a href="Detail.php?id=<?php echo $value3['id']; ?>&user_id=<?php echo $user['id']; ?>" ><img src="../backend/Products/uploads/<?php echo $value3['img']; ?>" class="imgProduct"></a>
                                <?php }
                                else { ?>
                                    <a href="Detail.php?id=<?php echo $value3['id']; ?>" ><img src="../backend/Products/uploads/<?php echo $value3['img']; ?>" class="imgProduct"></a>
                                <?php }?>

                            </div>
                            <div class="Product_Info">
                                <?php if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {?>
                                    <a href="Detail.php?id=<?php echo $value3['id']; ?>&user_id=<?php echo $user['id']; ?>" class="anchor_text"><p class="TitleProduct"><?php echo $value3['name']; ?></p></a>
                                <?php }
                                else { ?>
                                    <a href="Detail.php?id=<?php echo $value3['id']; ?>" class="anchor_text"><p class="TitleProduct"><?php echo $value3['name']; ?></p></a>
                                <?php }?>

                                <div class="Prices">
                                    <?php if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {?>
                                        <a href="Detail.php?id=<?php echo $value3['id']; ?>&user_id=<?php echo $user['id']; ?>" class="Price"><?php
                                            if ($value3['sale_price'] == 0) {
                                                echo number_format($value3['price'], 0 , '.', ',') . 'đ';
                                            }
                                            else {
                                                echo '<a href="#" class="Price" style="text-decoration: line-through">' . number_format($value3['price'], 0 , '.', ',') . 'đ' . '</a>';
                                                echo '<a href="#" class="Sale_Price">' . number_format($value3['sale_price'], 0, '.', ',') . 'đ' . '</a>' ;
                                            }
                                            ?>
                                        </a>
                                    <?php }
                                    else { ?>
                                        <a href="Detail.php?id=<?php echo $value3['id']; ?>" class="Price"><?php
                                            if ($value3['sale_price'] == 0) {
                                                echo number_format($value3['price'], 0 , '.', ',') . 'đ';
                                            }
                                            else {
                                                echo '<a href="#" class="Price" style="text-decoration: line-through">' . number_format($value3['price'], 0 , '.', ',') . 'đ' . '</a>';
                                                echo '<a href="#" class="Sale_Price" style="color: red">' . number_format($value3['sale_price'], 0, '.', ',') . 'đ' . '</a>' ;
                                            }
                                            ?>
                                        </a>
                                    <?php }?>
                                </div>
                                <br>
                                <br>
                                <div class="Order_Product">
                                    <?php if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {?>
                                        <a class="Order" href="Order.php?id=<?php echo $value3['id'];?>&user_id=<?php echo $user['id']; ?>">Thêm vào giỏ hàng</a>
                                    <?php }
                                    else { ?>
                                        <a class="Order" href="Order.php?id=<?php echo $value3['id'];?>">Thêm vào giỏ hàng</a>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="HoodieRow">
                <div class="row">
                    <?php foreach ($sale_products AS $key2 => $value2): ?>
                        <a href="#" >
                            <img src="../backend/Homepage/sale_products/<?php echo $value2['sale_products']; ?>" class="salerowimg" width="630px" height="630px" ">
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <a href="#" ><h2><?php echo $homepage['title']; ?></h2></a>
        <div class="ProductPR Bottom">
            <div class="ContainerContent">
                <div class="r_products">
                    <?php foreach ($random_products AS $key4 => $value4): ?>
                        <div class="ProductClothing">
                            <div class="ProductImage">
                                <?php if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {?>
                                    <a href="Detail.php?id=<?php echo $value4['id']; ?>&user_id=<?php echo $user['id']; ?>" ><img src="../backend/Products/uploads/<?php echo $value4['img']; ?>" class="imgProduct"></a>
                                <?php }
                                else { ?>
                                    <a href="Detail.php?id=<?php echo $value4['id']; ?>" ><img src="../backend/Products/uploads/<?php echo $value4['img']; ?>" class="imgProduct"></a>
                                <?php }?>

                            </div>
                            <div class="Product_Info">
                                <?php if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {?>
                                    <a href="Detail.php?id=<?php echo $value4['id']; ?>&user_id=<?php echo $user['id']; ?>" class="anchor_text"><p class="TitleProduct"><?php echo $value4['name']; ?></p></a>
                                <?php }
                                else { ?>
                                    <a href="Detail.php?id=<?php echo $value4['id']; ?>" class="anchor_text"><p class="TitleProduct"><?php echo $value4['name']; ?></p></a>
                                <?php }?>

                                <div class="Prices">
                                    <?php if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {?>
                                        <a href="Detail.php?id=<?php echo $value4['id']; ?>&user_id=<?php echo $user['id']; ?>" class="Price"><?php
                                            if ($value4['sale_price'] == 0) {
                                                echo number_format($value3['price'], 0 , '.', ',') . 'đ';
                                            }
                                            else {
                                                echo '<a href="#" class="Price" style="text-decoration: line-through">' . number_format($value4['price'], 0 , '.', ',') . 'đ' . '</a>';
                                                echo '<a href="#" class="Sale_Price">' . number_format($value4['sale_price'], 0, '.', ',') . 'đ' . '</a>' ;
                                            }
                                            ?>
                                        </a>
                                    <?php }
                                    else { ?>
                                        <a href="Detail.php?id=<?php echo $value4['id']; ?>" class="Price"><?php
                                            if ($value4['sale_price'] == 0) {
                                                echo number_format($value4['price'], 0 , '.', ',') . 'đ';
                                            }
                                            else {
                                                echo '<a href="#" class="Price" style="text-decoration: line-through">' . number_format($value4['price'], 0 , '.', ',') . 'đ' . '</a>';
                                                echo '<a href="#" class="Sale_Price" style="color: red">' . number_format($value4['sale_price'], 0, '.', ',') . 'đ' . '</a>' ;
                                            }
                                            ?>
                                        </a>
                                    <?php }?>
                                </div>
                                <br>
                                <br>
                                <div class="Order_Product">
                                    <?php if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {?>
                                        <a class="Order" href="Order.php?id=<?php echo $value4['id'];?>&user_id=<?php echo $user['id']; ?>">Thêm vào giỏ hàng</a>
                                    <?php }
                                    else { ?>
                                        <a class="Order" href="Order.php?id=<?php echo $value4['id'];?>">Thêm vào giỏ hàng</a>
                                    <?php }?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="SupportBackground">
                <div class="Support">
                    <div class="row">
                        <div class="Signup">
                            <i class="fas fa-envelope-open-text"></i>
                            <span class="SupportandBuy">Đăng kí nhận tin</span>
                        </div>
                        <div class="emailInput" style="display: flex;">
                            <form action="" method="post">
                            <input type="email" name="email" placeholder="Nhập email của bạn">
                            <input type="submit" name="submit" class="Submit" value="ĐĂNG KÍ" style="background: #D0021B; padding: 10px; color: white; display: inline-block">
                            </form>
                        </div>
                        <div class="telephone">
                            <i class="fas fa-phone-square-alt"></i>
                            <span class="SupportandBuy"> Hỗ trợ/Mua hàng:<a href="#">           079 939 1168</a></span>
                        </div>
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
                    <li class="lilink"><a href="#">FACEBOOK</a></li>
                    <li class="lilink"><a href="#">INSTAGRAM</a></li>
                    <li class="lilink"><a href="#">SHOPEE</a></li>
                    <li class="lilink"><a href="#">LAZADA</a></li>
                    <li class="lilink"><a href="#">TIKI</a></li>
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

                <a href="https://www.facebook.com/thanhs.lider.5/"><img src="img/Fanpage.jpg" class="FanpageShop"></a>
            </div>
        </div>
    </div>
    <!-- /FOOTER -->
</div>
</body>
</html>
