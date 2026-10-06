<?php
// Materi Week 06: Bagian 2: menjalankan SELECT, membaca result set, menampilkan data, serta perubahan data.
// Script ini mendemonstrasikan: mysqli result object.
// Ikuti alur kode dari atas ke bawah: siapkan koneksi, jalankan operasi,
// proses hasil jika ada, lalu bebaskan resource dan tutup koneksi.
mysqli_report(MYSQLI_REPORT_STRICT);

try {
  $databaseMysqli = new mysqli("localhost", "root", "","kampus_lanjut");
  
  // Tampilkan semua data di tabel inventaris
  $perintahSql = "SELECT * FROM inventaris";
  $hasil = $databaseMysqli->query($perintahSql);
  if ($databaseMysqli->error){
    throw new Exception($databaseMysqli->error, $databaseMysqli->errno);
  }
  else {
    echo "<pre>";
    print_r($hasil);
    echo "<pre>";
    $hasil->free();
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
