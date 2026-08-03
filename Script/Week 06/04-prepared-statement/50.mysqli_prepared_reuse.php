<?php
mysqli_report(MYSQLI_REPORT_STRICT);

try {
  $databaseMysqli = new mysqli("localhost", "root", "","kampus_lanjut");

  // Buat prepared statement untuk ambil data inventaris
  $perintahSql = "SELECT * FROM inventaris WHERE id_inventaris = ?";
  $pernyataan = $databaseMysqli->prepare($perintahSql);

  // Proses bind
  $pernyataan->bind_param("i", $id_inventaris);

  // Input data 1
  $id_inventaris = 2;
  $pernyataan->execute();
  $hasil = $pernyataan->get_result();
  $baris = $hasil->fetch_row();
  echo $baris[0]." | ".$baris[1]. " | ".$baris[2]. " | ".$baris[3]. " | ".$baris[4];
  $pernyataan->free_result();

  echo "<br>";

  // Input data 2
  $id_inventaris = 4;
  $pernyataan->execute();
  $hasil = $pernyataan->get_result();
  $baris = $hasil->fetch_row();
  echo $baris[0]." | ".$baris[1]. " | ".$baris[2]. " | ".$baris[3]. " | ".$baris[4];
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
