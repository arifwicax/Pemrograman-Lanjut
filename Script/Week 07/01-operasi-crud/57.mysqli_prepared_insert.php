<?php
mysqli_report(MYSQLI_REPORT_STRICT);

try {
  $databaseMysqli = new mysqli("localhost", "root", "","kampus_lanjut");

  // Buat format tanggal hari ini
  $sekarang = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
  $waktuCatat = $sekarang->format("Y-m-d H:i:s");

  // Buat prepared statement untuk input data inventaris
  $pernyataan = $databaseMysqli->prepare("INSERT INTO inventaris (nama_inventaris,
  jumlah_inventaris, biaya_inventaris, waktu_pembaruan) VALUES (?,?,?,?)");

  // Proses bind
  $pernyataan->bind_param("siis", $nama_inventaris, $jumlah_inventaris,
                     $biaya_inventaris, $waktu_pembaruan);

  $nama_inventaris = "SagaraElektronik Microwave Oven R-728(K)";
  $jumlah_inventaris = 20;
  $biaya_inventaris = 1250500;
  $waktu_pembaruan = $waktuCatat;  

  // Proses execute
  $pernyataan->execute();
  echo "Terdapat ".$databaseMysqli->affected_rows." baris yang ditambah <br>";

  $pernyataan->close();
}
catch (Exception $e) {
  echo "Koneksi / Query bermasalah: ".$e->getMessage(). " (".$e->getCode().")";
}
finally {
  if (isset($databaseMysqli)) {
    $databaseMysqli->close();
  }
}
