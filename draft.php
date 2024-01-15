<?php
include('conn.php');
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

// Ambil data artikel dengan status draft dari database
$sql = "SELECT * FROM publish WHERE status = 'draft'";
$result = $conn->query($sql);

if (!$result) {
    die("Query error: " . $conn->error);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
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
    <link rel="stylesheet" href="assets/css/draft.css">
    <link rel="icon" href="assets/icon/newspaper.ico" type="image/x-icon">
    <title>Draft | JWP School</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <img src="assets/icon/logo.png" alt="logo" width="200" class="d-inline-block align-text-top">
            <button id="logoutButton" class="nav-link btn btn-link" data-bs-toggle="modal"
                data-bs-target="#logoutModal"><i class="fa-solid fa-right-from-bracket"></i></button>
        </div>
    </nav>
    <div class="d-flex justify-content-between align-items-center">
        <div class="welcome-message">
            <i class="fa-solid fa-user"></i>
            <span class="ml-2">You're logged as <?php echo $_SESSION['username']; ?></span>
        </div>
        <div class="title">
                <h3>e-mading (Draft)</h3>
            </div>
        <div class="d-flex justify-content-end">
            <div class="create mr-10">
                <div class="publish">
                    <a href="publish.php" class="btn btn-custom">
                        <i class="fa-solid fa-globe"></i>
                        <span class="ml-2">Publish</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="articles">
        <?php
     while ($row = $result->fetch_assoc()) {
    ?>

        <div class="card mb-3">
            <div class="d-flex justify-content-end align-items-start">
                <a href="#" class="btn btn-link" title="Edit" data-toggle="modal"
                    data-target="#editModal<?php echo $row['id_article']; ?>">
                    <i class="fas fa-edit"></i>
                </a>
                <a href="#" class="btn btn-link" title="Delete" data-toggle="modal"
                    data-target="#deleteModal<?php echo $row['id_article']; ?>">
                    <i class="fas fa-trash-alt"></i>
                </a>
            </div>
            <img src="file/<?php echo $row['gambar']; ?>" class="card-img-top" alt="Gambar Artikel"
                style="width: 350px; height: 300px;">
            <div class="card-body">
                <h2 class="card-title"><?php echo $row['judul']; ?></h2>
                <a href="artikel.php?id_article=<?php echo $row['id_article']; ?>" class="btn btn-primary">Read
                    More</a>
            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal fade" id="editModal<?php echo $row['id_article']; ?>" tabindex="-1" role="dialog"
            aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Article</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="update_status.php">
                            <input type="hidden" name="id_article" value="<?php echo $row['id_article']; ?>">
                            <div class="form-group">
                                <label for="editedTitle">Judul Artikel</label>
                                <input type="text" class="form-control" id="editedTitle" name="editedTitle"
                                    value="<?php echo $row['judul']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="editedContent">Isi Artikel</label>
                                <textarea class="form-control" id="editedContent" name="editedContent"
                                    rows="4"><?php echo $row['isi']; ?></textarea>
                            </div>
                            <input type="hidden" name="id_article" value="<?php echo $row['id_article']; ?>">
                            <input type="hidden" name="new_status" value="publish">
                            <button type="submit" class="btn btn-primary">Publish</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Konfirmasi Delete -->
        <div class="modal fade" id="deleteModal<?php echo $row['id_article']; ?>" tabindex="-1" role="dialog"
            aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Delete</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus artikel ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <a href="delete.php?id_article=<?php echo $row['id_article']; ?>" class="btn btn-danger">Ya,
                            Hapus!</a>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }
    ?>
    </div>

    <div class="footer">
        <footer class="text-center text-lg-start mt-2">
            <div class="container p-1">
                <p>&copy; JeWePe School. All Right Reserved</p>
            </div>
        </footer>

</body>

</html>