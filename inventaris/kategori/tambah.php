<?php
include '../config/koneksi.php';

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama_kategori'];

    if ($nama != '') {
        mysqli_query($koneksi, "INSERT INTO kategori (nama_kategori) VALUES ('$nama')");
        header("Location: index.php");
        exit;
    } else {
        $error = "Nama kategori tidak boleh kosong!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Tambah Kategori</h2>
    <a href="index.php" class="btn btn-secondary mb-3">Kembali</a>

    <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>

    <form method="POST">
        <div class="mb-3">
            <label>Nama Kategori</label>
            <input type="text" name="nama_kategori" class="form-control" required>
        </div>
        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
    </form>
</div>
</body>
</html>
