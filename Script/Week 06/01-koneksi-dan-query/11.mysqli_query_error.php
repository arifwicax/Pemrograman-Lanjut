<?php
// Materi Week 06: Bagian 1: koneksi MySQLi Object, pembuatan database/tabel, query dasar, dan penanganan error.
// Script ini mendemonstrasikan: mysqli query error.
// Ikuti alur kode dari atas ke bawah: siapkan koneksi, jalankan operasi,
// proses hasil jika ada, lalu bebaskan resource dan tutup koneksi.
mysqli_report(MYSQLI_REPORT_STRICT);

try {
  $databaseMysqli = new mysqli("localhost", "root", "");
  $perintahSql = "CREAT DATABASE IF NOT EXISTS kampus_lanjut";
  $databaseMysqli->query($perintahSql);
  echo "Pesan error MySQL: ".$databaseMysqli->error;
  echo "<br><br>";
  echo "Nomor error MySQL: ".$databaseMysqli->errno;
}
catch (mysqli_sql_exception $e) {
  echo "Koneksi bermasalah: ".$e->getMessage(). " (".$e->getCode().")";
}
finally {
  if (isset($databaseMysqli)) {
    $databaseMysqli->close();
  }
}
