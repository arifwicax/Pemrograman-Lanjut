<?php
mysqli_report(MYSQLI_REPORT_STRICT);

try {
  $databaseMysqli = new mysqli("localhost", "root", "","kampus_lanjut");

  // Ambil semua data di tabel inventaris
  $perintahSql = "SELECT * FROM inventaris";
  $hasil = $databaseMysqli->query($perintahSql);

  $i=0;
  while ($baris = $hasil->fetch_array(MYSQLI_ASSOC)){
    $arr[$i]['id_inventaris'] = $baris['id_inventaris'];
    $arr[$i]['nama_inventaris'] = $baris['nama_inventaris'];
    $arr[$i]['jumlah_inventaris'] = $baris['jumlah_inventaris'];
    $arr[$i]['biaya_inventaris'] = $baris['biaya_inventaris'];
    $arr[$i]['waktu_pembaruan']= $baris['waktu_pembaruan'];
    $i++;
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

echo "<pre>";
print_r($arr);
echo "</pre>";

?>
