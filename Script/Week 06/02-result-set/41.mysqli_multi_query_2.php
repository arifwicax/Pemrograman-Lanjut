<?php
mysqli_report(MYSQLI_REPORT_STRICT);

try {
  $databaseMysqli = new mysqli("localhost", "root", "","kampus_lanjut");

  // Generate tanggal hari ini
  $sekarang = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
  $waktuCatat = $sekarang->format("Y-m-d H:i:s");

  // Jalankan 3bh query
  $perintahSql = "INSERT INTO inventaris
    (nama_inventaris, jumlah_inventaris, biaya_inventaris, waktu_pembaruan)
    VALUES ('Hardisk Eksternal WD My Passport 2TB',9,1120000,'$waktuCatat');
    UPDATE inventaris SET jumlah_inventaris = 5, waktu_pembaruan = '$waktuCatat'
    WHERE id_inventaris=3;
    UPDATE inventaris SET biaya_inventaris = 4500000, waktu_pembaruan = '$waktuCatat'
    WHERE id_inventaris=5";

  $databaseMysqli->multi_query($perintahSql);
  echo "Terdapat ".$databaseMysqli->affected_rows." baris yang ditambah <br>";

  // Proses sinkronisasi dengan MySQL (akibat $databaseMysqli->multi_query)
  while( $databaseMysqli->more_results())
  {
    $databaseMysqli->next_result();
  }

  // Ambil semua data di tabel inventaris
  $perintahSql = "SELECT * FROM inventaris";
  $hasil = $databaseMysqli->query($perintahSql);
  if ($databaseMysqli->error){
    throw new Exception($databaseMysqli->error, $databaseMysqli->errno);
  }
  else {
    $arr = $hasil->fetch_all(MYSQLI_ASSOC);
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
