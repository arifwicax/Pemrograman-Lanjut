<?php
try {
  $databasePdo = new PDO("mysql:host=localhost;dbname=kampus_lanjut", "root", "");
  $databasePdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $perintahSql = "UPDATE inventaris SET jumlah_inventaris = 99";
  $pernyataan = $databasePdo->query($perintahSql);
  if ($pernyataan !== FALSE) {
    echo "Query Ok, ada ".$pernyataan->rowCount()." baris yang di update";
  }
  $pernyataan = NULL;
}
catch (\PDOException $e) {
  echo "Koneksi / Query bermasalah: ".$e->getMessage(). " (".$e->getCode().")";
}
finally {
  $databasePdo=NULL;
}
