<?php
require 'DB.php';
$DB = DB::getInstance();

$hasil = $DB->runQuery('SELECT * FROM inventaris');
$tabelBarang = $hasil->fetchAll(PDO::FETCH_OBJ);

// echo "<pre>";
// print_r($tabelBarang);
// echo "</pre>";

echo $tabelBarang[0]->id_inventaris." | ";
echo $tabelBarang[0]->nama_inventaris." | ";
echo $tabelBarang[0]->jumlah_inventaris." | ";
echo $tabelBarang[0]->biaya_inventaris." | ";
echo $tabelBarang[0]->waktu_pembaruan." | ";
