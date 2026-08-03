<?php
try {
  $databasePdo = new PDO("mysql:host=localhost;dbname=kampus_lanjut", "root", "");
  $databasePdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $perintahSql = "SELECT nama_inventaris,biaya_inventaris FROM inventaris";
  $pernyataan = $databasePdo->query($perintahSql);

  $arr = $pernyataan->fetchAll(PDO::FETCH_KEY_PAIR);

  echo "<pre>";
  print_r($arr);
  echo "</pre>";

  echo $arr["TV NusaTech 43NU7090 4K"]."<br>";
  echo $arr["Kulkas LenteraTech GC-A432HLHU"]."<br>";
  echo $arr["Printer Epson L220"]."<br>";

  $pernyataan = NULL;
}
catch (\PDOException $e) {
  echo "Koneksi / Query bermasalah: ".$e->getMessage(). " (".$e->getCode().")";
}
finally {
  $databasePdo=NULL;
}
