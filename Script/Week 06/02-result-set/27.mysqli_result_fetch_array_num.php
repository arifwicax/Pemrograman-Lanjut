<?php
mysqli_report(MYSQLI_REPORT_STRICT);

try {
  $databaseMysqli = new mysqli("localhost", "root", "","kampus_lanjut");

  // Tampilkan semua data di tabel inventaris
  $perintahSql = "SELECT * FROM inventaris";
  $hasil = $databaseMysqli->query($perintahSql);

  while ($baris = $hasil->fetch_array(MYSQLI_NUM)){
    echo $baris[0];   echo " | ";
    echo $baris[1];   echo " | ";
    echo $baris[2];   echo " | ";
    echo $baris[3];   echo " | ";
    echo $baris[4];
    echo "<br>";
  }

  $hasil->free();
}
catch (Exception $e) {
  echo "Koneksi / Query bermasalah: ".$e->getMessage(). " (".$e->getCode().")";
}
finally {
  if (isset($databaseMysqli)) {
    $databaseMysqli->close();
  }
}
