<?php
require_once 'utils/dbconnect.php';
include "utils/check_user.php";

session_start();

if (isset($_COOKIE['user']) && isset($_POST['full_name']) && isset($_POST['phone']) && isset($_POST['address']) && isset($_POST['update'])) {

    if (strlen($_POST['full_name']) > 255 || strlen($_POST['address']) > 255) {
        alert('Tên đầy đủ và địa chỉ phải nhỏ hơn 255 ký tự!');
    }

    if (!preg_match('/^[0-9]/', $_POST['phone'])) {
        alert('Số điện thoại phải chứa toàn ký tự số!');
    }

    $full_name = $_POST['full_name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $q = $conn->prepare("UPDATE users SET full_name=?, phone=?, address=? WHERE username=?");
    $q->bind_param("ssss", $full_name, $phone, $address, $_COOKIE['user']);
    $q->execute();

    echo "<script>alert('Cập nhật thành công!!'); </script>";
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
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/footer.css" />
</head>
<style>
    body {
        background-color: rgba(255, 255, 255, 0.5);
    }

    nav.menu a {
        margin-left: 5em;
        width: 10em;
    }

    div.add-product {
        width: 90%;
        min-height: 35em;
        margin: auto;
        background-color: white;
        margin-top: 50px;
    }

    div.add-product-header {
        width: 100%;
        padding: 10px;
        margin-bottom: 50px;
        background-color:  white;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        color: #333;
    }

    div.add-product-form {
        width: 80%;
        margin: auto;
        min-height: 30em;
    }

    div.add-product-form>h1 {
        font-size: 2.5em;
        text-align: center;
        margin-bottom: 0.5em;
    }

    div.form-group {
        margin-bottom: 0.5em;
    }

    div.form-group>label {
        font-size: 1.1em;
        font-weight: bold;
    }

    div.form-group>input {
        margin-top: 1em;
        padding: 0.5em;
        width: 30em;
        font-size: 1em;
        border: 1.5px solid rgba(0, 0, 0, 0.5);
        border-radius: 0.2em;
        margin-bottom: 1em;
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
    header("Content-type: text/html;charset=UTF-8");
    include "includes/header.php";
    ?>
    <div style="clear: both"></div>
    <div class="add-product">
        <div class='add-product-header'>
            <h1>Thông tin người dùng</h1>
        </div>
        <div class='add-product-form'>
        <?php
        $user_cookie = $_COOKIE['user'];
        $q = $conn->prepare("SELECT * FROM users WHERE username=?");
        $q->bind_param("s", $user_cookie);
        $q->execute();
        $res = $q->get_result();
        if ($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            echo '
            <form action="profile.php" method="POST" id="productForm" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="full_name">Tên đầy đủ</label><br>
                    <input type="text" name="full_name" placeholder="Tên đầy đủ" value="'.htmlentities($row['full_name']).'" />
                </div>
                <div class="form-group">
                    <label for="address">Địa chỉ</label><br>
                    <input type="text" name="address" placeholder="Địa chỉ" value="'.htmlentities($row['address']).'"/>
                </div>
                <div class="form-group">
                    <label for="phone"> Số điện thoại</label><br>
                    <input type="text" name="phone" placeholder="Số điện thoại" value="'.$row['phone'].'"/>
                </div>
                <div class="form-group">
                    <input type="Submit" name="update" value="Cập nhật" />
                </div>
            </form>';
        };
            ?>
        </div>
    </div>

    <?php
    include "includes/footer.php";
    ?>
</body>

</html>
<script src="https://kit.fontawesome.com/9077907ee5.js" crossorigin="anonymous"></script>