<?php
try {
  $databasePdo = new PDO("mysql:host=localhost;dbname=kampus_lanjut", "root", "");
  $perintahSql = "DELET FROM inventaris WHERE id_inventaris = 3";
  $jumlahData = $databasePdo->exec($perintahSql);

  if ($jumlahData !== FALSE) {
    echo "Query Ok, ada $jumlahData baris yang dihapus";
  }
  else {
    die("Query Error: ".$databasePdo->errorInfo()[2]." (".$databasePdo->errorInfo()[1].")");
  }
}
catch (\PDOException $e) {
  echo "Koneksi / Query bermasalah: ".$e->getMessage(). " (".$e->getCode().")";
}
finally {
  $databasePdo=NULL;
}
