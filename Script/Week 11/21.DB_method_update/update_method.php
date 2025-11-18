<?php
require 'DB.php';
$DB = DB::getInstance();

$DB->update('barang',
            ['nama_barang' => 'Smartphone iPhone XR',
             'harga_barang' => 17999000],
            ['id_barang','=',5]);

// tampilkan semua tabel barang
$tabelBarang = $DB->getWhere('barang',['id_barang','=',5]);

echo "<pre>";
print_r($tabelBarang);
echo "</pre>";
