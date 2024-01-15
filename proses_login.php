<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$db = "jwp_school";

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

$username = $_POST['username'];
$password = $_POST['password'];
$query = "SELECT * FROM users WHERE username = ? AND password = ?";
$stmt = mysqli_prepare($koneksi, $query);
mysqli_stmt_bind_param($stmt, "ss", $username, $password);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 1) {
    $_SESSION['username'] = $username;
    header("location: publish.php");
} else {
    $_SESSION['error_message'] = 'Username atau password salah.';
    header("location: index.php");
}

mysqli_stmt_close($stmt);
mysqli_close($koneksi);
?>
