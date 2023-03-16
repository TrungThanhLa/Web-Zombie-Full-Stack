<?php
session_start();
require_once '../connection.php';

if (!isset($_SESSION['username'])) {
    $_SESSION['error'] = 'Hãy đăng nhập để truy cập';
    header('Location: ../Log in & out/Log_in.php');
    exit();
}

$id = $_GET['id'];


$sql_select_one= "SELECT * FROM user_admin WHERE id = $id";
$result_one = mysqli_query($connection, $sql_select_one);
$user = mysqli_fetch_assoc($result_one);

$sql_select_orders = "SELECT orders.*, user_customer.full_name as 'name' FROM orders JOIN user_customer ON orders.id_user = user_customer.id";
$result_orders = mysqli_query($connection, $sql_select_orders);
$orders = mysqli_fetch_all($result_orders, MYSQLI_ASSOC);
echo '<pre>';
print_r($orders);
echo '</pre>';

$sql_select_orders_detail = "SELECT * FROM order_detail ORDER BY created_at DESC ";
$result_orders_detail = mysqli_query($connection, $sql_select_orders_detail);
$orders_detail = mysqli_fetch_all($result_orders_detail, MYSQLI_ASSOC);
//echo '<pre>';
//print_r($orders_detail);
//echo '</pre>';

