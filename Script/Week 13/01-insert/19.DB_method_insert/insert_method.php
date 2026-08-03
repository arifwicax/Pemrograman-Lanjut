<?php
require 'DB.php';
$DB = DB::getInstance();

$DB->insert('inventaris',[
            'nama_inventaris' => 'Sungsang S24',
            'jumlah_inventaris' => 10,
            'biaya_inventaris' => 25000000
          ]);

// tampilkan semua tabel inventaris
$tabelBarang = $DB->get('inventaris');

echo "<pre>";
print_r($tabelBarang);
echo "</pre>";
