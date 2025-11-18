<?php
try {
  $pdo = new PDO("mysql:host=localhost;dbname=ilkoom", "root", "");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $query = "SELECT * FROM barang";
  $stmt = $pdo->query($query);

  while ($row = $stmt->fetch(PDO::FETCH_LAZY)){
    echo $row['id_barang'];       echo " | ";
    echo $row[1];                 echo " | ";
    echo $row->jumlah_barang;     echo " | ";
    echo $row[3];                 echo " | ";
    echo $row->tanggal_update;
    echo "<br>";
  }
  $stmt = NULL;
}
catch (\PDOException $e) {
  echo "Koneksi / Query bermasalah: ".$e->getMessage(). " (".$e->getCode().")";
}
finally {
  $pdo=NULL;
}
