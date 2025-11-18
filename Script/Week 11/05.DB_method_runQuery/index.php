<?php
require 'DB.php';
$DB = DB::getInstance();

$result = $DB->runQuery('SELECT * FROM barang');
$tabelBarang = $result->fetchAll(PDO::FETCH_OBJ);

echo "<pre>";
print_r($tabelBarang);
echo "</pre>";

// echo $tabelBarang[0]->id_barang." | ";
// echo $tabelBarang[0]->nama_barang." | ";
// echo $tabelBarang[0]->jumlah_barang." | ";
// echo $tabelBarang[0]->harga_barang." | ";
// echo $tabelBarang[0]->tanggal_update." | ";
