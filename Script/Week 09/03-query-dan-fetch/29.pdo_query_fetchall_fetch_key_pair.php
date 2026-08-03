<?php
try {
  $databasePdo = new PDO("mysql:host=localhost;dbname=kampus_lanjut", "root", "");
  $databasePdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $perintahSql = "SELECT id_inventaris,biaya_inventaris FROM inventaris";
  $pernyataan = $databasePdo->query($perintahSql);

  $arr = $pernyataan->fetchAll(PDO::FETCH_KEY_PAIR);
  echo "<pre>";
  print_r($arr);
  echo "</pre>";

  echo $arr[3];

  $pernyataan = NULL;
}
catch (\PDOException $e) {
  echo "Koneksi / Query bermasalah: ".$e->getMessage(). " (".$e->getCode().")";
}
finally {
  $databasePdo=NULL;
}
