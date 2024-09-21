<!--file kết nối DB -->
<?php
$servername="localhost";
$username ="root";
$password="";
$dbname = "BTTH01_CSE485";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}



?>
                            