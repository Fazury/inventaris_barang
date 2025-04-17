<?php
include '../config/koneksi.php';

// Ambil data kategori untuk dropdown
$kategori = mysqli_query($koneksi, "SELECT * FROM kategori");

if (isset($_POST['simpan'])) {
    $nama       = $_POST['nama_barang'];
    $kategoriID = $_POST['kategori_id'];
    $stok       = $_POST['jumlah_stok'];
    $harga      = $_POST['harga_barang'];
    $tanggal    = $_POST['tanggal_masuk'];

    // Validasi sederhana
    if ($nama != '' && is_numeric($stok) && is_numeric($harga)) {
        $query = "INSERT INTO barang (nama_barang, kategori_id, jumlah_stok, harga_barang, tanggal_masuk)
                  VALUES ('$nama', '$kategoriID', '$stok', '$harga', '$tanggal')";
        mysqli_query($koneksi, $query);
        header("Location: index.php");
        exit;
    } else {
        $error = "Input tidak valid!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Tambah Barang</h2>
    <a href="index.php" class="btn btn-secondary mb-3">Kembali</a>

    <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>

    <form method="POST">
        <div class="mb-3">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Kategori</label>
            <select name="kategori_id" class="form-select" required>
                <option value="">-- Pilih Kategori --</option>
                <?php while($row = mysqli_fetch_assoc($kategori)) { ?>
                    <option value="<?= $row['id_kategori']; ?>"><?= $row['nama_kategori']; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="mb-3">
            <label>Jumlah Stok</label>
            <input type="number" name="jumlah_stok" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Harga Barang</label>
            <input type="number" name="harga_barang" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Tanggal Masuk</label>
            <input type="date" name="tanggal_masuk" class="form-control" required>
        </div>
        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
    </form>
</div>
</body>
</html>
