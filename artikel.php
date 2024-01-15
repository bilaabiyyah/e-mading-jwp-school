<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-zNLqRozXm7zW4aQ+NHi+q4ZSlZWG8I6EMCgZlKlbIF9ia/ji1m9R5k5SCaHMGDDM18Dq7NZYA85D/Y+HPuyVMg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UJZQJ8mZQCS0E9QEcDUnxEJzz8q0v+0gF+7aV6D/iI6IJKFYnJAg6JoYd13DZ+eg" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/bd0161f2b3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="bootstrap-5.3.2-dist/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/artikel.css">
    <link rel="icon" href="assets/icon/file.ico" type="image/x-icon">
    <title>Articles | JWP School</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <img src="assets/icon/logo.png" alt="logo" width="200" class="d-inline-block align-text-top">
        </div>
    </nav>
    <div class="container">
<?php
include('conn.php');

$id_article = isset($_GET['id_article']) ? $_GET['id_article'] : null;

if ($id_article) {
    $sql = "SELECT * FROM publish WHERE id_article = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_article);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo '<div class="content">';
        echo '<img class="article" src="file/' . $row['gambar'] . '" alt="Gambar Artikel">'; // Tambahkan baris ini
        echo '<h2>' . $row['judul'] . '</h2>';
        echo '<p>' . $row['isi'] . '</p>';
        echo '</div>';
    } else {
        echo 'Artikel tidak ditemukan';
    }

    $stmt->close();
} else {
    echo 'Parameter id_article tidak ditemukan.';
}

$conn->close();
?>
</div>
<div class="footer">
        <footer class="text-center text-lg-start mt-2">
            <div class="content-footer p-1">
                <p>&copy; JeWePe School. All Right Reserved</p>
            </div>
        </footer>
    </div>
</body>
</html>