<?php
// Membuat object koneksi MySQLi dengan host, username, dan password.
$databaseMysqli = new mysqli("localhost", "root", "root");

// Menampilkan isi object koneksi untuk melihat informasi koneksi.
echo "<pre>";
print_r($databaseMysqli);
echo "</pre>";
