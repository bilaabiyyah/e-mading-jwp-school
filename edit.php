<?php
include('conn.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_article = $_POST['id_article'];
    $editedTitle = $_POST['editedTitle'];
    $editedContent = $_POST['editedContent'];

    // Lakukan validasi dan sanitasi data jika diperlukan

    // Lakukan query update ke database
    $updateQuery = "UPDATE publish SET judul='$editedTitle', isi='$editedContent' WHERE id_article=$id_article";
    $updateResult = $conn->query($updateQuery);

    if ($updateResult) {
        // Set session pesan pemberitahuan
        $_SESSION['notification'] = "Artikel berhasil diupdate!";
        header("Location: publish.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>
