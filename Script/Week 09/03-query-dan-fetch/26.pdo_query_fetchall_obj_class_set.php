<?php
class kampus_lanjutBarang{
  public $nama_toko = "kampus_lanjut Store";
  public function __set($name, $nilai) {
    $this->$name = strtoupper($nilai);
  }
}
try {
  $databasePdo = new PDO("mysql:host=localhost;dbname=kampus_lanjut", "root", "");
  $databasePdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $perintahSql = "SELECT * FROM inventaris";
  $pernyataan = $databasePdo->query($perintahSql);

  $arr = $pernyataan->fetchAll(PDO::FETCH_CLASS,"kampus_lanjutBarang");
  echo "<pre>";
  print_r($arr);
  echo "</pre>";

  $pernyataan = NULL;
}
catch (\PDOException $e) {
  echo "Koneksi / Query bermasalah: ".$e->getMessage(). " (".$e->getCode().")";
}
finally {
  $databasePdo=NULL;
}
