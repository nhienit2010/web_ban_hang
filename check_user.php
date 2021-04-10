<?php
if ( isset($_SESSION['user']) && isset($_COOKIE['user']) ) {
    if ($_SESSION['user'] !== $_COOKIE['user']) {
        var_dump($_SESSION['user']);
        var_dump($_COOKIE['user']);
        echo "<script>alert('Có gì đó không đúng :)))')</script>";
        header('Location: /webbanhang/logout.php');
    }
}
?>