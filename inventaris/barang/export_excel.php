<?php
include '../config/koneksi.php';

// Set header untuk download file Excel
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=data_barang.xls");

$query = mysqli_query($koneksi, "SELECT barang.*, kategori.nama_kategori 
                                 FROM barang 
                                 JOIN kategori ON barang.kategori_id = kategori.id_kategori");
?>

<h3>Data Barang</h3>
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Stok</th>
            <th>Harga</th>
            <th>Tanggal Masuk</th>
        </tr>
    </thead>
    <tbody>
        <?php while($data = mysqli_fetch_assoc($query)) { ?>
        <tr>
            <td><?= $data['id_barang']; ?></td>
            <td><?= $data['nama_barang']; ?></td>
            <td><?= $data['nama_kategori']; ?></td>
            <td><?= $data['jumlah_stok']; ?></td>
            <td><?= $data['harga_barang']; ?></td>
            <td><?= $data['tanggal_masuk']; ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>
