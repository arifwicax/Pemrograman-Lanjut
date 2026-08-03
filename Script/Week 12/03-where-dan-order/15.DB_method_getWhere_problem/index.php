<?php
require 'DB.php';
$DB = DB::getInstance();

$tabelBarang = $DB->getWhere('inventaris',['id_inventaris','=',5]);

echo $tabelBarang->nama_inventaris;
//echo $tabelBarang[0]->nama_inventaris;
