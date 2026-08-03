<?php
require 'DB.php';
$DB = DB::getInstance();

$perintahSql = 'INSERT INTO inventaris (nama_inventaris, jumlah_inventaris, biaya_inventaris) 
          VALUES (?,?,?)';
$arr = ['Cosmos CRJ-8229 - Rice Cooker',4,299000];

// jalankan proses insert
$DB->runQuery($perintahSql,$arr);

// tampilkan semua tabel inventaris
$hasil = $DB->runQuery('SELECT * FROM inventaris');
$tabelBarang = $hasil->fetchAll(PDO::FETCH_OBJ);

echo "<pre>";
print_r($tabelBarang);
echo "</pre>";