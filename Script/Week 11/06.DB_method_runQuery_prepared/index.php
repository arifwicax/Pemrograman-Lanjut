<?php
require 'DB.php';
$DB = DB::getInstance();

$query = 'SELECT * FROM barang WHERE id_barang = ?';
$arr = [4];

$result = $DB->runQuery($query,$arr);
// $result = $DB->runQuery('SELECT * FROM barang WHERE id_barang = ?',[4]);
$tabelBarang = $result->fetchAll(PDO::FETCH_OBJ);

echo "<pre>";
print_r($tabelBarang);
echo "</pre>";
