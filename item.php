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
    /*body {
        background-image: url("images/bg.jpg");
        background-repeat: initial;
        background-attachment: fixed;
    }*/

    div.item-name {
        width: 90%;
        margin: auto;
        margin-top: 30px;
        padding-left: 20px;
    }

    div.item-detail {
        height: 500px;
        width: 80%;
        margin: auto;
        background-color: white;
        margin-top: 20px;
    }

    div.item-name>hr {
        color: white;
    }

    div.item-detail-img,
    div.item-detail-decs {
        width: 35%;
        height: 100%;
        float: left;
        border-right: 1px solid black;
    }

    div.item-detail-img>img {
        width: 100%;
        height: 80%;
        margin-top: 50px;
    }

    div.item-detail-decs-content {
        margin-left: 30px;
    }

    div.item-detail-decs h1 {
        text-align: center;
    }

    div.item-detail-decs-content p:first-child {
        font-size: 26px;
        font-weight: bold;
        margin-top: 50px;
        color: red;
    }

    div.item-detail-decs-content p:not(p:first-child) {
        font-size: 20px;
        margin-top: 20px;
    }

    div.item-detail-decs-content ul {
        list-style: circle;
        margin-left: 30px;
        margin-top: 20px;
    }

    div.item-detail-decs-content li {
        font-size: 18px;
        margin-top: 5px;
    }

    div.item-detail-buy {
        width: 20%;
        height: 100%;
        float: left;
        margin-top: 50px;
        margin-left: 20px;
    }

    div.item-detail-buy div.item-detail-buy-color {
        width: 100px;
        height: 50px;
        border-radius: 5px;
        float: left;
        font-weight: bold;
        margin-left: 20px;
        margin-top: 20px;
        text-align: center;
        padding-top: 15px;
        cursor: pointer;
        box-shadow: 2px -1px 5px rgba(0, 0, 0, 0.5);
    }

    div.item-detail-buy-form {
        margin-top: 50px;
        position: static;
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
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $query = $conn->prepare("SELECT * FROM products WHERE product_id=?");
        $query->bind_param("i", $id);
        $query->execute();
        $result = $query->get_result();
    } else {
        echo "<script>alert('Vui lòng chọn một sản phẩm để xem thông tin!!')</script>";
        die();
    }

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $view = intval($row['product_view']);

            echo '
                <div class="item-name">
                <h1>' . $row['product_name'] . ' - Lượt xem: '. $row['product_view']. '</h1>
                <hr />
                </div>
                <div class="item-detail">
                <div class="item-detail-img">
                    <img src="' . $row['product_image'] . '" alt="" />
                </div>
                <div class="item-detail-decs">
                    <h1>Thông số kỹ thuật</h1>
                    <div class="item-detail-decs-content">
                    <p>Giá: ' . $row['product_price'] . '</p>
                    <p>Xuất xứ: ' . $row['product_origin'] . '</p>
                    <p>Chi tiết:</p>
                    <ul>';
            $t = explode(' -', $row['product_description']);
            foreach ($t as $value) {
                echo "<li>$value</li>";
            }
            echo '</ul>
                    </div>
                </div>
                <div class="item-detail-buy">
                    <div class="item-detail-buy-color" onclick="addColor(\'White\')">Màu trắng</div>
                    <div
                    class="item-detail-buy-color"
                    style="background-color: red; color: white"
                    onclick="addColor(\'Red\')"
                    >
                    Màu đỏ
                    </div>
                    <div
                    class="item-detail-buy-color"
                    style="background-color: black; color: white"
                    onclick="addColor(\'Black\')"
                    >
                    Màu đen
                    </div>
                    <div style="clear: both;"></div>
                    <div class="item-detail-buy-form">
                    <form id="buy" action="cart.php" method="POST">
                        <input type="text" name="id" value="'.$row['product_id'].'" hidden/>
                        <label for="color" style="font-size: 20px;">Màu đã chọn: </label>
                        <input type="text" name="color" value="Red" style="border: none; outline: none; font-size: 16px;"/> <br>
                        <br>
                        <label for="quantity" style="font-size: 20px;">Số lượng: </label>
                        <input type="number" id="quantity" value="1" name="quantity" min="1"
                            style="width: 50px"    
                        > 
                        <br>
                        <button type="submit" class="btn btn-primary" style="
                            margin-top: 30px; 
                            padding: 15px;
                            width: 80px;
                            cursor: pointer;
                            font-size: 18px;
                            border-radius: 5px;
                            background-color: rgba(52, 50, 168);
                            color: white;
                            border: none;
                            box-shadow: 1px -1px 5px rgba(0, 0, 0, 0.5);
                        ">Mua</button>
                    </form>
                    </div>
                </div>
                </div>';
        }

        $query = $conn->prepare("UPDATE products SET product_view=? where product_id=?");
        $view += 1;
        $query->bind_param("ii", $view, $id);
        $query->execute();

    }else die('<script>alert("Không tìm thấy sản phẩm!!")</script>');
    ?>
</body>

</html>
<script src="https://kit.fontawesome.com/9077907ee5.js" crossorigin="anonymous"></script>
<script src="js/slide.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    let addColor = (color) => {
        document.getElementsByName('color')[0].value = color;
    }
</script>