<?php
require 'DB.php';
$DB = DB::getInstance();

$tabelBarang = $DB->getWhereOnce('barang',['id_barang','=',5]);

echo $tabelBarang->nama_barang;

