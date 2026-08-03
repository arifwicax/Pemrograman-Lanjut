<?php
try {
  $databasePdo = new PDO("mysql:host=localhost;dbname=kampus_lanjut", "root", "");
  $perintahSql = "DELET FROM inventaris WHERE id_inventaris = 3";
  $jumlahData = $databasePdo->exec($perintahSql);

  echo "<pre>";
  var_dump($databasePdo->errorCode());
  var_dump($databasePdo->errorInfo());
  echo "</pre>";

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