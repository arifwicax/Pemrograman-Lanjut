<?php
require 'DB.php';
$DB = DB::getInstance();

// $tabelBarang = $DB->get('barang','WHERE id_barang = ?',[2]);
// $tabelBarang = $DB->get('barang');

$DB->select('harga_barang, nama_barang');
$DB->orderBy('harga_barang','DESC');
$tabelBarang = $DB->get('barang','WHERE harga_barang > ?',[5000000]);

echo "<pre>";
print_r($tabelBarang);
echo "</pre>";
