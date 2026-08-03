<?php
require 'DB.php';
$DB = DB::getInstance();

// tampilkan tabel inventaris
$DB->select('nama_inventaris');
$tabelBarang = $DB->get('inventaris');

echo "<pre>";
print_r($tabelBarang);
echo "</pre>";
