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

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $_SESSION['error'] = 'Sản phẩm không tồn tại';
    header('Location: Products_Frontend.php');
    exit();
}
$id = $_GET['id'];

$sql_select_one = "SELECT * FROM products WHERE id = $id";
$result_one = mysqli_query($connection, $sql_select_one);
$product = mysqli_fetch_assoc($result_one);
echo '<pre>';
print_r($product);
echo '</pre>';

$sql_select_all = "SELECT * FROM category WHERE status = 1";
$result_all = mysqli_query($connection, $sql_select_all);
$categories = mysqli_fetch_all($result_all, MYSQLI_ASSOC);

$sql_select_imgs = "SELECT * FROM imgs_products WHERE id_products = $id";
$result_img = mysqli_query($connection, $sql_select_imgs);
$imgs = mysqli_fetch_all($result_img, MYSQLI_ASSOC);
echo '<pre>';
print_r($imgs);
echo '</pre>';


?>
<!-- Detail.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $product['name']; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/style6.css">
</head>
<body>
<div class="container-fluid">
    <!-- HEADER -->
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
                <span class="BarItems"><a href="Homepage.php" class="AnchorOnBar">Trang chủ</a> / <a href="Products_Frontend.php" class="AnchorOnBar">Sản phẩm</a> / <a href="#" class="AnchorOnBar"><?php echo $product['name']; ?></a></span>
            </div>
        </div>
        <div class="ContainerContent">
            <div class="row">
                <div class="imgProduct">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <?php
                            $number = 1;
                            foreach ($imgs AS $key1):
                            ?>
                            <li data-target="#carouselExampleIndicators" data-slide-to="<?php $number++; ?>"></li>
                            <?php endforeach; ?>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="ProductPicture" src="../backend/Products/uploads/<?php echo $product['img']; ?>" alt="First slide">
                            </div>
                            <?php foreach ($imgs AS $key => $value): ?>
                            <div class="carousel-item">
                                <img class="ProductPicture" src="../backend/Products/img_product/<?php echo $value['imgs_des']; ?>" alt="Second slide">
                            </div>
                            <?php endforeach; ?>
<!--                            <div class="carousel-item">-->
<!--                                <img class="d-block w-100" src="..." alt="Third slide">-->
<!--                            </div>-->
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
                <div class="detailProduct">
                    <h3><?php echo $product['name']; ?></h3>
                    <hr>
                    <span class="Price"> Giá: <?php
                        if ($product['sale_price'] != 0) {
                            echo '<span style="text-decoration: line-through; color: black">' . number_format($product['price']) . 'đ </span>';
                            echo '<span style="color: red; margin-left: 10px">' . number_format($product['sale_price']) . 'đ </span>';
                        }
                        else {
                            echo '<span style=" color: red">' . number_format($product['price']) . 'đ </span>';
                        }
                        ?>
                    </span>
                    <hr>
                    <form action="<?php
                    if (isset($_SESSION['username']) || isset($_COOKIE['username'])) { ?>
                    Order.php?user_id=<?php echo $user['id']; }
                    else { ?>
                    Order.php
                    <?php } ?>
                    " method="get">
                    <div class="numberofProduct">
                        <span>Số lượng:</span>
                        <?php if (isset($_SESSION['username']) || isset($_COOKIE['username'])) { ?>
                            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                        <?php } ?>
                        <input type="number" id="quantity" name="quantity" value="1" min="1">
                        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                    </div>
                    <div class="AddProduct">
                        <button type="submit" class="AddToCart">THÊM VÀO GIỎ</button>
                    </div>
                    </form>
                    <div class="des">
                        <div class="DesProduct">
                            <h4 style="font-weight: bold; margin-bottom: 20px"> MÔ TẢ </h4>
                            <?php echo $product['description']; ?>
                        </div>

                        <div class="DesProduct">
                            <ul class="ulDes"> <span style="font-weight: bold">CAM KẾT CỦA SHOP</span>
                                <li class="liDes">HÌNH THẬT GIỐNG MẪU 100%, TẤT CẢ HÌNH ẢNH ĐỀU DO SHOP TỰ CHỤP.</li>
                                <li class="liDes">Sản phẩm được kiểm tra kỹ càng trước khi giao hàng cho khách .</li>
                                <li class="liDes">Hỗ trợ đổi size nếu khách mặt không vừa, không ưng ý sản phẩm muốn đổi sang sản phẩm khác.</li>
                                <li class="liDes">Hỗ trợ đổi đối với các lỗi từ nhà sản xuất.</li>
                                <li class="liDes">Hỗ trợ đổi trong vòng 7 ngày kể từ ngày nhận hàng, sản phẩm mới và còn nguyên tem mác.</li>
                            </ul>
                        </div>

                        <div class="DesProduct">
                            <p class="Attention" style="font-weight: bold">BẢNG SIZE</p>
                            <p class="pDes">SIZE S/SIZE 28: 1m45 - 1m60 (45 - 53kg)</p>
                            <p class="pDes">SIZE M/SIZE 30: 1m5 - 1m65 (53 - 58kg)</p>
                            <p class="pDes">SIZE L/SIZE 32: 1m55 - 1m7 ( 58 - 68kg)</p>
                            <p class="pDes">SIZE XL/SIZE 34: 1m60 - 1m8 (68 - 75kg)</p>
                            <p class="pDes">SIZE XXL/SIZE 36: 1m75 - 1m85 (75 - 85kg)</p>
                            <p class="pDes">(Bảng size trên chỉ mang tính chất tham khảo, vui lòng xem thêm bảng size cho từng sản phẩm  hoặc chat với nhân viên của shop để được hỗ trợ)</p>
                            </ul>
                        </div>

                        <div class="DesProduct">
                            <p class="Attention" style="font-weight: bold">BẢO QUẢN</p>
                            <p class="pDes">- Giặt lần đầu tiên với nước lạnh và nước xả vải (không sử dụng bột giặt) để sản phẩm giữ màu được lâu.</p>
                            <p class="pDes">- Giặt mặt trái, nhẹ tay, giặt xong phơi ngay, không ngâm sản phẩm trong nước quá lâu, không sử dụng các loại chất tẩy.</p>
                            <p class="pDes">- Quần áo trắng -  màu nên chia ra giặt riêng, không giặt chung.</p>
                            <p class="pDes">- Không giặt chung với các sản phẩm dễ xước, tránh vướng mắc khi giặt và phơi.</p>
                            <p class="pDes">- Với sản phẩm có in chỉ nên giặt ở chế độ giặt vải mềm để đảm bảo độ bền của sản phẩm. </p>
                            <p class="pDes">- Tránh phơi sản phẩm dưới nắng trực tiếp, phơi nơi thoáng mát.</p>
                        </div>
                    </div>
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
