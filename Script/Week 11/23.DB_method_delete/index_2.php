<?php
require 'DB.php';
$DB = DB::getInstance();

$result = $DB->delete('barang',['id_barang','<',5]);

if($result) {
  echo "Terdapat ".$DB->count()." data yang dihapus";
  // Terdapat 4 data yang dihapus
}
