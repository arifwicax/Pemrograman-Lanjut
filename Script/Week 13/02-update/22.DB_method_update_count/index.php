<?php
require 'DB.php';
$DB = DB::getInstance();

$hasil = $DB->update('inventaris',
                     ['nama_inventaris' => 'Dummy Product',
                      'biaya_inventaris' => 999999],
                     ['id_inventaris','>',3]);

if($hasil) {
  echo "Terdapat ".$DB->count()." data yang diubah";
  // Terdapat 0 data yang diubah
}
