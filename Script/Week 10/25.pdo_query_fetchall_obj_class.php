<?php
class MyClass{}
try {
  $pdo = new PDO("mysql:host=localhost;dbname=ilkoom", "root", "");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $query = "SELECT * FROM barang";
  $stmt = $pdo->query($query);

  $arr = $stmt->fetchAll(PDO::FETCH_CLASS,"MyClass");
  echo "<pre>";
  print_r($arr);
  echo "</pre>";

  echo $arr[2]->nama_barang;

  $stmt = NULL;
}
catch (\PDOException $e) {
  echo "Koneksi / Query bermasalah: ".$e->getMessage(). " (".$e->getCode().")";
}
finally {
  $pdo=NULL;
}
