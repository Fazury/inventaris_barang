<?php
include '../config/koneksi.php';

$id = $_GET['id'];

// Ambil data barang berdasarkan ID
$query_barang = mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang = '$id'");
$data_barang = mysqli_fetch_assoc($query_barang);

// Ambil semua kategori
$query_kategori = mysqli_query($koneksi, "SELECT * FROM kategori");

if (isset($_POST['update'])) {
    $nama       = $_POST['nama_barang'];
    $kategoriID = $_POST['kategori_id'];
    $stok       = $_POST['jumlah_stok'];
    $harga      = $_POST['harga_barang'];
    $tanggal    = $_POST['tanggal_masuk'];

    $update = "UPDATE barang SET 
               nama_barang = '$nama',
               kategori_id = '$kategoriID',
               jumlah_stok = '$stok',
               harga_barang = '$harga',
               tanggal_masuk = '$tanggal'
               WHERE id_barang = '$id'";

    mysqli_query($koneksi, $update);
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Edit Barang</h2>
    <a href="index.php" class="btn btn-secondary mb-3">Kembali</a>

    <form method="POST">
        <div class="mb-3">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" value="<?= $data_barang['nama_barang']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Kategori</label>
            <select name="kategori_id" class="form-select" required>
                <?php while ($row = mysqli_fetch_assoc($query_kategori)) { ?>
                    <option value="<?= $row['id_kategori']; ?>" 
                        <?= ($row['id_kategori'] == $data_barang['kategori_id']) ? 'selected' : ''; ?>>
                        <?= $row['nama_kategori']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Jumlah Stok</label>
            <input type="number" name="jumlah_stok" class="form-control" value="<?= $data_barang['jumlah_stok']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Harga Barang</label>
            <input type="number" name="harga_barang" class="form-control" value="<?= $data_barang['harga_barang']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Tanggal Masuk</label>
            <input type="date" name="tanggal_masuk" class="form-control" value="<?= $data_barang['tanggal_masuk']; ?>" required>
        </div>
        <button type="submit" name="update" class="btn btn-warning">Update</button>
    </form>
</div>
</body>
</html>
