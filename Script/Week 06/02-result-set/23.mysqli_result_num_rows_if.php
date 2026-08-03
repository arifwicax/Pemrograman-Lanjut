<?php
mysqli_report(MYSQLI_REPORT_STRICT);

try {
  $databaseMysqli = new mysqli("localhost", "root", "root","kampus_lanjut");
  
  // Tampilkan data dari tabel inventaris
  $perintahSql = "SELECT * FROM inventaris WHERE id_inventaris = 100";
  $hasil = $databaseMysqli->query($perintahSql);
  
  if ($hasil->num_rows === 0) {
    echo "Data tidak ditemukan";
  }
  else {
    echo "Data tersedia";
  }

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