<div class="header">
    <div class="header-label">
        <i class="fas fa-mobile-alt"></i>
        <a href='index.php'>KMAphone</a>
    </div>

    <?php
    if (!isset($_SESSION['user'])) {
        echo '<div class="header-login">';
        echo '   <a href="login.php"><i class="fas fa-sign-in-alt"></i></a>';
        echo '   <a href="register.php"><i class="fas fa-user-plus"></i></a>';
        echo '</div>';
    }
    ?>
    <div class="header-search">
        <i class="fas fa-search"></i>
        <form action="search.php">
            <input type="text" name="search" placeholder="Nhập để tìm kiếm"/>
        </form>
    </div>
</div>