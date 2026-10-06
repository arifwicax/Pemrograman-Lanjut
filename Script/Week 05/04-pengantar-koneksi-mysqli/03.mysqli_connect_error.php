<?php
// Mencoba membuat koneksi ke server MySQL.
$databaseMysqli = new mysqli("localhost", "root", "root");
// connect_errno berisi kode error dan connect_error berisi pesannya.
echo $databaseMysqli->connect_errno," - ", $databaseMysqli->connect_error;
