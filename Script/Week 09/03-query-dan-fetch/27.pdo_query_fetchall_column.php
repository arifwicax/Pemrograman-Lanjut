<?php
try {
  $databasePdo = new PDO("mysql:host=localhost;dbname=kampus_lanjut", "root", "");
  $databasePdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $perintahSql = "SELECT biaya_inventaris FROM inventaris";
  $pernyataan = $databasePdo->query($perintahSql);

  $arr = $pernyataan->fetchAll(PDO::FETCH_COLUMN);
  // $arr = $pernyataan->fetchAll(PDO::FETCH_COLUMN | PDO::FETCH_UNIQUE);
  echo "<pre>";
  print_r($arr);
  echo "</pre>";

  echo $arr[2];

  $pernyataan = NULL;
}
catch (\PDOException $e) {
  echo "Koneksi / Query bermasalah: ".$e->getMessage(). " (".$e->getCode().")";
}
finally {
  $databasePdo=NULL;
}
