<?php
// Mengaktifkan mode strict agar kegagalan koneksi menjadi exception.
mysqli_report(MYSQLI_REPORT_STRICT);

try {
  // Password kosong; sesuaikan dengan konfigurasi MySQL lokal.
  $databaseMysqli = new mysqli("localhost", "root", "");
  // Pesan ini tampil apabila koneksi berhasil.
  echo "Jalankan query MySQL...";
}
catch (mysqli_sql_exception $e) {
  // Menangani kegagalan koneksi tanpa menghentikan script secara mendadak.
  echo "Koneksi bermasalah: ".$e->getMessage(). " (".$e->getCode().")";
}
