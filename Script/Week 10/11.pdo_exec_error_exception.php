<?php
try {
  $pdo = new PDO("mysql:host=localhost;dbname=ilkoom", "root", "");
  $query = "DELET FROM barang WHERE id_barang = 3";
  $count = $pdo->exec($query);

  if ($count !== FALSE) {
    echo "Query Ok, ada $count baris yang dihapus";
  }
  else {
    throw new Exception($pdo->errorInfo()[2], $pdo->errorInfo()[1]);
  }
}
catch (\Exception $e) {
  echo "Koneksi / Query bermasalah: ".$e->getMessage(). " (".$e->getCode().")";
}
finally {
  $pdo=NULL;
}
