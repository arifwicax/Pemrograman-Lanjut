<?php
try {
  $pdo = new PDO("mysql:host=localhost;dbname=ilkoom", "root", "");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $query = "SELECT id_barang,harga_barang FROM barang";
  $stmt = $pdo->query($query);

  $arr = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
  echo "<pre>";
  print_r($arr);
  echo "</pre>";

  echo $arr[3];

  $stmt = NULL;
}
catch (\PDOException $e) {
  echo "Koneksi / Query bermasalah: ".$e->getMessage(). " (".$e->getCode().")";
}
finally {
  $pdo=NULL;
}
