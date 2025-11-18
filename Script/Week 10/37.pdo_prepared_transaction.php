<?php
try {
  $pdo = new PDO("mysql:host=localhost;dbname=ilkoom", "root", "");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $pdo->beginTransaction();

  $query = "DELETE FROM barang WHERE id_barang = ?";
  $stmt = $pdo->prepare($query);
  $stmt->execute([2]);
  $stmt = NULL;

  $query = "DELETE FROM barang WHERE nama_barang = :nama";
  $stmt = $pdo->prepare($query);
  $stmt->execute(['nama'=>"TV Samsung 43NU7090 4K"]);
  $stmt = NULL;

  // Tampilkan isi tabel selama transaction
  echo "<h3>Di dalam Transaction</h3>";
  $query = "SELECT * FROM barang";
  $stmt = $pdo->query($query);

  while ($row = $stmt->fetch(PDO::FETCH_NUM)){
    echo $row[0]." | ".$row[1]. " | ".$row[2]. " | ".$row[3]. " | ".$row[4];
    echo "<br>";
  }
  $stmt = NULL;

  $pdo->rollBack();
  // $pdo->commit()

  echo "<hr>";

  // Tampilkan isi tabel setelah transaction
  echo "<h3>Setelah Transaction</h3>";
  $query = "SELECT * FROM barang";
  $stmt = $pdo->query($query);

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
