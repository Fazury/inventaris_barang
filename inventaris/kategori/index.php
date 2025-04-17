<?php
include '../config/koneksi.php';

$query = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY id_kategori DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Kategori</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2 class="mb-4">Data Kategori Barang</h2>

    <a href="tambah.php" class="btn btn-primary mb-3">+ Tambah Kategori</a>
    <a href="../index.php" class="btn btn-secondary mb-3">Kembali</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($data = mysqli_fetch_assoc($query)) { ?>
            <tr>
                <td><?= $data['id_kategori']; ?></td>
                <td><?= $data['nama_kategori']; ?></td>
                <td>
                    <a href="edit.php?id=<?= $data['id_kategori']; ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="hapus.php?id=<?= $data['id_kategori']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</body>
</html>
