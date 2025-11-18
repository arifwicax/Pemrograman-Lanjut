<?php
require 'DB.php';
$DB = DB::getInstance();

$result = $DB->update('barang',
                     ['nama_barang' => 'Dummy Product',
                      'harga_barang' => 999999],
                     ['id_barang','>',3]);

if($result) {
  echo "Terdapat ".$DB->count()." data yang diubah";
  // Terdapat 0 data yang diubah
}
