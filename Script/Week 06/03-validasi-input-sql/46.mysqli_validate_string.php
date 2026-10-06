<?php
// Materi Week 06: Bagian 3: validasi input dan perbandingan perlindungan terhadap SQL injection.
// Script ini mendemonstrasikan: mysqli validate string.
// Ikuti alur kode dari atas ke bawah: siapkan koneksi, jalankan operasi,
// proses hasil jika ada, lalu bebaskan resource dan tutup koneksi.
mysqli_report(MYSQLI_REPORT_STRICT);

$_GET['nama_inventaris'] = "Buku Moody's";
$nama_inventaris = $_GET['nama_inventaris'];

try {
  $databaseMysqli = new mysqli("localhost", "root", "","kampus_lanjut");

  // Ambil data di tabel inventaris
  $perintahSql = "SELECT * FROM inventaris WHERE nama_inventaris = '$nama_inventaris'";
  $hasil = $databaseMysqli->query($perintahSql);

  if ($databaseMysqli->error){
    throw new Exception($databaseMysqli->error, $databaseMysqli->errno);
  }
  else {
    if ($hasil->num_rows === 0) {
      echo "Data tidak ditemukan";
    }
    else {
      echo "Data tersedia";
    }
  }
}
catch (Exception $e) {
  echo "Koneksi / Query bermasalah: ".$e->getMessage(). " (".$e->getCode().")";
}
finally {
  if (isset($databaseMysqli)) {
    $databaseMysqli->close();
  }
}
