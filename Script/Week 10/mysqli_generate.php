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

  // Hapus tabel "barang" (jika ada)
  $query = "DROP TABLE IF EXISTS barang";
  $mysqli->query($query);
  if ($mysqli->error){
    throw new Exception($mysqli->error, $mysqli->errno);
  }

  // Buat tabel "barang"
  $query = "CREATE TABLE barang (
           id_barang INT PRIMARY KEY AUTO_INCREMENT,
           nama_barang VARCHAR(50),
           jumlah_barang INT,
           harga_barang DEC,
           tanggal_update TIMESTAMP
           )";
  $mysqli->query($query);
  if ($mysqli->error){
    throw new Exception($mysqli->error, $mysqli->errno);
  }
  else {
    echo "Tabel 'barang' berhasil di buat <br>";
  };

  // Isi tabel "barang"
  $sekarang = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
  $timestamp = $sekarang->format("Y-m-d H:i:s");

  $query = "INSERT INTO barang
    (nama_barang, jumlah_barang, harga_barang, tanggal_update) VALUES
      ('TV Samsung 43NU7090 4K',5,5399000,'$timestamp'),
      ('Kulkas LG GC-A432HLHU',10,7600000,'$timestamp'),
      ('Laptop ASUS ROG GL503GE',7,16200000,'$timestamp'),
      ('Printer Epson L220',14,2099000,'$timestamp'),
      ('Smartphone Xiaomi Pocophone F1',25,4750000,'$timestamp')
    ;";
  $mysqli->query($query);
  if ($mysqli->error){
    throw new Exception($mysqli->error, $mysqli->errno);
  }
  else {
    echo "Tabel 'barang' berhasil di isi ".$mysqli->affected_rows."
         baris data <br>";
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
