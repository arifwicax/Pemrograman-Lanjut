<?php
require 'DB.php';
$DB = DB::getInstance();

$tabelBarang = $DB->getWhere('barang',['id_barang','=',5]);

$tabelBarang = $DB->select('nama_barang,jumlah_barang')->getWhere('barang',['id_barang','=',5]);

echo "<pre>";
print_r($tabelBarang);
echo "</pre>";
