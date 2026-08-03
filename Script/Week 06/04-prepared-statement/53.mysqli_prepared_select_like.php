<?php
mysqli_report(MYSQLI_REPORT_STRICT);

try {
  $databaseMysqli = new mysqli("localhost", "root", "","kampus_lanjut");

  // Buat prepared statement untuk mencari nama inventaris
  $pernyataan = $databaseMysqli->prepare("SELECT * FROM inventaris WHERE nama_inventaris LIKE ? ");

  // Proses bind
  $pernyataan->bind_param("s", $nama_inventaris);
  $nama_inventaris = "%kulkas%";
  
  // Proses execute
  $pernyataan->execute();

  // Proses menampilkan hasil query
  $hasil = $pernyataan->get_result();
  while ($baris = $hasil->fetch_assoc()){
    echo $baris['id_inventaris'];       echo " | ";
    echo $baris['nama_inventaris'];     echo " | ";
    echo $baris['jumlah_inventaris'];   echo " | ";
    echo $baris['biaya_inventaris'];    echo " | ";
    echo $baris['waktu_pembaruan'];
    echo "<br>";
  }

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
