<?php
try {
  $databasePdo = new PDO("mysql:host=localhost;dbname=kampus_lanjut", "root", "");
  $perintahSql = "UPDATE inventaris SET jumlah_inventaris = 100 WHERE id_inventaris = 3";
  $jumlahData = $databasePdo->exec($perintahSql);
  if ($jumlahData !== FALSE) {
    echo "Query Ok, ada $jumlahData baris yang di update";
  }
}
catch (\PDOException $e) {
  echo "Koneksi / Query bermasalah: ".$e->getMessage(). " (".$e->getCode().")";
}
finally {
  $databasePdo=NULL;
}
