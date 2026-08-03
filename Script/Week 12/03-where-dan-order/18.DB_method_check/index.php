<?php
require 'DB.php';
$DB = DB::getInstance();

// $hasil = $DB->check('inventaris','id_inventaris','4');
// echo $hasil;

// $hasil = $DB->check('inventaris','id_inventaris','10');
// echo $hasil;

if ($DB->check('inventaris','id_inventaris','4')) {
  echo "ID inventaris 4 tersedia";
}
