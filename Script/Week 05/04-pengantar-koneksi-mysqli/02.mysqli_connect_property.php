<?php
// Membuat koneksi ke server MySQL.
$databaseMysqli = new mysqli("localhost", "root", "root");

// Jumlah baris yang terpengaruh oleh query terakhir.
echo $databaseMysqli->affected_rows;  echo "<br>";
// Informasi client MySQLi yang digunakan PHP.
echo $databaseMysqli->client_info;    echo "<br>";
// Kode error koneksi; nilai 0 berarti tidak ada error.
echo $databaseMysqli->connect_errno;  echo "<br>";
// Informasi versi server MySQL.
echo $databaseMysqli->server_info;    echo "<br>";
