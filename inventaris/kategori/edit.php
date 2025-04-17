<?php
include '../config/koneksi.php';

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM kategori WHERE id_kategori = '$id'");
$data = mysqli_fetch_assoc($query);

if (isset($_POST['update'])) {
    $nama = $_POST['nama_kategori'];

    if ($nama != '') {
        mysqli_query($koneksi, "UPDATE kategori SET nama_kategori = '$nama' WHERE id_kategori = '$id'");
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
    <title>Edit Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Edit Kategori</h2>
    <a href="index.php" class="btn btn-secondary mb-3">Kembali</a>

    <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>

    <form method="POST">
        <div class="mb-3">
            <label>Nama Kategori</label>
            <input type="text" name="nama_kategori" class="form-control" value="<?= $data['nama_kategori']; ?>" required>
        </div>
        <button type="submit" name="update" class="btn btn-warning">Update</button>
    </form>
</div>
</body>
</html>
