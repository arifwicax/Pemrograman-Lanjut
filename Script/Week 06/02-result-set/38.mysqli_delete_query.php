<?php
mysqli_report(MYSQLI_REPORT_STRICT);

try {
  $databaseMysqli = new mysqli("localhost", "root", "","kampus_lanjut");
  
  // Tampilkan semua data di tabel inventaris
  $perintahSql = "DELETE FROM inventaris WHERE id_inventaris = 1";
  $databaseMysqli->query($perintahSql);
  echo "Terdapat ".$databaseMysqli->affected_rows." baris yang telah dihapus";
}
catch (Exception $e) {
  echo "Koneksi / Query bermasalah: ".$e->getMessage(). " (".$e->getCode().")";
}
finally {
  if (isset($databaseMysqli)) {
    $databaseMysqli->close();
  }
}