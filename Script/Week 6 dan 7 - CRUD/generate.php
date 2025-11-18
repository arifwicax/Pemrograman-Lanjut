<?php
  // buat koneksi dengan database mysql
  $dbhost = "localhost";
  $dbuser = "admin";
  $dbpass = "admin";
  $link   = mysqli_connect($dbhost,$dbuser,$dbpass);

  //periksa koneksi, tampilkan pesan kesalahan jika gagal
  if(!$link){
    die ("Koneksi dengan database gagal: ".mysqli_connect_errno().
         " - ".mysqli_connect_error());
  }

  //buat database kampusku jika belum ada
  $query = "CREATE DATABASE IF NOT EXISTS kampusku";
  $result = mysqli_query($link, $query);

  if(!$result){
    die ("Query Error: ".mysqli_errno($link).
         " - ".mysqli_error($link));
  }
  else {
    echo "Database <b>'kampusku'</b> berhasil dibuat... <br>";
  }

  //pilih database kampusku
  $result = mysqli_select_db($link, "kampusku");

  if(!$result){
    die ("Query Error: ".mysqli_errno($link).
         " - ".mysqli_error($link));
  }
  else {
    echo "Database <b>'kampusku'</b> berhasil dipilih... <br>";
  }

  // cek apakah tabel mahasiswa sudah ada. jika ada, hapus tabel
  $query = "DROP TABLE IF EXISTS mahasiswa";
  $hasil_query = mysqli_query($link, $query);

  if(!$hasil_query){
    die ("Query Error: ".mysqli_errno($link).
         " - ".mysqli_error($link));
  }
  else {
    echo "Tabel <b>'mahasiswa'</b> berhasil dihapus... <br>";
  }

  // buat query untuk CREATE tabel mahasiswa
  $query  = "CREATE TABLE mahasiswa (nim CHAR(8), nama VARCHAR(100), ";
  $query .= "tempat_lahir VARCHAR(50), tanggal_lahir DATE, ";
  $query .= "fakultas VARCHAR(50), jurusan VARCHAR(50), ";
  $query .= "ipk DECIMAL(3,2), PRIMARY KEY (nim))";

  $hasil_query = mysqli_query($link, $query);

  if(!$hasil_query){
      die ("Query Error: ".mysqli_errno($link).
           " - ".mysqli_error($link));
  }
  else {
    echo "Tabel <b>'mahasiswa'</b> berhasil dibuat... <br>";
  }

  // buat query untuk INSERT data ke tabel mahasiswa
  $query  = "INSERT INTO mahasiswa VALUES ";
  $query .= "('12345678', 'arif wicaksono s', 'karanganyar', '1996-11-23', ";
  $query .= "'FMIPA', 'Kimia', 3.1), ";
  $query .= "('11111111', 'indras widanti', 'Bandung', '1994-08-22', ";
  $query .= "'FASILKOM', 'Ilmu Komputer', 2.9), ";
  $query .= "('22222222', 'naura laravella', 'sukoharjo', '2007-12-31', ";
  $query .= "'Kedokteran', 'Kedokteran Anak', 3.5), ";
  $query .= "('33333333', 'Bagus archil', 'Malang', '1997-06-28', ";
  $query .= "'Ekonomi', 'Akuntansi', 3.4), ";
  $query .= "('44444444', 'Friska', 'Surakarta', '2003-04-02', ";
  $query .= "'Kedokteran','Kedokteran Gigi', 2.7)";

  $hasil_query = mysqli_query($link, $query);

  if(!$hasil_query){
      die ("Query Error: ".mysqli_errno($link).
           " - ".mysqli_error($link));
  }
  else {
    echo "Tabel <b>'mahasiswa'</b> berhasil diisi... <br>";
  }

  // cek apakah tabel admin sudah ada. jika ada, hapus tabel
  $query = "DROP TABLE IF EXISTS admin";
  $hasil_query = mysqli_query($link, $query);

  if(!$hasil_query){
    die ("Query Error: ".mysqli_errno($link).
         " - ".mysqli_error($link));
  }
  else {
    echo "Tabel <b>'admin'</b> berhasil dihapus... <br>";
  }

  // buat query untuk CREATE tabel admin
  $query  = "CREATE TABLE admin (username VARCHAR(50), password CHAR(40))";
  $hasil_query = mysqli_query($link, $query);

  if(!$hasil_query){
      die ("Query Error: ".mysqli_errno($link).
           " - ".mysqli_error($link));
  }
  else {
    echo "Tabel <b>'admin'</b> berhasil dibuat... <br>";
  }

  // buat username dan password untuk admin
  $username = "admin123";
  $password = sha1("rahasia");

  // buat query untuk INSERT data ke tabel admin
  $query  = "INSERT INTO admin VALUES ('$username','$password')";

  $hasil_query = mysqli_query($link, $query);

  if(!$hasil_query){
      die ("Query Error: ".mysqli_errno($link).
           " - ".mysqli_error($link));
  }
  else {
    echo "Tabel <b>'admin'</b> berhasil diisi... <br>";
  }

  // tutup koneksi dengan database mysql
  mysqli_close($link);
?>
