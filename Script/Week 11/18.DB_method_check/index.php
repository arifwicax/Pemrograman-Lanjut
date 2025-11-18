<?php
require 'DB.php';
$DB = DB::getInstance();

// $result = $DB->check('barang','id_barang','4');
// echo $result;

// $result = $DB->check('barang','id_barang','10');
// echo $result;

if ($DB->check('barang','id_barang','4')) {
  echo "ID barang 4 tersedia";
}
