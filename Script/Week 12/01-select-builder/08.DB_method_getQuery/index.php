<?php
require 'DB.php';
$DB = DB::getInstance();

// Tampilkan semua data dari tabel inventaris dengan filter `id_inventaris = 2`
$tabelBarang = $DB->getQuery('SELECT * FROM inventaris WHERE id_inventaris = ?', [2]);

echo "<pre>";
print_r($tabelBarang);
echo "</pre>";

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Barang</title>
</head>
<body>
    <h1>Data Barang</h1>
    
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>ID Barang</th>
            <th>Nama Barang</th>
            <th>Jumlah Barang</th>
            <th>Harga Barang</th>
            <th>Tanggal Update</th>
        </tr>
        
        <?php foreach ($tabelBarang as $inventaris): ?>
        <tr>
            <td><?php echo htmlspecialchars($inventaris->id_inventaris); ?></td>
            <td><?php echo htmlspecialchars($inventaris->nama_inventaris); ?></td>
            <td><?php echo htmlspecialchars($inventaris->jumlah_inventaris); ?></td>
            <td><?php echo 'Rp ' . number_format($inventaris->biaya_inventaris, 0, ',', '.'); ?></td>
            <td><?php echo htmlspecialchars($inventaris->waktu_pembaruan); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
