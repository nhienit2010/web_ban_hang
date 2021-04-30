<?php
if ( isset($_SESSION['user']) && isset($_COOKIE['user']) ) {
    if ($_SESSION['user'] !== $_COOKIE['user']) {
        echo "<script>alert('Có gì đó không đúng :)))'); window.location = '/logout.php';</script>";
    }
}

?>