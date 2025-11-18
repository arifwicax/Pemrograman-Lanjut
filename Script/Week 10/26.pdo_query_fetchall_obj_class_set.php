<?php
class IlkoomBarang{
  public $nama_toko = "Ilkoom Store";
  public function __set($name, $value) {
    $this->$name = strtoupper($value);
  }
}
try {
  $pdo = new PDO("mysql:host=localhost;dbname=ilkoom", "root", "");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $query = "SELECT * FROM barang";
  $stmt = $pdo->query($query);

  $arr = $stmt->fetchAll(PDO::FETCH_CLASS,"IlkoomBarang");
  echo "<pre>";
  print_r($arr);
  echo "</pre>";

  $stmt = NULL;
}
catch (\PDOException $e) {
  echo "Koneksi / Query bermasalah: ".$e->getMessage(). " (".$e->getCode().")";
}
finally {
  $pdo=NULL;
}
