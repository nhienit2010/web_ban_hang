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
    <link rel="stylesheet" href="css/footer.css" />
    <link rel="stylesheet" href="css/main.css" />
</head>
<style>
    body {
        background-image: url("images/bg.jpg");
        background-repeat: initial;
        background-attachment: fixed;
    }
</style>

<body>
    <?php
    session_start();
    include "header.php";
    include "menu.php";
    include "dbconnect.php";
    ?>
    <div style="clear: both"></div>
    <?php
    if (isset($_GET['category'])) {
        $category = $_GET['category'];

        echo '<div class="main">';
        echo '<div class="main-product">';
        echo '    <div class="main-product-title" >';
        switch ($category) {
            case 'dtdd':
                echo " Điện thoại ";
                break;
            case 'laptop':
                echo " Laptop ";
                break;
            case 'tablet':
                echo " Tablet ";
                break;
            case 'headphone':
                echo " Tai nghe ";
                break;
            case 'screen':
                echo " Màn hình ";
                break;
            case 'sim':
                echo " SIM ";
                break;
            case 'printer':
                echo " Máy in ";
                break;
            default:
                echo " Không tìm thấy loại sản phẩm!!";
                break;
        }
        echo '
        <form method="GET" action="'.$_SERVER['REQUEST_URI'].'" style="float: right">
            <label for="sort">Sắp xếp:</label>
            <input name="category" value="'.explode("=",explode("&", $_SERVER['QUERY_STRING'])[0])[1].'" hidden/>
            <select id="sort" name="sort" style="
                background-color: #3d80f5;
                position: relative;
                font-family: Arial;
                padding: 8px 16px;
                font-size: 16px;
                border: none;
                cursor: pointer;
                color:white;
            ">
                <option value="asc">Tăng dần</option>
                <option value="des">Giảm dần</option>
            </select>
            <input type="submit" value="Tìm" style="
                border: none; 
                border-radius: 5px;
                padding: 5px;
            "/>
        </form>';
        echo '    </div>';

        $query = '';

        if (!isset($_GET['sort'])) {
            $query = $conn->prepare("SELECT * FROM products WHERE product_type=?");
        } else {
            if ($_GET['sort'] === 'des') 
                $query = $conn->prepare("SELECT * FROM products WHERE product_type=? order by product_price desc");
            else 
                $query = $conn->prepare("SELECT * FROM products WHERE product_type=? order by product_price asc");
        }

        $query->bind_param("s", $category);
        $query->execute();
        $result = $query->get_result();

        $count = 0;

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($count % 4 === 0) {
                    echo '    <div class="main-product-itemList">';
                }
                echo '
                        <div class="main-product-itemList-item">
                        <div class="main-product-itemList-item-image">
                            <img src="' . $row['product_image'] . '" />
                        </div>
                        <div class="main-product-itemList-item-content">
                            <h2><a href="item.php?id=' . $row['product_id'] . '">' . $row['product_name'] . ' </a></h2>
                            <h3><b>Giá: ' . $row['product_price'] . '</b></h3>
                            <p><b>Xuất xứ :</b> ' . $row['product_origin'] . '</p>
                            <p><b>Mô tả :</b> ' . $row['product_description'] . '</p>
                        </div>
                    </div>';
                $count += 1;
                if ($count % 4 === 0) {
                    echo '</div><div style="clear: both;"></div>';
                }
            }
        }
        echo '    </div>';
        echo ' </div>';
        echo '</div>';
    }
    ?>
</body>
<?php include 'footer.php'; ?>

</html>
<script src="https://kit.fontawesome.com/9077907ee5.js" crossorigin="anonymous"></script>
<script src="js/slide.js"></script>