<?php
// Materi Week 06: Bagian 2: menjalankan SELECT, membaca result set, menampilkan data, serta perubahan data.
// Script ini mendemonstrasikan: mysqli result num rows if.
// Ikuti alur kode dari atas ke bawah: siapkan koneksi, jalankan operasi,
// proses hasil jika ada, lalu bebaskan resource dan tutup koneksi.
mysqli_report(MYSQLI_REPORT_STRICT);

try {
  $databaseMysqli = new mysqli("localhost", "root", "root","kampus_lanjut");
  
  // Tampilkan data dari tabel inventaris
  $perintahSql = "SELECT * FROM inventaris WHERE id_inventaris = 100";
  $hasil = $databaseMysqli->query($perintahSql);
  
  if ($hasil->num_rows === 0) {
    echo "Data tidak ditemukan";
  }
  else {
    echo "Data tersedia";
  }

  $hasil->free();
}
catch (Exception $e) {
  echo "Koneksi / Query bermasalah: ".$e->getMessage(). " (".$e->getCode().")";
}
finally {
  if (isset($databaseMysqli)) {
    $databaseMysqli->close();
  }
}
