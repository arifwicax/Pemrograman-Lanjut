<?php
require 'DB.php';
$DB = DB::getInstance();

// $tabelBarang = $DB->getWhere('inventaris',['id_inventaris','=',5]);

$tabelBarang = $DB->select('nama_inventaris,jumlah_inventaris')->getWhere('inventaris',['id_inventaris','=',5]);

echo "<pre>";
print_r($tabelBarang);
echo "</pre>";
