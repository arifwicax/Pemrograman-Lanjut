<?php
// Materi Week 06: Bagian 2: menjalankan SELECT, membaca result set, menampilkan data, serta perubahan data.
// Script ini mendemonstrasikan: mysqli result fetch assoc while.
// Ikuti alur kode dari atas ke bawah: siapkan koneksi, jalankan operasi,
// proses hasil jika ada, lalu bebaskan resource dan tutup koneksi.
mysqli_report(MYSQLI_REPORT_STRICT);

try {
  $databaseMysqli = new mysqli("localhost", "root", "","kampus_lanjut");

  // Tampilkan semua data di tabel inventaris
  $perintahSql = "SELECT * FROM inventaris";
  $hasil = $databaseMysqli->query($perintahSql);

  while ($baris = $hasil->fetch_assoc()){
    echo $baris['id_inventaris'];       echo " | ";
    echo $baris['nama_inventaris'];     echo " | ";
    echo $baris['jumlah_inventaris'];   echo " | ";
    echo $baris['biaya_inventaris'];    echo " | ";
    echo $baris['waktu_pembaruan'];
    echo "<br>";
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
