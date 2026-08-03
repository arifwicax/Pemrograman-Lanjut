<?php
try {
  $databasePdo = new PDO("mysql:host=localhost;dbname=kampus_lanjut", "root", "");
  $databasePdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $perintahSql = "DELET FROM inventaris WHERE id_inventaris = 3";
  $jumlahData = $databasePdo->exec($perintahSql);

  if ($jumlahData !== FALSE) {
    echo "Query Ok, ada $jumlahData baris yang dihapus";
  }
}
catch (\PDOException $e) {
  echo "Koneksi / Query bermasalah: ".$e->getMessage(). " (".$e->getCode().")";
}
finally {
  $databasePdo=NULL;
}
