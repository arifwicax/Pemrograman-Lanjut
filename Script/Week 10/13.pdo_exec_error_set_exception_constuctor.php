<?php
try {
  $pdo = new PDO("mysql:host=localhost;dbname=ilkoom", "root", "",
                 [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

  $query = "DELET FROM barang WHERE id_barang = 3";
  $count = $pdo->exec($query);

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
