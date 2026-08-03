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
}
catch (Exception $e) {
  echo "Koneksi / Query bermasalah: ".$e->getMessage(). " (".$e->getCode().")";
}
finally {
  if (isset($databaseMysqli)) {
    $databaseMysqli->close();
  }
}
