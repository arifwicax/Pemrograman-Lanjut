<?php
mysqli_report(MYSQLI_REPORT_STRICT);

try {
  $databaseMysqli = new mysqli("localhost", "root", "","kampus_lanjut");

  // Buat prepared statement untuk ambil data inventaris
  $pernyataan = $databaseMysqli->prepare("SELECT * FROM inventaris WHERE id_inventaris = ?");

  // Proses bind
  $pernyataan->bind_param("i", $id_inventaris);
  $id_inventaris = 5;

  // Proses execute
  $pernyataan->execute();

  // Proses menampilkan hasil query
  $pernyataan->bind_result($id_inventaris, $nama_inventaris, $jumlah_inventaris,
                     $biaya_inventaris, $waktu_pembaruan);
  $pernyataan->fetch();

  echo $id_inventaris;       echo " | ";
  echo $nama_inventaris;     echo " | ";
  echo $jumlah_inventaris;   echo " | ";
  echo $biaya_inventaris;    echo " | ";
  echo $waktu_pembaruan;

  $pernyataan->free_result();
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
