<?php
try {
  $databasePdo = new PDO("mysql:host=localhost;dbname=kampus_lanjut", "root", "");
  $databasePdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $perintahSql = "SELECT * FROM inventaris";
  $pernyataan = $databasePdo->query($perintahSql);

  while ($baris = $pernyataan->fetch(PDO::FETCH_BOTH)){
    echo $baris['id_inventaris'];       echo " | ";
    echo $baris[1];                 echo " | ";
    echo $baris['jumlah_inventaris'];   echo " | ";
    echo $baris[3];                 echo " | ";
    echo $baris['waktu_pembaruan'];
    echo "<br>";
  }
  $pernyataan = NULL;
}
catch (\PDOException $e) {
  echo "Koneksi / Query bermasalah: ".$e->getMessage(). " (".$e->getCode().")";
}
finally {
  $databasePdo=NULL;
}
