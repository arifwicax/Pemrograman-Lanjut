<?php
// Materi Week 06: Bagian 4: prepared statement, parameter binding, SELECT, INSERT, LIKE, dan pengambilan hasil.
// Script ini mendemonstrasikan: mysqli prepared fetch.
// Ikuti alur kode dari atas ke bawah: siapkan koneksi, jalankan operasi,
// proses hasil jika ada, lalu bebaskan resource dan tutup koneksi.
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
  $pernyataan->bind_result($bilangan, $pembagi, $c, $d, $e);
  $pernyataan->fetch();

  echo $bilangan." | ". $pembagi." | ". $c." | ". $d." | ". $e;

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
