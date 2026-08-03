<?php
try {
  $databasePdo = new PDO("mysql:host=localhost;dbname=kampus_lanjut", "root", "");
  $databasePdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $perintahSql = "SELECT * FROM inventaris WHERE id_inventaris = :id OR 
           nama_inventaris = :nama";
  $pernyataan = $databasePdo->prepare($perintahSql); 

  $pernyataan->execute(['id'=>1, 'nama'=>"Printer Epson L220"]);

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