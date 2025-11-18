<?php
try {
  $pdo = new PDO("mysql:host=localhost;dbname=ilkoom", "root", "");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $query = "SELECT * FROM barang WHERE id_barang = ? OR 
           nama_barang = ?";
  $stmt = $pdo->prepare($query); 

  $id = 1;
  $nama = "Printer Epson L220";
  $stmt->execute([$id, $nama]);

  while ($row = $stmt->fetch(PDO::FETCH_NUM)){
    echo $row[0]." | ".$row[1]. " | ".$row[2]. " | ".$row[3]. " | ".$row[4];
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