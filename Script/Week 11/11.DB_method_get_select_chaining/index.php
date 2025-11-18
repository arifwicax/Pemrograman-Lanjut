<?php
require 'DB.php';
$DB = DB::getInstance();

// tampilkan tabel barang
$tabelBarang = $DB->select('nama_barang')->get('barang');
$tabelBarang = $DB->select('harga_barang, nama_barang')->get('barang');

echo "<pre>";
print_r($tabelBarang);
echo "</pre>";
