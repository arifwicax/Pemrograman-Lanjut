<?php
  // buat koneksi dengan database mysql
  $dbhost = "localhost";
  $dbuser = "admin";
  $dbpass = "admin";
  $dbname = "kampusku";
  $link = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
  
  //periksa koneksi, tampilkan pesan kesalahan jika gagal
  if(!$link){
    die ("Koneksi dengan database gagal: ".mysqli_connect_errno().
         " - ".mysqli_connect_error());
  }
?>