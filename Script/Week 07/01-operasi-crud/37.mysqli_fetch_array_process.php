<?php
mysqli_report(MYSQLI_REPORT_STRICT);

try {
  $databaseMysqli = new mysqli("localhost", "root", "","kampus_lanjut");

  // Ambil semua data di tabel inventaris
  $perintahSql = "SELECT * FROM inventaris";
  $hasil = $databaseMysqli->query($perintahSql);

  $i=0;
  while ($baris = $hasil->fetch_array(MYSQLI_ASSOC)){
    $arr[$i]['id_inventaris'] = $baris['id_inventaris'];
    $arr[$i]['nama_inventaris'] = $baris['nama_inventaris'];
    $arr[$i]['jumlah_inventaris'] = $baris['jumlah_inventaris'];
    $arr[$i]['biaya_inventaris'] = number_format($baris['biaya_inventaris'], 0, ',', '.');

    $tanggal = new DateTime($baris['waktu_pembaruan']);
    $arr[$i]['waktu_pembaruan']= $tanggal->format("d-m-Y H:i");
    $i++;
  }
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
    <td><?php echo $val['biaya_inventaris']; ?></td>
    <td><?php echo $val['waktu_pembaruan']; ?></td>
  </tr>
  <?php } ?>
</table>
</body>
</html>
