<?php
require 'DB.php';
$DB = DB::getInstance();

$result = $DB->delete('barang',['id_barang','=',4]);

if($result) {
  echo "Terdapat ".$DB->count()." data yang dihapus"; 
  // Terdapat 1 data yang dihapus
}