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
                            <?php if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {?>
                                <a href="Detail.php?id=<?php echo $value['id']; ?>&user_id=<?php echo $user['id']; ?>" ><img src="../backend/Products/uploads/<?php echo $value['img']; ?>" class="imgProduct"></a>
                            <?php }
                            else { ?>
                                <a href="Detail.php?id=<?php echo $value['id']; ?>" ><img src="../backend/Products/uploads/<?php echo $value['img']; ?>" class="imgProduct"></a>
                            <?php } ?>
                        </div>

                        <div class="Product_Info">
                            <?php if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {?>
                                <a href="Detail.php?id=<?php echo $value['id']; ?>&user_id=<?php echo $user['id']; ?>" class="anchor_text"><p class="TitleProduct"><?php echo $value['name']; ?></p></a>
                            <?php }
                            else { ?>
                                <a href="Detail.php?id=<?php echo $value['id']; ?>" class="anchor_text"><p class="TitleProduct"><?php echo $value['name']; ?></p></a>
                            <?php } ?>
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
                            <br>
                            <br>
                            <div class="Order_Product">
                                <?php if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {?>
                                    <a class="Order" href="Order.php?id=<?php echo $value['id'];?>&user_id=<?php echo $user['id']; ?>">Thêm vào giỏ hàng</a>
                                <?php }
                                else { ?>
                                    <a class="Order" href="Order.php?id=<?php echo $value['id'];?>">Thêm vào giỏ hàng</a>
                                <?php }?>
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
                <a href="https://www.facebook.com/thanhs.lider.5/"><img src="../backend/assets/images/Logo_Youg.jpg" class="FanpageShop" style="width: 150px;"></a>
            </div>
        </div>
    </div>
        <!-- /FOOTER -->
    </div>
</body>
</html>

