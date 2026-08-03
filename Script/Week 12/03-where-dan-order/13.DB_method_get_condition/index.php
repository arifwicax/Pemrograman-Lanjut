<?php
require 'DB.php';
$DB = DB::getInstance();

// $tabelBarang = $DB->get('inventaris','WHERE id_inventaris = ?',[2]);
// $tabelBarang = $DB->get('inventaris');

$DB->select('biaya_inventaris, nama_inventaris');
$DB->orderBy('biaya_inventaris','DESC');
$tabelBarang = $DB->get('inventaris','WHERE biaya_inventaris > ?',[5000000]);

echo "<pre>";
print_r($tabelBarang);
echo "</pre>";

echo $tabelBarang[0]->biaya_inventaris;
echo "<br>";
echo $tabelBarang[0]->nama_inventaris;