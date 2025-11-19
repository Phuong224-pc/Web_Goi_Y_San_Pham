<?php
$host = 'localhost';
$user = 'root';  
$pass = '';     // để trống
$dbname = 'outfit';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>
