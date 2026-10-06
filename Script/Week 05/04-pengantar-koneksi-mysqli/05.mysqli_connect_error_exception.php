<?php
try {
  // Membuat koneksi ke server MySQL.
  $databaseMysqli = new mysqli("localhost", "root", "root");

  // Memeriksa kegagalan koneksi secara manual.
  if ($databaseMysqli->connect_error) {
    // Mengubah error koneksi menjadi exception agar ditangkap oleh catch.
    throw new Exception('Koneksi bermasalah (' . $databaseMysqli->connect_errno . ') '
            . $databaseMysqli->connect_error);
  }
  // Baris ini berjalan jika koneksi berhasil.
  echo "Jalankan query MySQL...";
}
catch (Exception $e) {
  // Menampilkan pesan exception ketika koneksi gagal.
  echo $e->getMessage();
}

