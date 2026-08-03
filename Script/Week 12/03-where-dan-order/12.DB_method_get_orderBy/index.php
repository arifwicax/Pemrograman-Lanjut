<?php
require 'DB.php';
$DB = DB::getInstance();

// tampilkan semua tabel inventaris
$DB->select('id_inventaris,nama_inventaris');
$DB->orderBy('id_inventaris','DESC');
$tabelBarang = $DB->get('inventaris');

$tabelBarang = $DB->select('biaya_inventaris, nama_inventaris')->orderBy('biaya_inventaris')->get('inventaris');

echo "<pre>";
print_r($tabelBarang);
echo "</pre>";
