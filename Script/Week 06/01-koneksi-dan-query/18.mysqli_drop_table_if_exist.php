<?php
mysqli_report(MYSQLI_REPORT_STRICT);

try {
  $databaseMysqli = new mysqli("localhost", "root", "");

  // Buat database "kampus_lanjut" (jika belum ada)
  $perintahSql = "CREATE DATABASE IF NOT EXISTS kampus_lanjut";
  $databaseMysqli->query($perintahSql);
  if ($databaseMysqli->error){
    throw new Exception($databaseMysqli->error, $databaseMysqli->errno);
  }
  else {
    echo "Database 'kampus_lanjut' berhasil di buat / sudah tersedia <br>";
  };

  // Pilih database "kampus_lanjut"
  $databaseMysqli->select_db("kampus_lanjut");
  if ($databaseMysqli->error){
    throw new Exception($databaseMysqli->error, $databaseMysqli->errno);
  }
  else {
    echo "Database 'kampus_lanjut' berhasil di pilih <br>";
  };

  // Hapus tabel "inventaris" (jika ada)
  $perintahSql = "DROP TABLE IF EXISTS inventaris";
  $databaseMysqli->query($perintahSql);
  if ($databaseMysqli->error){
    throw new Exception($databaseMysqli->error, $databaseMysqli->errno);
  }

  // Buat tabel "inventaris"
  $perintahSql = "CREATE TABLE inventaris (
           id_inventaris INT PRIMARY KEY AUTO_INCREMENT,
           nama_inventaris VARCHAR(50),
           jumlah_inventaris INT,
           biaya_inventaris DEC,
           waktu_pembaruan TIMESTAMP
           )";
  $databaseMysqli->query($perintahSql);
  if ($databaseMysqli->error){
    throw new Exception($databaseMysqli->error, $databaseMysqli->errno);
  }
  else {
    echo "Tabel 'inventaris' berhasil di buat <br>";
  };


}
catch (Exception $e) {
  echo "Koneksi / Query bermasalah: ".$e->getMessage(). " (".$e->getCode().")";
}
finally {
  if (isset($databaseMysqli)) {
    $databaseMysqli->close();
  }
}
