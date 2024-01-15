<?php
include('conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id_article'])) {
    $id_article = $_GET['id_article'];

    // Lakukan query delete ke database
    $deleteQuery = "DELETE FROM publish WHERE id_article = $id_article";
    $deleteResult = $conn->query($deleteQuery);

    if ($deleteResult) {
        // Set session pesan pemberitahuan
        session_start();
        $_SESSION['notification'] = "Artikel berhasil dihapus!";
    } else {
        // Jika terjadi kesalahan dalam proses delete
        session_start();
        $_SESSION['notification'] = "Error deleting article: " . $conn->error;
    }

    // Redirect kembali ke halaman sebelumnya (misalnya, publish.php)
    header("Location: {$_SERVER['HTTP_REFERER']}");
    exit();
} else {
    // Jika tidak ada parameter yang diberikan, redirect ke halaman lain atau tampilkan pesan error
    header("Location: index.php");
    exit();
}
?>
