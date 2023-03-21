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
    <title>Trang giới thiệu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/style10.css">
</head>
<body>
<div class="container-fluid">
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
        <div class="Container_Introduce">
        <div class="Introduce_Title">
            <a href="#"><h2 class="h2_Introduce">TRANG GIỚI THIỆU</h2></a>
        </div>
        <div class="Introduce">
            <div class="Introductory">
                <div class="About_Self">
                    <p><a href="#" style="color: #CD0439; font-weight: 500">Youg 2T Clothing Store</a> là website bán hàng Online
                       với đầy đủ các tính năng chính mà một trang web bán hàng online thông dụng cần có. Youg 2T Clothing Store chuyên cung cấp
                       và phân phối các loại quần, áo, phụ kiện,... đậm chất tính thời thượng và luôn chạy theo xu hướng của thời trang trong
                       xã hội hiện đại.
                    </p>
                    <p>Youg 2T Clothing Store là sản phẩm của một học viên tự làm và độc lập tạo ra trong quá trình theo học khóa đào tạo lập trình
                    Web với ngôn ngữ lập trình PHP của học viện ITPlus.
                    </p>
                </div>
                <div class="Img_Produce">
                    <img src="../backend/assets/images/Youg%20Logo.png" width="500px" height="350px">
                </div>

                <div class="Myself">
                    <div class="Introduce_Title">
                        <a href="#"><h3>THÔNG TIN VỀ BẢN THÂN</h3></a>
                    </div>
                    <div class="row">
                        <div class="Self">
                            <h4><i class="fas fa-id-badge"></i> Information</h4>
                            <br>
                            <p>- <b>Full name: </b> Lã Nguyễn Trung Thành - Developer
                            <br> - <b>Birth:</b> 11/10/2003
                            <br> - <b>Email:</b> trungthanhla1110@gmail.com
                            <br> - <b>Phone:</b> 0943920250
                            <br> - <b>Address:</b> Hà Đông, Hà Nội
                            <br> - <b>Github:</b> <a href="https://github.com/TrungThanhLa" style="color: #CD0439;">https://github.com/TrungThanhLa</a>
                            </p>
                            <br>
                            <h4><i class="fas fa-user-graduate"></i> Education</h4>
                            <br>
                            <p> - <b>9/2018 - 7/2021:</b> Tốt nghiệp THPT Lê Lợi Hà Đông</p>
                            <p> - <b>9/2022 - 4/2023:</b> Tốt nghiệp Học viện ITPLUS lĩnh vực lập trình Website bằng ngôn ngữ PHP</p>
                            <br>
                        </div>
                        <div class="Img_Produce">
                            <img src="../backend/assets/images/Introduce_Pic.JPG" width="350px" height="500px">
                        </div>
                    </div>
                    <div class="row" style="margin-top: 80px;">
                        <div class="Img_Produce">
                            <img src="../backend/assets/images/Football.jpg" width="350px" height="550px">
                        </div>
                        <div class="Self_2">
                            <div class="Introduce_Self">
                            <h4><i class="fas fa-user-circle"></i> Introduce</h4>
                            <br>
                            <p> - Là một người vui vẻ, năng động, luôn muốn tìm hiểu, khám phá, cũng như học hỏi những điều mới. Chính vì vậy nên tôi
                                cũng luôn luôn muốn lắng nghe tất cả những lời góp ý từ cuộc sống, thái độ cho đến công việc của mình, nhằm mục đích cải thiện bản
                                thân, giúp mình trở thành một phiên bản tốt nhất.
                                <br>
                                <br>
                                - Về chuyên môn, tôi cũng là một người có thể chịu được áp lực và rất có trách nhiệm trong công việc của mình.
                                Tôi thường tìm hiểu các công nghệ mới, nhằm cải tiến các sản phẩm của mình sao cho hiện đại nhất trong tương lai.
                                <br>
                                <br>
                                - Do tính chất công việc, nên việc vận động thường xuyên gần như là không thể. Chính vì lý do đó, nên sở thích của tôi là chơi thể thao,
                                vận động với cường độ mạnh, cụ thể ở đây là bóng đá. Ngoài ra, để xả stress thì tôi cũng thường hay xem phim, chơi game và nghe nhạc.
                            </p>
                            <br>
                            <h4><i class="fas fa-link"></i> Activities</h4>
                            <br>
                            <p> - Tham gia chương trình vận động hiến máu "Tết hồng cho em 2022" và đạt được danh hiệu "Tình nguyện viên xuất sắc" sau 1 tháng hoạt động tại Viện Huyết học - Truyền máu Trung ương.</p>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="Self_Skills">
            <div class="row">
                <div class="All_Skills">
                    <h4 style="margin-bottom: 20px;"><i class="fas fa-laptop-code"></i> SKILLS</h4>
                    <br>
                    <div class="r_skills" style="margin-left: 20px;">
                        <ul class="ul_Skill"><b>- Frontend:</b>
                            <li style="list-style: initial">HTML5</li>
                            <li style="list-style: initial">CSS</li>
                            <li style="list-style: initial">Basic Javascript</li>
                        </ul>
                        <ul class="ul_Skill"><b>- Backend:</b>
                            <li style="list-style: initial">PHP</li>
                            <li style="list-style: initial">XAMPP Control Panel - MySQL (PHPMyAdmin)</li>
                        </ul>
                        <ul class="ul_Skill"><b>- Others:</b>
                            <li style="list-style: initial">Boostrap 4</li>
                            <li style="list-style: initial">CKEditor & CKFinder</li>
                            <li style="list-style: initial">Instant Eyedropper</li>
                            <li style="list-style: initial">Font Awesome</li>
                            <li style="list-style: initial">Github</li>
                        </ul>
                        <ul class="ul_Skill"><b>- Languages:</b>
                            <li style="list-style: initial">English - Basic reading comprehension</li>
                        </ul>
                        <ul class="ul_Skill"><b>- Soft Skills:</b>
                            <li style="list-style: initial">Basic photo editing with <b style="color: steelblue;">Photoshop CS6</b></li>
                            <li style="list-style: initial">Basic video editing with <b style="color: deeppink;">Adobe Premiere Pro</b> and others video editing apps</li>
                            <li style="list-style: initial">Have knowledge of computers and computer hardware</li>
                            <li style="list-style: initial">Experience in writing SEO Marketing articles for 10 months at Omni Digital company</li>
                        </ul>
                    </div>
                </div>
                <div class="Img_Produce">
                    <img src="../backend/assets/images/Self.jpg" width="350px" height="450px">
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
