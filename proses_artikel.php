<?php
include('conn.php');

$judul = $_POST['judul'];
$isi = $_POST['isi'];
$gambar = $_FILES['gambar']['name'];
$file_tmp = $_FILES['gambar']['tmp_name'];
move_uploaded_file($file_tmp, 'file/'.$gambar);

// Ganti 'draft' dengan 'publish' sesuai dengan radio button yang dipilih
$status = $_POST['status'];

$gambar = mysqli_real_escape_string($conn, $gambar);
$query = "INSERT INTO publish SET 
    judul = '$judul',
    isi   = '$isi',
    gambar= '$gambar',
    status = '$status'";
mysqli_query($conn, $query) or die("SQL Error " . mysqli_error($conn));

if ($status === 'draft') {
    header('location:draft.php');
} elseif ($status === 'publish') {
    header('location:publish.php');
} else {
    // Handle case when status is neither draft nor publish
    // You can redirect to an error page or handle it as needed
    echo "Invalid status";
    exit();
}
?>
