<?php
require_once 'utils/dbconnect.php';
include "utils/check_user.php";

session_start();

if (isset($_SESSION['user']) && $_SESSION['user'] !== 'admin') {
    echo "<script>alert('Chỉ admin mới có thể vào khu vực này!'); window.location='/index.php';</script>";
}

function alert($message) {
    echo "<script>alert('{$message}'); window.location = '/admin.php';</script>";
    exit();
}
if (
    isset($_POST['product_name']) && isset($_POST['product_price']) && isset($_POST['product_origin']) &&
    isset($_POST['product_type']) && isset($_POST['product_description']) && !empty($_FILES)
) {
    $product_type_list = ['dtdd', 'laptop', 'tablet', 'screen', 'sim', 'headphone', 'printer'];
    $img_ext = ['png', 'jpeg', 'jpg'];

    if (strlen($_POST['product_name']) > 255 || strlen($_POST['product_origin']) > 255) {
        alert('Tên phải nhỏ hơn 255 ký tự!');
    }

    if (!preg_match('/^[0-9]/', $_POST['product_price'])) {
        alert('Giá tiền phải chứa toàn ký tự số!');
    }

    if (!in_array($_POST['product_type'], $product_type_list)) {
        alert('Vui lòng nhập chính xác loại sản phẩm!');
    }

    $product_name = $_POST['product_name'];
    $product_origin = $_POST['product_origin'];
    $product_type = $_POST['product_type'];
    $product_price = intval($_POST['product_price']);
    $product_description = $_POST['product_description'];

    $target_dir = 'images/' . $product_type . '/';
    $file_name = basename($_FILES["product_image"]["name"]);
    $check = getimagesize($_FILES["product_image"]["tmp_name"]);

    $upload_ok = 1;

    if (!$check) {
        alert('Vui lòng kiểm tra lại ảnh!');
    };
    if (file_exists($target_dir . $file_name)) {
        alert('File đã tồn tại! Vui lòng chọn tên khác');
    }
    if ($_FILES["product_image"]["size"] > 5000000) {
        alert('Kích thước hình ảnh quá lớn!!');
    }

    $imageFileType = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    if (!in_array($imageFileType, $img_ext)) {
        alert('Phần mở rộng sai!!');
    }

    $target = $target_dir . $file_name;

    if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target)) {
        $view = 0;
        $query = $conn->prepare("INSERT INTO products(product_name, product_price, product_type, product_origin, product_description, product_image, product_view) VALUES(?, ?, ?, ?, ?, ?, ?)");
        $query->bind_param("sissssi", $product_name, $product_price, $product_type, $product_origin, $product_description, $target, $view);
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
    include "includes/menu_admin.php";
    ?>
    <div style="clear: both"></div>
    <div class="add-product">
        <div class='add-product-header'>
            <h1>Thêm sản phẩm</h1>
        </div>
        <div class='add-product-form'>
            <h1>Nhập thông tin sản phẩm</h1>
            <form action="add_product.php" method="POST" id="productForm" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="product_name">Tên sản phẩm</label><br>
                    <input type="text" name="product_name" placeholder="Tên sản phẩm" />
                </div>
                <div class="form-group">
                    <label for="product_price">Giá sản phẩm</label><br>
                    <input type="text" name="product_price" placeholder="Giá sản phẩm" />
                </div>
                <div class="form-group">
                    <label for="product_origin">Xuất xứ sản phẩm</label><br>
                    <input type="text" name="product_origin" placeholder="Xuất xứ sản phẩm" />
                </div>
                <div class="form-group">
                    <label for="product_type">Loại sản phẩm</label><br>
                    <select name="product_type">
                        <option value="dtdd" selected> Điện thoại di động </option>
                        <option value="laptop"> Laptop </option>
                        <option value="tablet"> Máy tính bảng </option>
                        <option value="screen"> Màn hình </option>
                        <option value="sim"> Sim </option>
                        <option value="headphone"> Tai nghe </option>
                        <option value="printer"> Máy in </option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="product_description">Mô tả sản phẩm</label><br>
                    <input type="text" name="product_description" placeholder="Mô tả sản phẩm" />
                </div>
                <div class="form-group">
                    <label for="product_image"> Ảnh sản phẩm</label><br>
                    <input type="file" name="product_image" placeholder="Ảnh sản phẩm: png, jpg, jpeg" />
                </div>
                <div class="form-group">
                    <input type="Submit" name="submit" value="Upload" />
                </div>
            </form>
        </div>
    </div>

    <?php
    include "includes/footer.php";
    ?>
</body>

</html>
<script src="https://kit.fontawesome.com/9077907ee5.js" crossorigin="anonymous"></script>