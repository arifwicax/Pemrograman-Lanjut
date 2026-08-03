<?php
mysqli_report(MYSQLI_REPORT_STRICT);

try {
  $databaseMysqli = new mysqli("localhost", "root", "","kampus_lanjut");

  // Ambil semua data di tabel inventaris
  $perintahSql = "SELECT * FROM inventaris";
  $hasil = $databaseMysqli->query($perintahSql);
  $arr = $hasil->fetch_all(MYSQLI_ASSOC);
  $hasil->free();
}
catch (Exception $e) {
  echo "Koneksi / Query bermasalah: ".$e->getMessage(). " (".$e->getCode().")";
}
finally {
  if (isset($databaseMysqli)) {
    $databaseMysqli->close();
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Menampilkan Tabel MySQL</title>
  <style>
    table {
      border-collapse: collapse;
      margin: 0 auto;
    }
    td, th {
      border-bottom: 1px solid black;
    }
    th,td {
      padding: 10px 15px;
    }
    tr:nth-child(even) {background-color: #f2f2f2;}
  </style>
</head>
<body>
<table>
  <tr>
    <th>ID</th>
    <th>Nama</th>
    <th>Stok</th>
    <th>Harga</th>
    <th>Update</th>
  </tr>
  <?php foreach ($arr as $key => $val) {?>
  <tr>
    <td><?php echo $val['id_inventaris']; ?></td>
    <td><?php echo $val['nama_inventaris']; ?></td>
    <td><?php echo $val['jumlah_inventaris']; ?></td>
    <td><?php echo number_format($val['biaya_inventaris'], 0, ',', '.'); ?></td>
    <td><?php $tanggal = new DateTime($val['waktu_pembaruan']);
              echo $tanggal->format("d-m-Y H:i"); ?></td>
  </tr>
  <?php } ?>
</table>
</body>
</html>
