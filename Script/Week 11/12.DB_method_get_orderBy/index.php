<?php
require 'DB.php';
$DB = DB::getInstance();

// tampilkan semua tabel barang
$DB->select('id_barang,nama_barang');
$DB->orderBy('id_barang','DESC');
$tabelBarang = $DB->get('barang');

$tabelBarang = $DB->select('harga_barang, nama_barang')->orderBy('harga_barang')->get('barang');

echo "<pre>";
print_r($tabelBarang);
echo "</pre>";
