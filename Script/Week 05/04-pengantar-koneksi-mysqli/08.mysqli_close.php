<?php
// Membuka koneksi ke server MySQL tanpa memilih database tertentu.
$databaseMysqli = new mysqli("localhost", "root", "");

// Tempat menjalankan perintah query MySQL.
// Contoh: $databaseMysqli->query("SHOW DATABASES");
// Query lain dapat ditulis pada bagian ini.

// Menutup koneksi setelah seluruh operasi database selesai.
$databaseMysqli->close();
