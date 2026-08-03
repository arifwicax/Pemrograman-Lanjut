<?php
try {
  $databasePdo = new PDO("mysql:host=localhost;dbname=kampus_lanjut", "root", "");
  $databasePdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $perintahSql = "SELECT * FROM inventaris WHERE id_inventaris = :id OR
           nama_inventaris = :inventaris";

  $pernyataan = $databasePdo->prepare($perintahSql);
  $pernyataan->bindValue('id', 5, PDO::PARAM_INT);
  $pernyataan->bindValue('inventaris', "Printer Epson L220", PDO::PARAM_STR);
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
