<?php
// Materi Week 06: Bagian 2: menjalankan SELECT, membaca result set, menampilkan data, serta perubahan data.
// Script ini mendemonstrasikan: mysqli result num rows.
// Ikuti alur kode dari atas ke bawah: siapkan koneksi, jalankan operasi,
// proses hasil jika ada, lalu bebaskan resource dan tutup koneksi.
mysqli_report(MYSQLI_REPORT_STRICT);

try {
  $databaseMysqli = new mysqli("localhost", "root", "root","kampus_lanjut");

  // Tampilkan data dari tabel inventaris
  $perintahSql = "SELECT * FROM inventaris WHERE id_inventaris = 1";
  $hasil = $databaseMysqli->query($perintahSql);

  // Tampilkan jumlah baris dan kolom
  echo "Terdapat ".$hasil->field_count." kolom dan ".$hasil->num_rows." baris";
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
