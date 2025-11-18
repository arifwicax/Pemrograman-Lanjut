<?php
try {
  $pdo = new PDO("mysql:host=localhost;dbname=ilkoom", "root", "");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $query = "UPDATE barang SET jumlah_barang = 99";
  $stmt = $pdo->query($query);
  if ($stmt !== FALSE) {
    echo "Query Ok, ada ".$stmt->rowCount()." baris yang di update";
  }
  $stmt = NULL;
}
catch (\PDOException $e) {
  echo "Koneksi / Query bermasalah: ".$e->getMessage(). " (".$e->getCode().")";
}
finally {
  $pdo=NULL;
}
