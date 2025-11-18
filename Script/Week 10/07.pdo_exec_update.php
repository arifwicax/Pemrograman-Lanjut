<?php
try {
  $pdo = new PDO("mysql:host=localhost;dbname=ilkoom", "root", "");
  $query = "UPDATE barang SET jumlah_barang = 100 WHERE id_barang = 3";
  $count = $pdo->exec($query);
  if ($count !== FALSE) {
    echo "Query Ok, ada $count baris yang di update";
  }
}
catch (\PDOException $e) {
  echo "Koneksi / Query bermasalah: ".$e->getMessage(). " (".$e->getCode().")";
}
finally {
  $pdo=NULL;
}
