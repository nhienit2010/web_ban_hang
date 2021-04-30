<?php

$server_name = "localhost";
$username = "root";
$password = "";
$database_name = "kmaphone";

$conn = new mysqli($server_name, $username, $password, $database_name);
mysqli_set_charset($conn, 'UTF8');
if ($conn->connect_error) {
    die("MySQL connect error!!!");
}

/*$query = "select * from products";
$result = $conn->query($query);

if ($result->num_rows > 0 ) {
    while ($row = $result->fetch_assoc())
}*/
?>