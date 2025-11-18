<?php
  // buat koneksi dengan database mysql
  $dbhost = "localhost";
  $dbuser = "admin";
  $dbpass = "admin";
  $link   = mysqli_connect($dbhost,$dbuser,$dbpass);

  //periksa koneksi, tampilkan pesan kesalahan jika gagal
  if(!$link){
    die ("Koneksi gagal: ".mysqli_connect_errno().
         " - ".mysqli_connect_error());
  }

  //buat database mahasiswa jika belum ada
  $query = "CREATE DATABASE IF NOT EXISTS crud";
  $result = mysqli_query($link, $query);

  if(!$result){
    die ("Query Error: ".mysqli_errno($link).
         " - ".mysqli_error($link));
  }
  else {
    echo "Database <b>'CRUD'</b> berhasil dibuat... <br>";
  }

  //pilih database kampusku
  $result = mysqli_select_db($link, "crud");

  if(!$result){
    die ("Query Error: ".mysqli_errno($link).
         " - ".mysqli_error($link));
  }
  else {
    echo "Database <b>'CRUD'</b> berhasil dipilih... <br>";
  }

  // cek apakah tabel mahasiswa sudah ada. jika ada, hapus tabel
  $query = "DROP TABLE IF EXISTS tb_crud";
  $hasil_query = mysqli_query($link, $query);

  if(!$hasil_query){
    die ("Query Error: ".mysqli_errno($link).
         " - ".mysqli_error($link));
  }
  else {
    echo "Tabel <b>'tb_crud'</b> berhasil dihapus... <br>";
  }

  // buat query untuk CREATE tabel mahasiswa
  $query  = "CREATE TABLE tb_crud (id INT(11) NOT NULL AUTO_INCREMENT, nama VARCHAR(100), ";
  $query .= "email VARCHAR(100), no_telp VARCHAR(20), password VARCHAR(50),";
  $query .= "PRIMARY KEY (id))";

  $hasil_query = mysqli_query($link, $query);

  if(!$hasil_query){
      die ("Query Error: ".mysqli_errno($link).
           " - ".mysqli_error($link));
  }
  else {
    echo "Tabel <b>'tb_crud'</b> berhasil dibuat... <br>";
  }

  // buat query untuk INSERT data ke tabel mahasiswa
  $query  = "INSERT INTO tb_crud VALUES ";
  $query .= "('1','Arif Wicaksono Septyanto', 'arif@gmail.com,', '08521345678', ";
  $query .= "'arif1234')";
 
  $hasil_query = mysqli_query($link, $query);

  if(!$hasil_query){
      die ("Query Error: ".mysqli_errno($link).
           " - ".mysqli_error($link));
  }
  else {
    echo "Tabel <b>'tb_crud'</b> berhasil diisi... <br>";
  }

  mysqli_close($link);
?>
