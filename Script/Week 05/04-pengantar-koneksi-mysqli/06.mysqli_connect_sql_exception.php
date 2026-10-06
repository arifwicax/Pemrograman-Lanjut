<?php
// Mengubah error MySQLi menjadi mysqli_sql_exception secara otomatis.
mysqli_report(MYSQLI_REPORT_STRICT);

try {
  // Password x digunakan untuk menguji penanganan exception koneksi.
  $databaseMysqli = new mysqli("localhost", "root", "x");
  // Kode ini hanya dijalankan jika koneksi berhasil.
  echo "Jalankan query MySQL...";
}
catch (mysqli_sql_exception $e) {
  // Menangkap exception khusus dari operasi MySQLi.
  echo "Koneksi bermasalah: ".$e->getMessage(). " (".$e->getCode().")";
}
