<?php
try {
  $databasePdo = new PDO("mysql:host=localhost;dbname=kampus_lanjut", "root", "");
  $databasePdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $perintahSql = "SELECT * FROM inventaris ORDER BY biaya_inventaris LIMIT :batas";
  $pernyataan = $databasePdo->prepare($perintahSql);
  $pernyataan->bindParam('batas', $batas, PDO::PARAM_INT);
  $batas=3;
  $pernyataan->execute();

  while ($baris = $pernyataan->fetch(PDO::FETCH_NUM)){
    echo $baris[0]." | ".$baris[1]. " | ".$baris[2]. " | ".$baris[3]. " | ".$baris[4];
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
