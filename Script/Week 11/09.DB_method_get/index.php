<?php
require 'DB.php';
$DB = DB::getInstance();

// tampilkan semua tabel barang
$tabelBarang = $DB->get('barang');

echo "<pre>";
print_r($tabelBarang);
echo "</pre>";