echo '<pre>';
print_r($user);
echo '</pre>';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Quản lý đơn hàng</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../assets/css/_all-skins.min.css">
    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="index2.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>A</b>LT</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Admin</b>LTE</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <i class="fa fa-bars"></i>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <?php if ($user['avatar'] == '') {
                                echo '<img src="../assets/images/admin-user-icon-4.jpg" class="user-image" alt="User Image" height="160px" width="160px">';
                            }
                            else {
                                ?>
                                <img src="../Users/admin_avatar/<?php echo $user['avatar']; ?>" class="user-image" alt="User Image" height="160px" width="160px">
                            <?php } ?>
                            <span class="hidden-xs"><?php echo $user['full_name']; ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <?php if ($user['avatar'] == '') {
                                    echo '<img src="../assets/images/admin-user-icon-4.jpg" class="img-circle" alt="User Image" height="160px" width="160px">';
                                }
                                else {
                                    ?>
                                    <img src="../Users/admin_avatar/<?php echo $user['avatar']; ?>" class="img-circle" alt="User Image" height="160px" width="160px">
                                <?php } ?>

                                <p>
                                    <?php echo $user['name'];?>
                                    <small>Quản trị viên</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="../Users/Profile.php?id=<?php echo $user['id']; ?>" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="../Log in & out/Log_out.php" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <?php if ($user['avatar'] == '') {
                        echo '<img src="../assets/images/admin-user-icon-4.jpg" class="img-circle" alt="User Image" height="160px" width="160px">';
                    }
                    else {
                        ?>
                        <img src="../Users/admin_avatar/<?php echo $user['avatar']; ?>" class="img-circle" alt="User Image" height="160px" width="160px">
                    <?php } ?>
                </div>
                <div class="pull-left info">
                    <p><?php echo $user['full_name']; ?></p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">THANH QUẢN TRỊ</li>
                <li>
                    <a href="../Homepage/Home.php?id=<?php echo $user['id']; ?>">
                        <i class="fas fa-h-square"></i> <span>Quản lý trang chủ</span>
                        <span class="pull-right-container">
              <!--<small class="label pull-right bg-green">new</small>-->
            </span>
                    </a>
                </li>
                <li>
                    <a href="../News/News.php?id=<?php echo $user['id']; ?>">
                        <i class="fa fa-th"></i> <span>Tin tức</span>
                        <span class="pull-right-container">
              <!--<small class="label pull-right bg-green">new</small>-->
            </span>
                    </a>
                </li>
                <li>
                    <a href="../Products/Products.php?id=<?php echo $user['id']; ?>">
                        <i class="fas fa-boxes"></i> <span> Sản phẩm</span>
                        <span class="pull-right-container">
              <!--<small class="label pull-right bg-green">new</small>-->
            </span>
                    </a>
                </li>
                <li>
                    <a href="../Order/Order.php?id=<?php echo $user['id']; ?>">
                        <i class="fas fa-dolly-flatbed"></i> <span>Đơn hàng</span>
                        <span class="pull-right-container">
              <!--<small class="label pull-right bg-green">new</small>-->
            </span>
                    </a>
                </li>
                <li>
                    <a href="../Users/Users.php?id=<?php echo $user['id']; ?>">
                        <i class="fa fa-code"></i> <span>Quản lý user</span>
                        <span class="pull-right-container">
              <!--<small class="label pull-right bg-green">new</small>-->
            </span>
                    </a>
                </li>
            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Breadcrumd Wrapper. Contains breadcrumb -->
    <div class="breadcrumb-wrap content-wrap content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>
    </div>

    <!-- Messaeg Wrapper. Contains messaege error and success -->
    <div class="message-wrap content-wrap content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        </section>
    </div>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            Nội dung hiển thị ở đây
            <br>
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
            <br>
            <table border="2" cellspacing="0" cellpadding="8" style="width: 100%;">
                <tr>
                    <th style="text-align: center;">ID</th>
                    <th style="text-align: center;">Người mua</th>
                    <th style="text-align: center;">Created_at</th>
                    <th style="text-align: center;">Trạng thái</th>
                    <th style="text-align: center;"></th>
                </tr>
                <?php $number = 1;
                foreach ($orders AS $key => $value): ?>
                <tr style="text-align: center;">
                    <td style="padding: 10px"><?php echo $number++; ?></td>
                    <td style="padding: 10px"><?php echo $value['name'];  ?></td>
                    <td style="padding: 10px"><?php echo date('d/m/Y H:i:s', strtotime($value['created_at'])); ?></td>
                    <td style="padding: 10px">
                        <?php if ($value['status'] == 'Đang khởi tạo') { ?>
                            <span style="color: white; background: red; border-radius: 5px; padding: 5px;"><?php echo $value['status']; ?></span>
                        <?php }
                        elseif($value['status'] == 'Đang xử lý') {?>
                            <span style="color: white; background: orange; border-radius: 5px; padding: 5px;"><?php echo $value['status']; ?></span>
                        <?php }
                        elseif ($value['status'] == 'Đã giao cho bên vận chuyển') {?>
                            <span style="color: white; background: lightseagreen; border-radius: 5px; padding: 5px;"><?php echo $value['status']; ?></span>
                        <?php }
                        elseif ($value['status'] == 'Đang giao hàng') {?>
                            <span style="color: white; background: mediumseagreen; border-radius: 5px; padding: 5px;"><?php echo $value['status']; ?></span>
                        <?php }
                        elseif ($value['status'] == 'Giao hàng thành công') {?>
                            <span style="color: white; background: green; border-radius: 5px; padding: 5px;"><?php echo $value['status']; ?></span>
                        <?php } ?>
                    </td>
                    <td style="padding: 10px">
                        <a href="Order_detail.php?id=<?php echo $value['id'] ?>&user_id=<?php echo $user['id']; ?>"><i class="fas fa-eye" title="Xem chi tiết" style="margin-right: 10px;"></i></a>
                        <a href="Delete_Order.php?id=<?php echo $value['id'] ?>&user_id=<?php echo $user['id']; ?>" onclick="return confirm('Xóa đơn hàng ?')" ><i class="fas fa-trash-alt" title="delete" style="color: red"></i></a>

                    </td>
                </tr>
                <?php endforeach; ?>
            </table>


        </section>
        <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 2.4.13-pre
        </div>
        <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE</a>.</strong> All rights
        reserved.
    </footer>
    <!-- Add the sidebar's background. This div must be placed
         immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="../assets/js/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../assets/js/jquery-ui.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../assets/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="../assets/js/adminlte.min.js"></script>
</body>
</html>