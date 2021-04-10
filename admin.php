<?php
require_once 'dbconnect.php';
include "check_user.php";

if (isset($_SESSION['user']) && $_SESSION['user'] !== 'admin') {
    echo "<script>alert('Có gì đó không đúng :)))')</script>";
    header('Location: /webbanhang/logout.php');
}

if (isset($_GET['user_del'])) {
    $user = $_GET['user_del'];
    $query = $conn->prepare("DELETE FROM users WHERE username=?");
    $query->bind_param("s", $user);
    $query->execute();
    echo '
        <script>
            alert("Xoá người dùng thành công!!");
            window.location = "/webbanhang/admin.php?action=account";
        </script>';
}

if (isset($_GET['product_del'])) {
    $product = intval($_GET['product_del']);
    $query = $conn->prepare("DELETE FROM products WHERE product_id=?");
    $query->bind_param("i", $product);
    $query->execute();
    echo '
        <script>
            alert("Xoá sản phẩm thành công!!");
            window.location = "/webbanhang/admin.php?action=product";
        </script>';
}

function getAccount() {
    $data = "
    <div class='admin-menu'>
        <table class='table table-striped'>
            <thead>
                <tr>
                    <th>Tên đăng nhập</th>
                    <th>Tên đầy đủ</th>
                    <th>Địa chỉ</th>
                    <th>Số điện thoại</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>";
    $query = $GLOBALS["conn"]->prepare("SELECT * FROM users");
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data = $data."
                    <tr>
                    <td>{$row['username']}</td>
                    <td>{$row['full_name']}</td>
                    <td>{$row['address']}</td>
                    <td>{$row['phone']}</td>
                    <td> <a href='admin.php?user_del={$row['username']}'>Xoá </a>
                    </tr>
                    </tbody>
                    ";
        }
    }
    $data = $data."<br> </table> </div>";
    return $data;
}

function getProduct() { 
    $data = "
    <a href='add_product.php' style='
        text-decoration: none;
        background-color: black;
        padding: 5px;
        color: white;
        margin-left: 80%;
        border-radius: 0.5em;
        border: 2px solid black;
    '><i class='fas fa-plus'></i> Thêm sản phẩm</a>
    <div class='admin-menu'>
        <table class='table table-striped'>
            <thead>
                <tr>
                    <th>ID sản phẩm</th>
                    <th>Giá sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Xuất xứ</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>";
    $query = $GLOBALS["conn"]->prepare("SELECT * FROM products");
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data = $data."
                    <tr>
                    <td>{$row['product_id']}</td>
                    <td>{$row['product_price']}</td>
                    <td>{$row['product_name']}</td>
                    <td>{$row['product_origin']}</td>
                    <td> <a href='admin.php?product_del={$row['product_id']}'>Xoá </a>
                    </tr>
                    </tbody>
                    ";
        }
    }
    $data = $data."<br> </table> </div>";
    return $data;
}

function getView() {
    $data = "
    <div class='admin-menu'>
        <table class='table table-striped'>
            <thead>
                <tr>
                    <th>ID sản phẩm</th>
                    <th>Xuất xứ</th>
                    <th>Tên sản phẩm</th>
                    <th>Lượt view</th>
                </tr>
            </thead>
            <tbody>";
    $query = $GLOBALS["conn"]->prepare("SELECT * FROM products order by product_view desc");
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data = $data."
                    <tr>
                    <td>{$row['product_id']}</td>
                    <td>{$row['product_origin']}</td>
                    <td>{$row['product_name']}</td>
                    <td>{$row['product_view']}</td>
                    </tr>
                    </tbody>
                    ";
        }
    }
    $data = $data."<br> </table> </div>";
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>kmaphone.nhienit.io</title>
    <link rel="stylesheet" href="css/header.css" />
    <link rel="stylesheet" href="css/background.css" />
    <link rel="stylesheet" href="css/menu.css" />
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/footer.css" />
</head>
<style>
    body {
        background-image: url("images/bg.jpg");
        background-repeat: initial;
        background-attachment: fixed;
    }

    nav.menu a {
        margin-left: 5em;
        width: 10em;
    }

    div.admin {
        width: 90%;
        min-height: 35em;
        margin: auto;
        background-color: white;
        margin-top: 50px;
    }

    div.admin-header {
        width: 100%;
        background-color: #4e76f0;
        color: white;
        padding: 10px;
        margin-bottom: 50px;
    }

    div.admin-list {
        width: 80%;
        margin: auto;
    }

    table {
        border-collapse: collapse;
        width: 80%;
        margin: auto;
    }

    table,
    th,
    td {
        border: 2px solid black;
    }

    th,
    td {
        padding: 15px;
    }

    tr>th:not(:nth-child(3)) {
        width: 10em;
    }

    tr>th:nth-child(3) {
        width: 37em;
    }
</style>

<body>
    <?php
    session_start();
    header("Content-type: text/html;charset=UTF-8");
    include "header.php";
    include "menu_admin.php";
    ?>
    <div style="clear: both"></div>
    <div class="admin">
        <?php
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
        } else $action = 'account';

        switch ($action) {
            case 'account':
                echo "<div class='admin-header'><h1>Quản lý tài khoản </h1></div>";
                break;
            case 'product':
                echo "<div class='admin-header'><h1>Quản lý sản phẩm</h1></div>";
                break;
            default:
                break;
        }


        switch ($action) {
            case "account":
                echo getAccount();
                break;
            case "product":
                echo getProduct();
                break;
            case "view":
                echo getView();
                break;
            default:
                echo 'Không tìm thấy!!!';
        }
        ?>
    </div>

    <?php
    include "footer.php";
    ?>
</body>

</html>
<script src="https://kit.fontawesome.com/9077907ee5.js" crossorigin="anonymous"></script>