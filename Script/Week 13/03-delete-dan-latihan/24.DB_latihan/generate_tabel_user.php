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

  // Hapus tabel "user" (jika ada)
  $perintahSql = "DROP TABLE IF EXISTS user";
  $databaseMysqli->query($perintahSql);
  if ($databaseMysqli->error){
    throw new Exception($databaseMysqli->error, $databaseMysqli->errno);
  }

  // Buat tabel "user"
  $perintahSql = "CREATE TABLE user (
           username VARCHAR(50) PRIMARY KEY,
           password VARCHAR(255),
           email VARCHAR(100)
           )";
  $databaseMysqli->query($perintahSql);
  if ($databaseMysqli->error){
    throw new Exception($databaseMysqli->error, $databaseMysqli->errno);
  }
  else {
    echo "Tabel 'user' berhasil di buat <br>";
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
