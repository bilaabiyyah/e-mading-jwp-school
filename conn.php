<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "jwp_school";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
