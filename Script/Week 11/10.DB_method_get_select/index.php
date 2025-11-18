<?php
require 'DB.php';
$DB = DB::getInstance();

// tampilkan tabel barang
$DB->select('nama_barang');
$tabelBarang = $DB->get('barang');

echo "<pre>";
print_r($tabelBarang);
echo "</pre>";
