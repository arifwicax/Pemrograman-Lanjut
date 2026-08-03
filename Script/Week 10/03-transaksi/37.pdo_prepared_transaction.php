<?php
try {
  $databasePdo = new PDO("mysql:host=localhost;dbname=kampus_lanjut", "root", "");
  $databasePdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $databasePdo->beginTransaction();

  $perintahSql = "DELETE FROM inventaris WHERE id_inventaris = ?";
  $pernyataan = $databasePdo->prepare($perintahSql);
  $pernyataan->execute([2]);
  $pernyataan = NULL;

  $perintahSql = "DELETE FROM inventaris WHERE nama_inventaris = :nama";
  $pernyataan = $databasePdo->prepare($perintahSql);
  $pernyataan->execute(['nama'=>"TV NusaTech 43NU7090 4K"]);
  $pernyataan = NULL;

  // Tampilkan isi tabel selama transaction
  echo "<h3>Di dalam Transaction</h3>";
  $perintahSql = "SELECT * FROM inventaris";
  $pernyataan = $databasePdo->query($perintahSql);

  while ($baris = $pernyataan->fetch(PDO::FETCH_NUM)){
    echo $baris[0]." | ".$baris[1]. " | ".$baris[2]. " | ".$baris[3]. " | ".$baris[4];
    echo "<br>";
  }
  $pernyataan = NULL;

  $databasePdo->rollBack();
  // $databasePdo->commit()

  echo "<hr>";

  // Tampilkan isi tabel setelah transaction
  echo "<h3>Setelah Transaction</h3>";
  $perintahSql = "SELECT * FROM inventaris";
  $pernyataan = $databasePdo->query($perintahSql);

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
