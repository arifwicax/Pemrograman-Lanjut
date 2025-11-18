<?php
require 'DB.php';
$DB = DB::getInstance();

$DB->insert('barang',[
            'nama_barang' => 'Philips Blender HR 2157',
            'jumlah_barang' => 11,
            'harga_barang' => 629000
          ]);

// tampilkan semua tabel barang
$tabelBarang = $DB->get('barang');

echo "<pre>";
print_r($tabelBarang);
echo "</pre>";
