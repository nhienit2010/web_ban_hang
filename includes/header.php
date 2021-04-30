<div class="header">
    <div class="header-label">
        <i class="fas fa-mobile-alt"></i>
        <a href='index.php'>KMAphone</a>
    </div>

    <?php
    echo '<div class="header-login">';
    if (!isset($_SESSION['user'])) {
        echo '   <a href="login.php"><i class="fas fa-sign-in-alt"> <span class="tooltiptext">Login</span></i></a>';
        echo '   <a href="register.php"><i class="fas fa-user-plus"> <span class="tooltiptext">Register</span></i></a>';
    }else {
        if ($_SESSION['user'] === 'admin'){
            echo '<a href="admin.php"><i class="fas fa-users-cog"> <span class="tooltiptext">Admin</span></i></a>';
            echo '<a href="logout.php"><i class="fas fa-sign-out-alt"> <span class="tooltiptext">Logout</span></i></a>';
            echo '<a href="profile.php"><i class="fas fa-user-shield"></i><span class="tooltiptext">Account : '.$_SESSION['user'].'</span></i></a>';
        } else {
            echo '<a href="cart.php"><i class="fas fa-cart-plus"> <span class="tooltiptext">Product</span></i></a>';
            echo '<a href="logout.php"><i class="fas fa-sign-out-alt"> <span class="tooltiptext">Logout</span></i></a>';
            echo '<a href="profile.php"><i class="fas fa-user"></i><span class="tooltiptext">Account : '.$_SESSION['user'].'</span></i></a>';
        }
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