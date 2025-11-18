<?php
try {
  $pdo = new PDO("mysql:host=localhost;dbname=ilkoom", "root", "");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $query = "SELECT * FROM barang WHERE id_barang = ? OR 
           nama_barang = ?";
  $stmt = $pdo->prepare($query); 
  $stmt->execute([1, "Printer Epson L220"]);

  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    echo $row['id_barang'];       echo " | ";
    echo $row['nama_barang'];     echo " | ";
    echo $row['jumlah_barang'];   echo " | ";
    echo $row['harga_barang'];    echo " | ";
    echo $row['tanggal_update'];
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