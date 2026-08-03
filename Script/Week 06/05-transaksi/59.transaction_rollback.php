<?php
mysqli_report(MYSQLI_REPORT_STRICT);

// Buat format tanggal hari ini
$sekarang = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
$waktuCatat = $sekarang->format("Y-m-d H:i:s");

try {
  $databaseMysqli = new mysqli("localhost", "root", "","kampus_lanjut");

  // Tampilkan isi tabel sebelum transaction
  echo "<h3>Sebelum Transaction</h3>";
  $hasil = $databaseMysqli->query("SELECT * FROM inventaris");
  while ($baris = $hasil->fetch_array(MYSQLI_NUM)){
    echo $baris[0]." | ".$baris[1]. " | ".$baris[2]. " | ".$baris[3]. " | ".$baris[4];
    echo "<br>";
  }
  echo "<hr>";

  // Mulai transaction
  $databaseMysqli->begin_transaction();
  $databaseMysqli->query("DELETE FROM inventaris WHERE id_inventaris = 2");
  $databaseMysqli->query("DELETE FROM inventaris WHERE id_inventaris = 4");
  $databaseMysqli->query("INSERT INTO inventaris VALUES (NULL,
                 'SagaraElektronik Microwave Oven R-728(K)',20,1250500,'$waktuCatat')");

  // Tampilkan isi tabel selama transaction
  echo "<h3>Di dalam Transaction</h3>";
  $hasil = $databaseMysqli->query("SELECT * FROM inventaris");
  while ($baris = $hasil->fetch_array(MYSQLI_NUM)){
    echo $baris[0]." | ".$baris[1]. " | ".$baris[2]. " | ".$baris[3]. " | ".$baris[4];
    echo "<br>";
  }
  echo "<hr>";

  // Batalkan query transaction
  $databaseMysqli->rollback();

  // Tampilkan isi tabel di setelah transaction
  echo "<h3>Setelah Transaction</h3>";
  $hasil = $databaseMysqli->query("SELECT * FROM inventaris");
  while ($baris = $hasil->fetch_array(MYSQLI_NUM)){
    echo $baris[0]." | ".$baris[1]. " | ".$baris[2]. " | ".$baris[3]. " | ".$baris[4];
    echo "<br>";
  }
}
catch (Exception $e) {
  echo "Koneksi / Query bermasalah: ".$e->getMessage(). " (".$e->getCode().")";
}
finally {
  if (isset($databaseMysqli)) {
    $databaseMysqli->close();
  }
}
