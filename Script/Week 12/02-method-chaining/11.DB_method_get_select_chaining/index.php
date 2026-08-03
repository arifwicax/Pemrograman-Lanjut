<?php
require 'DB.php';
$DB = DB::getInstance();

// tampilkan tabel inventaris
$tabelBarang = $DB->select('nama_inventaris')->get('inventaris');
$tabelBarang = $DB->select('biaya_inventaris, nama_inventaris')->get('inventaris');

echo "<pre>";
print_r($tabelBarang);
echo "</pre>";
