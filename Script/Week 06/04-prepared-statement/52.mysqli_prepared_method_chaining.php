<?php
// Materi Week 06: Bagian 4: prepared statement, parameter binding, SELECT, INSERT, LIKE, dan pengambilan hasil.
// Script ini mendemonstrasikan: mysqli prepared method chaining.
// Ikuti alur kode dari atas ke bawah: siapkan koneksi, jalankan operasi,
// proses hasil jika ada, lalu bebaskan resource dan tutup koneksi.
mysqli_report(MYSQLI_REPORT_STRICT);

try {
  $databaseMysqli = new mysqli("localhost", "root", "","kampus_lanjut");

  // Buat prepared statement untuk ambil data inventaris
  $pernyataan = $databaseMysqli->prepare("SELECT * FROM inventaris WHERE id_inventaris = ?");

  // Proses bind
  $pernyataan->bind_param("i", $id_inventaris);
  $id_inventaris = 3;

  // Proses execute
  $pernyataan->execute();

  // Proses menampilkan hasil query
  $baris = $pernyataan->get_result()->fetch_object();
  echo $baris->id_inventaris;       echo " | ";
  echo $baris->nama_inventaris;     echo " | ";
  echo $baris->jumlah_inventaris;   echo " | ";
  echo $baris->biaya_inventaris;    echo " | ";
  echo $baris->waktu_pembaruan;

  $pernyataan->free_result();
  $pernyataan->close();
}
catch (Exception $e) {
  echo "Koneksi / Query bermasalah: ".$e->getMessage(). " (".$e->getCode().")";
}
finally {
  if (isset($databaseMysqli)) {
    $databaseMysqli->close();
  }
}
