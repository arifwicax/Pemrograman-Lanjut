<?php
try {
  $pdo = new PDO("mysql:host=localhost;dbname=ilkoom", "root", "");
  $query = "DELET FROM barang WHERE id_barang = 3";
  $count = $pdo->exec($query);

  echo "<pre>";
  var_dump($pdo->errorCode());
  var_dump($pdo->errorInfo());
  echo "</pre>";

  if ($count !== FALSE) {
    echo "Query Ok, ada $count baris yang dihapus";
  }
}
catch (\PDOException $e) {
  echo "Koneksi / Query bermasalah: ".$e->getMessage(). " (".$e->getCode().")";
}
finally {
  $pdo=NULL;
}