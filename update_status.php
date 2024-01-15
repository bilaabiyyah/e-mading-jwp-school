<?php
include('conn.php');

$id_article = $_POST['id_article'];
$new_status = $_POST['new_status'];

$query = "UPDATE publish SET status = '$new_status' WHERE id_article = '$id_article'";
mysqli_query($conn, $query) or die("SQL Error " . mysqli_error($conn));

header('location:draft.php');
?>
