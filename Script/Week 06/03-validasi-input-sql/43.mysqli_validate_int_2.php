<?php
mysqli_report(MYSQLI_REPORT_STRICT);

$_GET['id_inventaris'] = "5";
$id_inventaris = $_GET['id_inventaris'];

try {
  $databaseMysqli = new mysqli("localhost", "root", "","kampus_lanjut");

  // Ambil data di tabel inventaris
  $perintahSql = "SELECT * FROM inventaris WHERE id_inventaris = $id_inventaris";
  $hasil = $databaseMysqli->query($perintahSql);

  while ($baris = $hasil->fetch_assoc()){
    echo $baris['id_inventaris'];       echo " | ";
    echo $baris['nama_inventaris'];     echo " | ";
    echo $baris['jumlah_inventaris'];   echo " | ";
    echo $baris['biaya_inventaris'];    echo " | ";
    echo $baris['waktu_pembaruan'];
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
