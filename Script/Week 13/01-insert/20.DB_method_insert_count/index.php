<?php
require 'DB.php';
$DB = DB::getInstance();

$hasil = $DB->insert('inventaris',[
  'nama_inventaris' => 'Mouse Gaming Razer Basilisk',
  'jumlah_inventaris' => 25,
  'biaya_inventaris' => 1250000
]);

if($hasil) {
  echo "Terdapat ".$DB->count()." data yang ditambah"; 
  // Terdapat 1 data yang ditambah
}