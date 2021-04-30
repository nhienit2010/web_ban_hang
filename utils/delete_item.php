<?php
session_start();
include 'dbconnect.php';

if ( isset($_GET['id'])) {
    if ( isset($_SESSION['user']) ) {
        $id = intval($_GET['id']);

        $query = $conn->prepare("DELETE FROM carts WHERE id=?");
        $query->bind_param("i", $id);
        $query->execute();
    }
}
echo '<script>
    //alert("Xoá sản phẩm thành công!");
    window.location = "/cart.php";
</script>';
?>