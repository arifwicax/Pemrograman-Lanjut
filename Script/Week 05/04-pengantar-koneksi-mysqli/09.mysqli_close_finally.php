<?php
// Mengaktifkan mode strict agar error MySQLi dilempar sebagai exception.
mysqli_report(MYSQLI_REPORT_STRICT);

try {
  // Membuat koneksi; password kosong harus disesuaikan dengan konfigurasi lokal.
  $databaseMysqli = new mysqli("localhost", "root", "");
}
catch (mysqli_sql_exception $e) {
  // Menampilkan pesan apabila koneksi gagal.
  echo "Koneksi bermasalah: ".$e->getMessage(). " (".$e->getCode().")";
}
finally {
  // finally selalu dijalankan, baik koneksi berhasil maupun gagal.
  if (isset($databaseMysqli)) {
    // Menutup koneksi hanya jika object koneksi sudah berhasil dibuat.
    $databaseMysqli->close();
  }
}
