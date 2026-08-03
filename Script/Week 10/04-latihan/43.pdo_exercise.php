<?php
try {
  $databasePdo = new PDO("mysql:host=localhost", "root", "");
  $databasePdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Buat database "kampus_lanjut" (jika belum ada)
  $perintahSql = "CREATE DATABASE IF NOT EXISTS kampus_lanjut";
  $pernyataan = $databasePdo->query($perintahSql);
  if ($pernyataan !== FALSE){
    echo "Database 'kampus_lanjut' berhasil di buat / sudah tersedia <br>";
  }

  // Pilih database "kampus_lanjut"
  $perintahSql = "USE kampus_lanjut";
  $pernyataan = $databasePdo->query($perintahSql);
  if ($pernyataan !== FALSE){
    echo "Database 'kampus_lanjut' berhasil di pilih <br>";
  }

  // Hapus tabel "mahasiswa" (jika ada)
  $perintahSql = "DROP TABLE IF EXISTS mahasiswa";
  $databasePdo->query($perintahSql);

  // Buat tabel "mahasiswa"
  $perintahSql = "CREATE TABLE mahasiswa (
            nim CHAR(8) PRIMARY KEY,
            nama VARCHAR(100),
            tempat_lahir VARCHAR(50),
            tanggal_lahir DATE,
            fakultas VARCHAR(50),
            jurusan VARCHAR(50),
            ipk DECIMAL(3,2))";
  $pernyataan = $databasePdo->query($perintahSql);
  if ($pernyataan !== FALSE){
    echo "Tabel 'mahasiswa' berhasil di buat <br>";
  }

  // Isi tabel "mahasiswa"
  $perintahSql = "INSERT INTO mahasiswa VALUES
            ('14005011', 'Riana Putria', 'Padang', '1996-11-23', 'FMIPA', 'Kimia', 3.1),
            ('15021044', 'Rudi Permana', 'Bandung', '1994-08-22', 'FASILKOM', 'Ilmu Komputer', 2.9),
            ('15003036', 'Sari Citra Lestari', 'Jakarta', '1997-12-31', 'Ekonomi', 'Manajemen', 3.5),
            ('15002032', 'Rina Kumala Sari', 'Jakarta', '1997-06-28', 'Ekonomi', 'Akuntansi', 3.4),
            ('13012012', 'James Situmorang', 'Medan', '1995-04-02', 'Kedokteran','Kedokteran Gigi', 2.7)";
  $pernyataan = $databasePdo->query($perintahSql);
  if ($pernyataan !== FALSE){
    echo "Tabel 'mahasiswa' berhasil di isi ".$pernyataan->rowCount()."
         baris data <br>";
  }

  echo "<hr>";

  // Tampilkan semua isi tabel "mahasiswa"
  echo "<h3>Tabel Mahasiswa</h3>";
  $perintahSql = "SELECT * FROM mahasiswa";
  $pernyataan = $databasePdo->query($perintahSql);

  while ($baris = $pernyataan->fetch(PDO::FETCH_NUM)){
    echo $baris[0]." | ".$baris[1]. " | ".$baris[2]. " | ".$baris[3]. " | ".$baris[4];
    echo "<br>";
  }
  $pernyataan = NULL;

}
catch (\PDOException $e) {
  echo "Koneksi / Query bermasalah: ".$e->getMessage(). " (".$e->getCode().")";
}
finally {
  $databasePdo=NULL;
}
