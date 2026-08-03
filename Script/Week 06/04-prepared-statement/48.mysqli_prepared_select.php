<?php
mysqli_report(MYSQLI_REPORT_STRICT);

try {
  $databaseMysqli = new mysqli("localhost", "root", "","kampus_lanjut");

  // Proses prepare
  $pernyataan = $databaseMysqli->prepare("SELECT * FROM inventaris WHERE id_inventaris = ?");

  // Proses bind
  $id_inventaris = 5;
  $pernyataan->bind_param("i", $id_inventaris);

  // Proses execute
  $pernyataan->execute();

  // Proses menampilkan hasil query
  $hasil = $pernyataan->get_result();
  if ($databaseMysqli->error){
    throw new Exception($databaseMysqli->error, $databaseMysqli->errno);
  }
  else {
    while ($baris = $hasil->fetch_assoc()){
      echo $baris['id_inventaris'];       echo " | ";
      echo $baris['nama_inventaris'];     echo " | ";
      echo $baris['jumlah_inventaris'];   echo " | ";
      echo $baris['biaya_inventaris'];    echo " | ";
      echo $baris['waktu_pembaruan'];
      echo "<br>";
    }
  }

  // Hapus memory dan tutup prepared statement
  $pernyataan->free_result();
  $pernyataan->close();
}
catch (Exception $e) {
  echo "Koneksi / Query bermasalah: ".$e->getMessage(). " (".$e->getCode().")";
}
finally {
  if (isset($databaseMysqli)) {
    $databaseMysqli->close();
  }
}
