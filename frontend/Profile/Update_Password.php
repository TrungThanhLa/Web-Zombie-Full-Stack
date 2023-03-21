<?php
session_start();
require_once '../../backend/connection.php';

if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {
    $id = $_GET['user_id'];
    $sql_select_user = "SELECT * FROM user_customer WHERE id = $id";
    $result_user = mysqli_query($connection, $sql_select_user);
    $user = mysqli_fetch_assoc($result_user);
    echo '<pre>';
    print_r($user);
    echo '</pre>';
}

if (!isset($id)) {
    header('Location: ../Homepage.php');
}

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

echo '<pre>';
print_r($_POST);
echo '</pre>';

$error = '';

if (isset($_POST['submit'])) {
    $password = $_POST['password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    $password_hash = $user['password'];
    $is_login = password_verify($password, $password_hash);
    var_dump($is_login);

    if ($is_login == false) {
        $error = 'Sai mật khẩu';
    }
    elseif ($new_password == $password) {
        $error = 'Mật khẩu mới phải khác mật khẩu cũ';
    }
    elseif ($new_password != $confirm_password) {
        $error = 'Mật khẩu mới không trùng khớp';
    }

    if (empty($error)) {
        $new_password_hash = password_hash($new_password, PASSWORD_BCRYPT);
        $sql_update = "UPDATE user_customer SET password = '$new_password_hash'";
        $is_update = mysqli_query($connection, $sql_update);
        var_dump($is_update);
        if ($is_update) {
            $_SESSION['success'] = 'Đổi mật khẩu thành công';
            header('Location: Profile.php?user_id=' . $user['id']);
            exit();
        }
        else {
            $error = 'Đổi mật khẩu không thành công';
        }
    }

}

?>
<!-- Homepage.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Trang giới thiệu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../css/style11.css">
</head>
<body>
<div class="container-fluid">
    <div class="ContainerHeader">
        <!-- HEADER -->
        <div class="Header">
            <div class="row">
                <div class="Logo">
                    <img src="../../backend/assets/images/Logo_Youg.jpg" class="LogoImg" style="margin-left: 50%;">
                </div>
                <div class="IconAnchor">
                    <?php if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {?>
                        <a href="Profile.php?user_id=<?php echo $user['id']; ?>" title="Profile" style="font-size: 22px;"><i class="fa-solid fa-user"></i></a>
                    <?php }
                    else {
                        echo '';
                    }
                    ?>

                    <?php if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {
                        echo '<a href="../Login&&out/Logout.php" class="Logout" style="font-size: 22px; padding: 0px 20px;" title="Đăng xuất"><i class="fa-solid fa-right-from-bracket"></i></a>';
                    }
                    else {
                        echo '<a href="../Login&&out/Login.php" class="Login" style="font-size: 22px; padding: 0px 20px;" title="Đăng nhập"><i class="fas fa-sign-in-alt"></i></a>';
                    }
                    ?>
                    <?php if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {?>
                        <a href="../Cart.php?user_id=<?php echo $user['id']; ?>" title="Giỏ hàng"><i class="fas fa-shopping-cart iconawesome"></i></a>
                    <?php }
                    else {
                        echo '<a href="../Cart.php" title="Giỏ hàng"><i class="fas fa-shopping-cart iconawesome"></i></a>';
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
                            <a href="../Homepage.php?user_id=<?php echo $user['id']; ?>" class="anchorList">Trang Chủ</a>
                        <?php }
                        else {
                            echo '<a href="../Homepage.php" class="anchorList">Trang Chủ</a>';
                        }
                        ?>
                    </li>
                    <li class="liMenu"><?php if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {?>
                            <a href="../Products_Frontend.php?user_id=<?php echo $user['id']; ?>" class="anchorList">Sản phẩm</a>
                        <?php }
                        else {
                            echo '<a href="../Products_Frontend.php" class="anchorList">Sản phẩm</a>';
                        }
                        ?>
                        <ul class="subMenu">
                            <li class="liSubMenu"><?php if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {?>
                                    <a href="../Products_Frontend.php?user_id=<?php echo $user['id']; ?>" class="anchorSubMenu">Tất cả sản phẩm - All Products</a>
                                <?php }
                                else {
                                    echo '<a href="../Products_Frontend.php" class="anchorSubMenu">Tất cả sản phẩm - All Products</a>';
                                }
                                ?>
                                <?php foreach ($category AS $key => $value):?>
                            <li class="liSubMenu"><?php if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {?>
                                    <a href="../Products_Category.php?id=<?php echo $value['id_cat']; ?>&&user_id=<?php echo $user['id']; ?>" class="anchorSubMenu"><?php echo $value['name']; ?></a>
                                <?php }
                                else { ?>
                                    <a href="../Products_Category.php?id=<?php echo $value['id_cat']; ?>" class="anchorSubMenu"><?php echo $value['name']; ?></a>
                                <?php } endforeach; ?>
                        </ul>
                    </li>
                    <li class="liMenu"><?php if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {?>
                            <a href="../News_Frontend.php?user_id=<?php echo $user['id']; ?>" class="anchorList">Tin tức</a>
                        <?php }
                        else {
                            echo '<a href="../News_Frontend.php" class="anchorList">Tin tức</a>';
                        }
                        ?>
                    </li>
                    <li class="liMenu"><?php if (isset($_SESSION['username']) || isset($_COOKIE['username'])) {?>
                            <a href="../Introduce.php?user_id=<?php echo $user['id']; ?>" class="anchorList">Giới thiệu</a>
                        <?php }
                        else {
                            echo '<a href="../Introduce.php" class="anchorList">Giới thiệu</a>';
                        }
                        ?></li>
                </ul>
            </div>
        </div>
    </div>
    <!--  /HEADER    -->

    <!-- MAIN CONTENT -->
    <div class="Main_Content">
        <div class="h3_title">
            <a href="#"><h3 style="font-weight: 400">TRANG ĐỔI MẬT KHẨU</h3></a>
        </div>
        <div class="form_login">
            <br>
            <a href="Profile.php?user_id=<?php echo $user['id']; ?>"><i class="fa-solid fa-user"></i>Trang Profile</a>
            <br>
            <br>
            <a href="Update_Profile.php?user_id=<?php echo $user['id']; ?>"><i class="far fa-edit"></i>Sửa thông tin người dùng</a>
            <br>
            <br>
            <p style="color: red"><?php
                echo $error;
                if (isset($_SESSION['error'])) {
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                }
                ?>
            </p>
            <p style="color: green"><?php
                if (isset($_SESSION['success'])) {
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                }
                ?>
            </p>
            <form action="" method="post">
                <div class="form-group" >
                    <label for="name">Name: <?php echo $user['full_name']; ?></label>
                </div>
                <div class="row">
                    <div class="Info1">
                        <div class="form-group" >
                            <label for="password">Old Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="form-group" >
                            <label for="password">New Password</label>
                            <input type="password" name="new_password" id="password" class="form-control">
                        </div>
                        <div class="form-group" >
                            <label for="password">Confirm New Password</label>
                            <input type="password" name="confirm_password" id="password" class="form-control">
                        </div>
                        <button type="submit" name="submit" value="Đổi mật khẩu" style="margin-top: 20px; padding: 10px; border: 1px solid black;">Đổi mật khẩu</button>
                    </div>
                    <br>
                </div>
            </form>
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
                <img src="../img/GOV.jpg" class="gov">
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
                <a href="https://www.facebook.com/thanhs.lider.5/"><img src="../../backend/assets/images/Logo_Youg.jpg" class="FanpageShop" style="width: 150px;margin-left: 100px;"></a>
            </div>
        </div>
    </div>
    <!-- /FOOTER -->
</div>
</body>
</html>
