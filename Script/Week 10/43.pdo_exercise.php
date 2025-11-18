<?php
try {
  $pdo = new PDO("mysql:host=localhost", "root", "");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Buat database "ilkoom" (jika belum ada)
  $query = "CREATE DATABASE IF NOT EXISTS ilkoom";
  $stmt = $pdo->query($query);
  if ($stmt !== FALSE){
    echo "Database 'ilkoom' berhasil di buat / sudah tersedia <br>";
  }

  // Pilih database "ilkoom"
  $query = "USE ilkoom";
  $stmt = $pdo->query($query);
  if ($stmt !== FALSE){
    echo "Database 'ilkoom' berhasil di pilih <br>";
  }

  // Hapus tabel "mahasiswa" (jika ada)
  $query = "DROP TABLE IF EXISTS mahasiswa";
  $pdo->query($query);

  // Buat tabel "mahasiswa"
  $query = "CREATE TABLE mahasiswa (
            nim CHAR(8) PRIMARY KEY,
            nama VARCHAR(100),
            tempat_lahir VARCHAR(50),
            tanggal_lahir DATE,
            fakultas VARCHAR(50),
            jurusan VARCHAR(50),
            ipk DECIMAL(3,2))";
  $stmt = $pdo->query($query);
  if ($stmt !== FALSE){
    echo "Tabel 'mahasiswa' berhasil di buat <br>";
  }

  // Isi tabel "mahasiswa"
  $query = "INSERT INTO mahasiswa VALUES
            ('14005011', 'Riana Putria', 'Padang', '1996-11-23', 'FMIPA', 'Kimia', 3.1),
            ('15021044', 'Rudi Permana', 'Bandung', '1994-08-22', 'FASILKOM', 'Ilmu Komputer', 2.9),
            ('15003036', 'Sari Citra Lestari', 'Jakarta', '1997-12-31', 'Ekonomi', 'Manajemen', 3.5),
            ('15002032', 'Rina Kumala Sari', 'Jakarta', '1997-06-28', 'Ekonomi', 'Akuntansi', 3.4),
            ('13012012', 'James Situmorang', 'Medan', '1995-04-02', 'Kedokteran','Kedokteran Gigi', 2.7)";
  $stmt = $pdo->query($query);
  if ($stmt !== FALSE){
    echo "Tabel 'mahasiswa' berhasil di isi ".$stmt->rowCount()."
         baris data <br>";
  }

  echo "<hr>";

  // Tampilkan semua isi tabel "mahasiswa"
  echo "<h3>Tabel Mahasiswa</h3>";
  $query = "SELECT * FROM mahasiswa";
  $stmt = $pdo->query($query);

  while ($row = $stmt->fetch(PDO::FETCH_NUM)){
    echo $row[0]." | ".$row[1]. " | ".$row[2]. " | ".$row[3]. " | ".$row[4];
    echo "<br>";
  }
  $stmt = NULL;

}
catch (\PDOException $e) {
  echo "Koneksi / Query bermasalah: ".$e->getMessage(). " (".$e->getCode().")";
}
finally {
  $pdo=NULL;
}
