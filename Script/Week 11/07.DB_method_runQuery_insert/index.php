<?php
require 'DB.php';
$DB = DB::getInstance();

$query = 'INSERT INTO barang (nama_barang, jumlah_barang, harga_barang) 
          VALUES (?,?,?)';
$arr = ['Cosmos CRJ-8229 - Rice Cooker',4,299000];

// jalankan proses insert
$DB->runQuery($query,$arr);

// tampilkan semua tabel barang
$result = $DB->runQuery('SELECT * FROM barang');
$tabelBarang = $result->fetchAll(PDO::FETCH_OBJ);

echo "<pre>";
print_r($tabelBarang);
echo "</pre>";