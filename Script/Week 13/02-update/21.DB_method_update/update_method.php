<?php
require 'DB.php';
$DB = DB::getInstance();

$DB->update('inventaris',
            ['nama_inventaris' => 'Smartphone iPhone XR',
             'biaya_inventaris' => 17999000],
            ['id_inventaris','=',7]);

// tampilkan semua tabel inventaris
$tabelBarang = $DB->getWhere('inventaris',['id_inventaris','=',7]);

echo "<pre>";
print_r($tabelBarang);
echo "</pre>";
