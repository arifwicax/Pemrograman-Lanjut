<?php
// Password x digunakan sebagai contoh koneksi yang mungkin gagal.
$databaseMysqli = new mysqli("localhost", "root", "x");

// Jika koneksi gagal, tampilkan pesan lalu hentikan seluruh script.
if ($databaseMysqli->connect_error) {
  die('Koneksi bermasalah (' . $databaseMysqli->connect_errno . ') '
          . $databaseMysqli->connect_error);
}

// Baris ini hanya dijalankan jika koneksi berhasil.
echo "Jalankan query MySQL...";
