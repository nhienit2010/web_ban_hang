<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>kmaphone.nhienit.io</title>
  <link rel="stylesheet" href="css/header.css" media="all"/>
  <link rel="stylesheet" href="css/background.css" media="all" />
  <link rel="stylesheet" href="css/menu.css" media="all" />
  <link rel="stylesheet" href="css/main.css" media="all" />
  <link rel="stylesheet" href="css/footer.css" media="all" />
</head>
<style>
  body {
    background-color: rgba(255, 255, 255, 0.5);
  }
</style>

<body>
  <?php
  session_start();
  header("Content-type: text/html;charset=UTF-8");
  include "header.php";
  include "utils/check_user.php";
  include "menu.php";
  include "utils/dbconnect.php";
  ?>
  <div style="clear: both"></div>
  <div class="main">
    <!-- main image -->
    <div class="main-images">
      <div class="main-images-slide" id="slider">
        <!-- <img id="slide" src="images/slides/1.png" /> -->
        <div class="slide" id="slide-1">
          <img id="slide" src="images/slides/1.png" />
        </div>
        <div class="slide" id="slide-2">
          <img id="slide" src="images/slides/2.png" />
        </div>
        <div class="slide" id="slide-3">
          <img id="slide" src="images/slides/3.png" />
        </div>
        <div class="slide" id="slide-4">
          <img id="slide" src="images/slides/4.png" />
        </div>
        <div class="slide" id="slide-5">
          <img id="slide" src="images/slides/5.png" />
        </div>
      </div>
      <div class="main-images-sale">
        <img src="images/sales/1.png" alt="" />
        <img src="images/sales/2.png" alt="" />
        <img src="images/sales/3.png" alt="" />
      </div>
    </div>
    <!-- main image -->
    
    <!-- main news -->
    <div class="main-news">
      <div class="main-news-title">Tin tức nổi bật</div>
      <div class="main-news-item">
        <div class="main-news-item-image">
          <img src="images/news/new.png" alt="" />
        </div>
        <div class="main-news-item-contents">
          <a href="#" style="font-size: 20px;">
            Lorem, ipsum dolor sit amet consectetur adipisicing elit.
            Pariatur, quisquam?
          </a>
          <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Facere
            itaque iste consequuntur et aliquid fugit eos unde officia
            possimus incidunt? Expedita incidunt id minima ratione, debitis
            reiciendis officia praesentium corporis? Lorem ipsum dolor sit,
            amet consectetur adipisicing elit. A, magnam. Architecto quasi,
            nobis hic asperiores animi suscipit! Nihil expedita, aliquam
            voluptatem quae ea culpa perspiciatis at ducimus velit tempore
            dolore?</p>
        </div>
      </div>
      <div class="main-news-item">
        <div class="main-news-item-image">
          <img src="images/news/new.png" alt="" />
        </div>
        <div class="main-news-item-contents">
          <a href="#" style="font-size: 20px;">
            Lorem, ipsum dolor sit amet consectetur adipisicing elit.
            Pariatur, quisquam?
          </a>
          <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Facere
            itaque iste consequuntur et aliquid fugit eos unde officia
            possimus incidunt? Expedita incidunt id minima ratione, debitis
            reiciendis officia praesentium corporis? Lorem ipsum dolor sit,
            amet consectetur adipisicing elit. A, magnam. Architecto quasi,
            nobis hic asperiores animi suscipit! Nihil expedita, aliquam
            voluptatem quae ea culpa perspiciatis at ducimus velit tempore
            dolore?</p>
        </div>
      </div>
      <div class="main-news-item">
        <div class="main-news-item-image">
          <img src="images/news/new.png" alt="" />
        </div>
        <div class="main-news-item-contents">
          <a href='#' style="font-size: 20px;">
            Lorem, ipsum dolor sit amet consectetur adipisicing elit.
            Pariatur, quisquam?
          </a>
          <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Facere
            itaque iste consequuntur et aliquid fugit eos unde officia
            possimus incidunt? Expedita incidunt id minima ratione, debitis
            reiciendis officia praesentium corporis? Lorem ipsum dolor sit,
            amet consectetur adipisicing elit. A, magnam. Architecto quasi,
            nobis hic asperiores animi suscipit! Nihil expedita, aliquam
            voluptatem quae ea culpa perspiciatis at ducimus velit tempore
            dolore?</p>
        </div>
      </div>
      <div class="main-news-item">
        <div class="main-news-item-image">
          <img src="images/news/new.png" alt="" />
        </div>
        <div class="main-news-item-contents">
          <a href="#" style="font-size: 20px;">
            Lorem, ipsum dolor sit amet consectetur adipisicing elit.
            Pariatur, quisquam?
          </a>
          <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Facere
            itaque iste consequuntur et aliquid fugit eos unde officia
            possimus incidunt? Expedita incidunt id minima ratione, debitis
            reiciendis officia praesentium corporis? Lorem ipsum dolor sit,
            amet consectetur adipisicing elit. A, magnam. Architecto quasi,
            nobis hic asperiores animi suscipit! Nihil expedita, aliquam
            voluptatem quae ea culpa perspiciatis at ducimus velit tempore
            dolore?</p>
        </div>
      </div>
    </div>
    <!-- main news -->

    <!-- main product -->
    <?php
      $category = ['dtdd', 'laptop', 'tablet', 'screen', 'sim'];
      echo "
        <div class='main-product'>
          <div class='main-product-title'>Sản phẩm được xem nhiều nhất</div>
          <div class='main-product-itemList'>";
          $query = $conn->prepare("select * from products order by product_view desc");
          $query->execute();
          $result = $query->get_result();
          $count = 0;

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              if ($count === 4) break;
              echo '
                      <div class="main-product-itemList-item">
                        <div class="main-product-itemList-item-image">
                          <img src="' . $row['product_image'] . '" />
                        </div>
                        <div class="main-product-itemList-item-content">
                          <h2><a href="item.php?id='.$row['product_id'].'">' . $row['product_name'] . ' </a></h2>
                          <h3><b>Giá: ' . number_format(intval($row['product_price'])) . '</b></h3>
                          <p><b>Xuất xứ :</b> ' . $row['product_origin'] . '</p>
                          <p><b>Mô tả :</b> ' . $row['product_description'] . '</p>
                        </div>
                    </div>';
              $count++;
            }
          }
      echo"   </div>
        </div>
        ";
      foreach ($category as $key => $value) {
        echo "<div class='main-product'>
              <div class='main-product-title'>";
              switch ($value) {
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
          echo "</div>
          <div class='main-product-itemList'>";
            $query = $conn->prepare("select * from products where product_type = ?");
            $query->bind_param("s", $value);
            $query->execute();
            $result = $query->get_result();
            $count = 0;

            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                if ($count === 4) break;
                echo '
                        <div class="main-product-itemList-item">
                          <div class="main-product-itemList-item-image">
                            <img src="' . $row['product_image'] . '" />
                          </div>
                          <div class="main-product-itemList-item-content">
                            <h2><a href="item.php?id='.$row['product_id'].'">' . $row['product_name'] . ' </a></h2>
                            <h3><b>Giá: ' . number_format(intval($row['product_price'])) . '</b></h3>
                            <p><b>Xuất xứ :</b> ' . $row['product_origin'] . '</p>
                            <p><b>Mô tả :</b> ' . $row['product_description'] . '</p>
                          </div>
                      </div>';
                $count++;
              }
            }
            echo '</div>';
          }
        ?>
      </div>
    </div>
    <!-- main product -->

    </div>

    </div>
  </div>
</div>

</body>
<?php
    include "footer.php";
?>
</html>

<script src="https://kit.fontawesome.com/9077907ee5.js" crossorigin="anonymous"></script>
<script src="js/slide.js"></script>