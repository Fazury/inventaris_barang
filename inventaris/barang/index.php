<?php
include '../config/koneksi.php';

// Konfigurasi pagination
$limit = 5; // jumlah data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Ambil total data
$total_data = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM barang"));
$total_pages = ceil($total_data / $limit);

// Query dengan limit
$query = mysqli_query($koneksi, "SELECT barang.*, kategori.nama_kategori 
                                 FROM barang 
                                 JOIN kategori ON barang.kategori_id = kategori.id_kategori 
                                 ORDER BY id_barang DESC 
                                 LIMIT $start, $limit");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2 class="mb-4">Data Barang</h2>

    <a href="tambah.php" class="btn btn-primary mb-3">+ Tambah Barang</a>
    <a href="../index.php" class="btn btn-secondary mb-3">Kembali</a>
    <a href="export_excel.php" class="btn btn-success mb-3">Export Excel</a>
    <a href="export_pdf.php" class="btn btn-danger mb-3" target="_blank">Export PDF</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Harga</th>
                <th>Tanggal Masuk</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($data = mysqli_fetch_assoc($query)) { ?>
            <tr>
                <td><?= $data['id_barang']; ?></td>
                <td><?= $data['nama_barang']; ?></td>
                <td><?= $data['nama_kategori']; ?></td>
                <td><?= $data['jumlah_stok']; ?></td>
                <td>Rp <?= number_format($data['harga_barang'], 0, ',', '.'); ?></td>
                <td><?= $data['tanggal_masuk']; ?></td>
                <td>
                    <a href="edit.php?id=<?= $data['id_barang']; ?>" class="btn btn-sm btn-warning">Edit</a>
                    <a href="hapus.php?id=<?= $data['id_barang']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Pagination -->
    <nav>
        <ul class="pagination">
            <?php if ($page > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?= $page - 1; ?>">« Prev</a>
                </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $i; ?>"><?= $i; ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($page < $total_pages): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?= $page + 1; ?>">Next »</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>
</body>
</html>
