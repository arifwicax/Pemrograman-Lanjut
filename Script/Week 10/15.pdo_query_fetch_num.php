<?php
try {
  $pdo = new PDO("mysql:host=localhost;dbname=ilkoom", "root", "");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $query = "SELECT * FROM barang";
  $stmt = $pdo->query($query);

  while ($row = $stmt->fetch(PDO::FETCH_NUM)){
    echo $row[0];   echo " | ";
    echo $row[1];   echo " | ";
    echo $row[2];   echo " | ";
    echo $row[3];   echo " | ";
    echo $row[4];
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
