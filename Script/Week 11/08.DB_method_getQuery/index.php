<?php
require 'DB.php';
$DB = DB::getInstance();

// tampilkan semua tabel barang
$tabelBarang = $DB->getQuery('SELECT * FROM barang WHERE id_barang = ?',[2]);

echo "<pre>";
print_r($tabelBarang);
echo "</pre>";
