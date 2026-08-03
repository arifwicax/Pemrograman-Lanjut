<?php
require 'DB.php';
$DB = DB::getInstance();

$hasil = $DB->delete('inventaris',['id_inventaris','<',5]);

if($hasil) {
  echo "Terdapat ".$DB->count()." data yang dihapus";
  // Terdapat 4 data yang dihapus
}
