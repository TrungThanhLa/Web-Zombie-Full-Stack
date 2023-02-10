<?php
session_start();
require_once '../backend/connection.php';

$sql_select_all = "SELECT * FROM news ORDER BY created_at DESC";
$result_all = mysqli_query($connection, $sql_select_all);
$news = mysqli_fetch_all($result_all, MYSQLI_ASSOC);
//echo '<pre>';
//print_r($news);
//echo '</pre>';
$sql_select_one = "SELECT * FROM news ORDER BY created_at DESC ";
$result_one = mysqli_query($connection, $sql_select_one);
$new_one = mysqli_fetch_assoc($result_one);
//echo '<pre>';
//print_r($new_one);
//echo '</pre>';

?>
<!-- Homepage.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trang tin tức - ZCS OFFICIAL</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/style7.css">
</head>
<body>
<div class="container-fluid">
    <div class="ContainerHeader">
        <!-- HEADER -->
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
                            <li class="liSubMenu"><a href="#" class="anchorSubMenu">Áo - Shirts</a></li>
                            <li class="liSubMenu"><a href="#" class="anchorSubMenu">Quần - Pants</a></li>
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
        <div class="New_Page">
        <a href="News_Frontend.php" class="h2News"><h2>TRANG TIN TỨC - ZCS OFFICIAL</h2></a>
        </div>
        <div class="Content">
            <div class="Top_News">
                <div class="Newest">
                    <a href="News_Detail.php?id=<?php echo $new_one['id']; ?>" class="Newest_Post">Bài viết mới nhất</a>
                </div>
                <div class="img_top_news">
                <a href="News_Detail.php?id=<?php echo $new_one['id']; ?>" class="img_top"><img src="../backend/News/uploads/<?php echo $new_one['thumbnail']; ?>" style="width: 835px;" height="437px" class="img_top"></a>
                </div>
                <div class="desNews">
                <a href="News_Detail.php?id=<?php echo $new_one['id']; ?>"><h3 class="h3_top_news"><?php echo $new_one['title']; ?></h3></a>
                <p class="p_top_news"><?php echo 'Ngày đăng:' . ' ' . date('d/m/Y H:i', strtotime($new_one['created_at'])); ?></p>
                <p><?php
                    $string = $new_one['description'];
                    if (strlen($string) > 200) {
                        $string_cut = substr($string, 0, 200);
                        $end = strrpos($string_cut, '');
                        $string = $end ? substr($string_cut, 0, $end) : substr($string_cut, 0);
                        $string = $string . '...';
                        echo $string;
                    }
                    else {
                        echo $string . '...';
                    }
                    ?><a href="News_Detail.php?id=<?php echo $new_one['id']; ?>" class="anchor_top_news">Xem ngay</a></p>
                </div>
            </div>
            <hr style="color: #EEEEEE">
            <h3 style="color:red;"><?php
                if (isset($_SESSION['error'])) {
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                }
                ?>
            </h3>
            <div class="News_List">
                    <?php foreach ($news AS $key => $value): ?>
                    <div class="New_Post">
                        <div class="row">
                        <div class="img_top_news">
                            <a href="News_Detail.php?id=<?php echo $value['id'];?>" class="Newest_Post"><img src="../backend/News/uploads/<?php echo $value['thumbnail']; ?>" style="width: 360px;" height="188px" class="img_top"></a>
                        </div>
                        <div class="desNews">
                            <a href="News_Detail.php?id=<?php echo $value['id'];?>" class="anchor"><h4 class="h4_news"><?php echo $value['title']; ?></h4></a>
                            <p class="p_news"><?php echo 'Ngày đăng:' . ' ' . date('d/m/Y H:i', strtotime($value['created_at'])); ?></p>
                            <p><?php
                                $string = $value['description'];
                                if (strlen($string) > 200) {
                                    $string_cut = substr($string,0,200);
                                    $end = strrpos($string_cut, '');
                                    $string = $end?substr($string_cut,0,$end):substr($string_cut,0);
                                    $string = $string . '...';
                                    echo $string;
                                }
                                else {
                                    echo $string . '...';
                                }
                                ?><a class="anchor_top_news" href="News_Detail.php?id=<?php echo $value['id'];?>">Xem ngay</a>
                            </p>
                        </div>
                        </div>
                    </div>
                    <hr>

                    <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- /MAIN CONTENT -->

    <!-- FOOTER -->
    <div class="SupportBackground">
        <div class="Support">
            <div class="row">
                <div class="Signup">
                    <i class="fas fa-envelope-open-text"></i>
                    <span class="SupportandBuy">Đăng kí nhận tin</span>
                </div>
                <div class="emailInput">
                    <input type="email" name="email" placeholder="Nhập email của bạn">
                    <a href="#" class="BoxSignUp">ĐĂNG KÍ</a>
                </div>
                <div class="telephone">
                    <i class="fas fa-phone-square-alt"></i>
                    <span class="SupportandBuy"> Hỗ trợ/Mua hàng:<a href="#">           079 939 1168</a></span>
                </div>
            </div>
        </div>
    </div>
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
                    <li class="lilink"><a href="#" class="Social">FACEBOOK</a></li>
                    <li class="lilink"><a href="#" class="Social">INSTAGRAM</a></li>
                    <li class="lilink"><a href="#" class="Social">SHOPEE</a></li>
                    <li class="lilink"><a href="#" class="Social">LAZADA</a></li>
                    <li class="lilink"><a href="#" class="Social">TIKI</a></li>
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
