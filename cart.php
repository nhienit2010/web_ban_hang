<?php
error_reporting(0);
require_once 'utils/dbconnect.php';
include "utils/check_user.php";

session_start();

if (!isset($_SESSION['user']) && !isset($_COOKIE['user'])) {
    echo "<script>alert('Vui lòng đăng nhập!!!'); window.location='/login.php';</script>";
    exit();
}

if (isset($_SESSION['user']) && $_SESSION['user'] === 'admin') {
    echo "<script>alert('Admin không có chức năng này!'); window.location='/';</script>";
}

if (isset($_POST['id']) && isset($_POST['color']) && isset($_COOKIE['user']) && isset($_POST['quantity'])) {
    $id = intval($_POST['id']);
    $color = $_POST['color'];
    $cookie_user = $_COOKIE['user'];
    $product_amount = intval($_POST['quantity']);

    $q = $conn->prepare("SELECT * FROM carts WHERE cookie_user=? and product_id=? and product_color=?");
    $q->bind_param("sis", $cookie_user, $id, $color);
    $q->execute();
    $res = $q->get_result();

    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $query = $conn->prepare("UPDATE carts SET product_amount=? WHERE cookie_user=? and product_id=? and product_color=?");
            $amount = intval($row['product_amount']) + $product_amount;
            $query->bind_param("isis", $amount, $cookie_user, $id, $color);
            $query->execute();
        }
    } else {
        $query = $conn->prepare("INSERT INTO carts(product_id, product_color, cookie_user, product_amount) VALUES(?, ?, ? ,?) ");
        $query->bind_param("issi", $id, $color, $cookie_user, $product_amount);
        $query->execute();
    }
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
        background-color: rgba(255, 255, 255, 0.5);
    }

    div.cart {
        width: 80%;
        min-height: 35em;
        margin: auto;
        background-color: white;
        margin-top: 2.8em;
    }

    div.cart-header {
        width: 100%;
        padding: 0.6em;
        margin-bottom: 2.8em;
        background-color: white;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        color: #333;
    }

    div.cart-list {
        width: 80%;
        margin: auto;
    }

    table {
        border-collapse: collapse;
    }

    table,
    th,
    td {
        border: 0.1em solid black;
    }

    th,
    td {
        padding: 0.8em;
    }

    tr>th:first-child,
    tr>th:nth-child(3),
    tr>th:nth-child(4) {
        width: 6em;
    }

    tr>th:nth-child(2) {
        width: 37em;
    }

    #buy_form {
        background-color: white;
        height: 30em;
        width: 50em;
        position: fixed;
        display: none;
        top: 10em;
        left: 25em;
        border: 0.10em solid rgba(0, 0, 0, 0.1);
        box-shadow: -5px -2px 10px rgba(0, 0, 0, 0.1);
        padding: 2em;
        border-radius: 2em;
        transition: 4s;
    }

    form {
        width: 60%;
        margin: auto;
    }

    div.form-group {
        margin-bottom: 0.5em;
    }

    div.form-group>input {
        margin-top: 1em;
        padding: 0.5em;
        width: 30em;
        font-size: 0.8em;
        border: 1.5px solid rgba(0, 0, 0, 0.5);
        border-radius: 0.2em;
        margin-bottom: 0.5em;
    }

    div.form-group>select {
        margin-top: 1em;
        background-color: #3d80f5;
        position: relative;
        font-family: Arial;
        padding: 8px 16px;
        font-size: 16px;
        border: none;
        cursor: pointer;
        color: white;
    }
</style>

<body>
    <?php
    session_start();
    header("Content-type: text/html;charset=UTF-8");
    include "includes/header.php";
    include "includes/menu.php";
    ?>
    <div style="clear: both"></div>
    <div class="cart">
        <div class="cart-header">
            <h1>Giỏ hàng của bạn</h1>
        </div>
        <div class="cart-list">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Màu sắc</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thao tác</th>
                    </tr>
                <tbody>
                    </thead>
                    <?php
                    if (isset($_COOKIE['user'])) {
                        $cookie_user = $_COOKIE['user'];
                        $query = $conn->prepare("SELECT * FROM carts WHERE cookie_user=?");
                        $query->bind_param("s", $cookie_user);
                        $query->execute();
                        $result = $query->get_result();
                        $total = 0;
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {

                                $sql = "SELECT * FROM products where product_id=" . $row['product_id'];
                                $res = $conn->query($sql);
                                if ($res->num_rows > 0) {
                                    while ($r = $res->fetch_assoc()) {
                                        $total += $r['product_price'] * $row['product_amount'];
                                        $product_name = $r['product_name'];
                                        echo '
                            <tr>
                            <th>' . $r['product_id'] . '</th>
                            <td>' . $r['product_name'] . '</td>
                            <td>' . $row['product_color'] . '</td>
                            <td>' . number_format($r['product_price']) . '</td>
                            <td>' . $row['product_amount'] . '</td>
                            <td> <a href="utils/delete_item.php?id=' . $r['id'] . '">Xoá </a>
                            </tr>';
                                    }
                                }
                            }
                        } else {
                            echo "<script>alert('Chưa có sản phẩm nào trong giỏ hàng!!')</script>";
                        }
                    } else {
                    }
                    echo '</tbody>';
                    echo "<tfoot>
            <td colspan='3' style='text-align: center'><b>Thành tiền</b></td>
            <td colspan='3'>" . number_format($total) . " VND</td>
            </tfoot>";
                    ?>
                    <br>
            </table>
        </div>

        <div id="buy_form">
            <form action="utils/buy.php" method="POST" id="productForm" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="text" name="customer_name" placeholder="Họ và tên" />
                </div>
                <div class="form-group">
                    <input type="text" name="customer_address" placeholder="Địa chỉ nhận hàng" />
                </div>
                <div class="form-group">
                    <input type="number" name="customer_age" placeholder="Tuổi" />
                </div>
                <div class="form-group">
                    <select name="product_type">
                        <option value="dtdd" selected> Nam </option>
                        <option value="laptop"> Nữ </option>
                        <option value="tablet"> Khác </option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" name="customer_phone" placeholder="Số điện thoại nhận hàng" />
                </div>
                <div class="form-group">
                    <input type="text" name="customer_other" placeholder="Người nhận hộ (nếu có)" />
                </div>
                <div class="form-group">
                    <input type="Submit" name="submit" value="Xác nhận" onclick="alert('Vui lòng không BOMM hàng! A du ô cê?')" />
                </div>
            </form>
        </div>
        <button type="submit" id="buy-btn" class="btn btn-primary" style="
                            margin-top: 1.7em; 
                            padding: 0.3em;
                            width: 4.4em;
                            cursor: pointer;
                            font-size: 0.9em;
                            border-radius: 0.3em;
                            background-color: rgba(52, 50, 168);
                            color: white;
                            border: none;
                            margin-left: 80%;
                            box-shadow: 1px -1px 5px rgba(0, 0, 0, 0.5);
                            margin-bottom: 2em;
                        ">Thanh toán</button>
    </div>

    <?php
    //include "includes/footer.php";
    ?>
</body>

</html>
<script src="https://kit.fontawesome.com/9077907ee5.js" crossorigin="anonymous"></script>
<script>
    let buy_btn = document.getElementById('buy-btn');
    let buy_form = document.getElementById('buy_form')

    buy_btn.addEventListener('click', () => {
        buy_form.style.display = 'block';
    });

    document.addEventListener('keydown', function(event) {
        if (event.key === "Escape") {
            buy_form.style.display = 'none';
        }
    });
</script>