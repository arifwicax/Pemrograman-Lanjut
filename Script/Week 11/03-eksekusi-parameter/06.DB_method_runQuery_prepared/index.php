<?php
require 'DB.php';
$DB = DB::getInstance();

$perintahSql = 'SELECT * FROM inventaris WHERE id_inventaris = ?';
$arr = [4];

$hasil = $DB->runQuery($perintahSql,$arr);
// $hasil = $DB->runQuery('SELECT * FROM inventaris WHERE id_inventaris = ?',[4]);
$tabelBarang = $hasil->fetchAll(PDO::FETCH_OBJ);

echo "<pre>";
print_r($tabelBarang);
echo "</pre>";
