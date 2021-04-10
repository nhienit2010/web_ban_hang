<?php
require_once 'dbconnect.php';
include "check_user.php";

if( isset($_POST['id']) && isset($_POST['color']) && isset($_COOKIE['user']) && isset($_POST['quantity'])) {
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
    }
    else {
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
        background-image: url("images/bg.jpg");
        background-repeat:initial;
        background-attachment: fixed;
    }
    div.cart {
        width: 80%;
        min-height: 35em;
        margin: auto;
        background-color: white;
        margin-top: 50px;
    }
    div.cart-header {
        width: 100%;
        background-color: #4e76f0;
        color: white;
        padding: 10px;
        margin-bottom: 50px;
    }
    div.cart-list {
        width: 80%;
        margin: auto;
    }
    table {
        border-collapse: collapse;
    }
    table, th, td {
        border: 2px solid black;
    }
    th, td {
        padding: 15px;
    }
    tr > th:first-child, tr > th:nth-child(3), tr > th:nth-child(4){
        width: 6em;
    }
    tr > th:nth-child(2) {
        width: 37em;
    }
</style>

<body>
  <?php
    session_start();
    header("Content-type: text/html;charset=UTF-8");
    include "header.php";
    include "menu.php";
  ?>
  <div style="clear: both"></div>
  <div class="cart">
    <div class="cart-header"><h1>Giỏ hàng của bạn</h1></div>
    <div class="cart-list">
        <table class="table table-striped">
            <thead>
                <tr>
                <th >ID sản phẩm</th>
                <th >Tên sản phẩm</th>
                <th >Màu sắc</th>
                <th >Số lượng</th>
                <th >Thao tác</th>
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
                
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        
                        $sql = "SELECT product_name FROM products where product_id=".$row['product_id'];
                        $res = $conn->query($sql);
                        if ($res->num_rows > 0) {
                            while($r = $res->fetch_assoc()) {
                                $product_name = $r['product_name'];
                            }
                        }

                        echo '
                            <tr>
                            <th>'.$row['product_id'].'</th>
                            <td>'.$product_name.'</td>
                            <td>'.$row['product_color'].'</td>
                            <td>'.$row['product_amount'].'</td>
                            <td> <a href="delete_item.php?id='. $row['id'] .'">Xoá </a>
                            </tr>';
                    }
                }else {
                    echo "<script>alert('Chưa có sản phẩm nào trong giỏ hàng!!')</script>";
                }
            }else{}
            echo '</tbody>';
            ?>
        <br>
        </table>
    </div>
    <a href="" ><button type="submit" class="btn btn-primary" style="
                            margin-top: 30px; 
                            padding: 5px;
                            width: 80px;
                            cursor: pointer;
                            font-size: 16px;
                            border-radius: 5px;
                            background-color: rgba(52, 50, 168);
                            color: white;
                            border: none;
                            margin-left: 80%;
                            box-shadow: 1px -1px 5px rgba(0, 0, 0, 0.5);
                            margin-bottom: 2em;
                        ">Thanh toán</button>
    </a>

  </div>

  <?php
  include "footer.php";
  ?>
</body>

</html>
<script src="https://kit.fontawesome.com/9077907ee5.js" crossorigin="anonymous"></script>