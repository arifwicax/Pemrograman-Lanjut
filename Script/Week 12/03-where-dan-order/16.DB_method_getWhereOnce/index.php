<?php
require 'DB.php';
$DB = DB::getInstance();

$tabelBarang = $DB->getWhereOnce('inventaris',['id_inventaris','=',5]);

echo $tabelBarang->nama_inventaris;

