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

$sql_select_cate = "SELECT * FROM category WHERE status = 1";
$result_cate = mysqli_query($connection, $sql_select_cate);
$categories = mysqli_fetch_all($result_cate, MYSQLI_ASSOC);

if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
}
else {
    $cart = [];
}
echo '<pre>';
print_r($cart);
echo '</pre>';



?>

<!-- Cart.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Giỏ hàng của bạn - ZOMBIE OFFICIAL STORE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/style5.css">
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
				<span class="BarItems"><?php if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {?>
                        <a href="Homepage.php?user_id=<?php echo $user['id']; ?>">Trang chủ</a>
                    <?php }
                    else {
                        echo '<a href="Homepage.php">Trang chủ</a>';
                    }
                    ?> / <?php if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {?>
                        <a href="Cart.php?user_id=<?php echo $user['id']; ?>">Giỏ hàng</a>
                    <?php }
                    else {
                        echo '<a href="Cart.php">Giỏ hàng</a>';
                    }
                    ?>
            </div>
        </div>
        <div class="YourCart">
            <h2>Giỏ hàng của bạn</h2>
            <p class="pDesh2">Có <span style="color: red"> <?php
                    if (isset($_SESSION['new_number_in_cart'])) {
                        echo $_SESSION['new_number_in_cart'];
                    }
                    else {
                        echo '0';
                    }
                    ?> </span> sản phẩm trong giỏ hàng</p>
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
                    <th></th>
                </tr>
                <?php
                $number = 1;
                $total_price = 0;
                foreach ($cart AS $key => $value):
                    $_SESSION['number_in_cart'] = $number;
                    $_SESSION['new_number_in_cart'] = $_SESSION['number_in_cart'];
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
                        echo $number++;
                        ?>
                    </td>
                    <td><?php if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {?>
                            <a href="Detail.php?id=<?php echo $value['id']; ?>&user_id=<?php echo $user['id']; ?>"><?php echo $value['name']; ?></a>
                        <?php }
                        else { ?>
                            <a href="Detail.php?id=<?php echo $value['id']; ?>"><?php echo $value['name']; ?></a>
                        <?php } ?>
                    </td>
                    <td style="padding: 20px 0px;"><?php if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {?>
                            <a href="Detail.php?id=<?php echo $value['id']; ?>&user_id=<?php echo $user['id']; ?>"><img src="../backend/Products/uploads/<?php echo $value['img']; ?>" width="150px" height="100px"></a>
                        <?php }
                        else { ?>
                            <a href="Detail.php?id=<?php echo $value['id']; ?>"><img src="../backend/Products/uploads/<?php echo $value['img']; ?>" width="150px" height="100px"></a>
                        <?php } ?>
                    </td>
                    <td>
                        <?php if (!isset($_SESSION['username']) || !isset($_COOKIE['username'])) { ?>
                        <form action="Order.php" method="get">
                            <?php }
                            else { ?>
                        <form action="Order.php?user_id=<?php echo $user['id']; ?>" method="get">
                            <?php } ?>
                        <input type="hidden" name="user_id" value="<?php if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {
                            echo $user['id']; } else { echo ''; }?>">
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="id" value="<?php echo $value['id']; ?>">
                        <input type="number" name="quantity" class="quantity" value="<?php echo $value['quantity']; ?>">
                        <button type="submit" name="Update" class="Update">Cập nhật</button>
                        </form>
                    </td>
                    <td><?php if ($value['sale_price'] != 0 ) {
                        echo '<span style="color:red;">' . number_format($value['sale_price']) . 'đ</span>' ;
                        }
                        else {
                            echo number_format($value['price']) . 'đ';
                        }?>

                    </td>
                    <td><?php if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {?>
                            <a href="Order.php?id=<?php echo $value['id'];?>&action=delete&user_id=<?php echo $user['id']; ?>" class="btn btn-danger"  onclick="return confirm('Xóa khỏi giỏ hàng ?')">Xóa</a></td>
                        <?php }
                        else { ?>
                            <a href="Order.php?id=<?php echo $value['id'];?>&action=delete" class="btn btn-danger"  onclick="return confirm('Xóa khỏi giỏ hàng ?')">Xóa</a></td>
                        <?php } ?>
                </tr>
                <?php endforeach; ?>
            </table>
            <div class="Total">
                <h4>Tổng số tiền: <span style="color: red"><?php echo number_format($total_price) . 'đ'; ?></span> </h4>
            </div>
            <div class="Payment">
                <?php if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {?>
                    <a href="Pay.php?user_id=<?php echo $user['id']; ?>" class="Pay">Thanh toán</a>
                <?php }
                else {
                    if (!isset($_SESSION['username']) || !isset($_COOKIE['username'])) {
                    ?>
                    <a href="#" class="Pay" onclick="alert('Hãy đăng nhập để thanh toán !')">Thanh toán</a>
                    <?php
                        }
                    }
                    ?>
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
