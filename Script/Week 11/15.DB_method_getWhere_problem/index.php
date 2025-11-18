<?php
require 'DB.php';
$DB = DB::getInstance();

$tabelBarang = $DB->getWhere('barang',['id_barang','=',5]);

echo $tabelBarang->nama_barang;
//echo $tabelBarang[0]->nama_barang;
