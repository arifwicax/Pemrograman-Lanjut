<?php
require 'DB.php';
$DB = DB::getInstance();

$hasil = $DB->delete('inventaris',['id_inventaris','=',4]);

if($hasil) {
  echo "Terdapat ".$DB->count()." data yang dihapus"; 
  // Terdapat 1 data yang dihapus
}