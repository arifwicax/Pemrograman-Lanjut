<?php
mysqli_report(MYSQLI_REPORT_STRICT);

try {
  $mysqli = new mysqli("localhost", "root", "");

  // Buat database "ilkoom" (jika belum ada)
  $query = "CREATE DATABASE IF NOT EXISTS ilkoom";
  $mysqli->query($query);
  if ($mysqli->error){
    throw new Exception($mysqli->error, $mysqli->errno);
  }
  else {
    echo "Database 'ilkoom' berhasil di buat / sudah tersedia <br>";
  };

  // Pilih database "ilkoom"
  $mysqli->select_db("ilkoom");
  if ($mysqli->error){
    throw new Exception($mysqli->error, $mysqli->errno);
  }
  else {
    echo "Database 'ilkoom' berhasil di pilih <br>";
  };

  // Hapus tabel "user" (jika ada)
  $query = "DROP TABLE IF EXISTS user";
  $mysqli->query($query);
  if ($mysqli->error){
    throw new Exception($mysqli->error, $mysqli->errno);
  }

  // Buat tabel "user"
  $query = "CREATE TABLE user (
           username VARCHAR(50) PRIMARY KEY,
           password VARCHAR(255),
           email VARCHAR(100)
           )";
  $mysqli->query($query);
  if ($mysqli->error){
    throw new Exception($mysqli->error, $mysqli->errno);
  }
  else {
    echo "Tabel 'user' berhasil di buat <br>";
  };

}
catch (Exception $e) {
  echo "Koneksi / Query bermasalah: ".$e->getMessage(). " (".$e->getCode().")";
}
finally {
  if (isset($mysqli)) {
    $mysqli->close();
  }
}
