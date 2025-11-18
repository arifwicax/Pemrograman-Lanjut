<?php
require 'DB.php';
$DB = DB::getInstance();

$tabelBarang = $DB->getLike('barang','nama_barang','%kulkas%');
// $tabelBarang = $DB->select('nama_barang,id_barang')
//                   ->getLike('barang','nama_barang','%k%');

echo "<pre>";
print_r($tabelBarang);
echo "</pre>";
