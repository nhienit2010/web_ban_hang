<div class="header">
    <div class="header-label">
        <i class="fas fa-mobile-alt"></i>
        <a href='index.php'>KMAphone</a>
    </div>

    <?php
    echo '<div class="header-login">';
    if (!isset($_SESSION['user'])) {
        echo '   <a href="login.php"><i class="fas fa-sign-in-alt"></i></a>';
        echo '   <a href="register.php"><i class="fas fa-user-plus"></i></a>';
    }else {
        if ($_SESSION['user'] === 'admin')
            echo '   <a href="admin.php"><i class="fas fa-users-cog"></i></a>';
        echo '   <a href="cart.php"><i class="fas fa-cart-plus"></i></a>';
        echo '   <a href="logout.php"><i class="fas fa-sign-out-alt"></i></a>';
    }
    echo '</div>';
        ?>
    
    <div class="header-search">
        <i class="fas fa-search"></i>
        <form action="search.php">
            <input type="text" name="search" placeholder="Nhập để tìm kiếm"/>
        </form>
    </div>
</div>