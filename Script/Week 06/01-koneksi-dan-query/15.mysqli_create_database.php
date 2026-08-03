<?php
mysqli_report(MYSQLI_REPORT_STRICT);

try {
  $databaseMysqli = new mysqli("localhost", "root", "");

  // Buat database "kampus_lanjut" (jika belum ada)
  $perintahSql = "CREATE DATABASE IF NOT EXISTS kampus_lanjut";
  $databaseMysqli->query($perintahSql);
  if ($databaseMysqli->error){
    throw new Exception($databaseMysqli->error, $databaseMysqli->errno);
  }
  else {
    echo "Database 'kampus_lanjut' berhasil di buat / sudah tersedia <br>";
  };
}
catch (Exception $e) {
  echo "Koneksi / Query bermasalah: ".$e->getMessage(). " (".$e->getCode().")";
}
finally {
  if (isset($databaseMysqli)) {
    $databaseMysqli->close();
  }
}
