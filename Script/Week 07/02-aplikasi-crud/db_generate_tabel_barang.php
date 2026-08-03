<?php
mysqli_report(MYSQLI_REPORT_STRICT);

try {
  $databaseMysqli = new mysqli("localhost", "root", "root");

  // Buat database "kampus_lanjut" (jika belum ada)
  $perintahSql = "CREATE DATABASE IF NOT EXISTS penjualan";
  $databaseMysqli->query($perintahSql);
  if ($databaseMysqli->error){
    throw new Exception($databaseMysqli->error, $databaseMysqli->errno);
  }
  else {
    echo "Database 'penjualan' berhasil di buat / sudah tersedia <br>";
  };

  // Pilih database "kampus_lanjut"
  $databaseMysqli->select_db("penjualan");
  if ($databaseMysqli->error){
    throw new Exception($databaseMysqli->error, $databaseMysqli->errno);
  }
  else {
    echo "Database 'penjualan' berhasil di pilih <br>";
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

  // Isi tabel "inventaris"
  $sekarang = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
  $waktuCatat = $sekarang->format("Y-m-d H:i:s");

  $perintahSql = "INSERT INTO inventaris
    (nama_inventaris, jumlah_inventaris, biaya_inventaris, waktu_pembaruan) VALUES
      ('TV NusaTech 43NU7090 4K',5,5399000,'$waktuCatat'),
      ('Kulkas LenteraTech GC-A432HLHU',10,7600000,'$waktuCatat'),
      ('Laptop ASUS ROG GL503GE',7,16200000,'$waktuCatat'),
      ('Printer Epson L220',14,2099000,'$waktuCatat'),
      ('Smartphone RinjaniLabs Pocophone F1',25,4750000,'$waktuCatat')
    ;";
  $databaseMysqli->query($perintahSql);
  if ($databaseMysqli->error){
    throw new Exception($databaseMysqli->error, $databaseMysqli->errno);
  }
  else {
    echo "Tabel 'inventaris' berhasil di isi ".$databaseMysqli->affected_rows."
         baris data <br>";
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
