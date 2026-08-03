<?php

// Buat format tanggal hari ini
$sekarang = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
$waktuCatat = $sekarang->format("Y-m-d H:i:s");

try {
  $databasePdo = new PDO("mysql:host=localhost;dbname=kampus_lanjut", "root", "");
  $databasePdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $perintahSql = "INSERT INTO inventaris (nama_inventaris, jumlah_inventaris,
  biaya_inventaris, waktu_pembaruan) VALUES (:nama,:jumlah,:harga,:tanggal)";
  $pernyataan = $databasePdo->prepare($perintahSql);

  // Input data 1
  $nama = "Cosmos CRJ-8229 - Rice Cooker";
  $kuantitas = 4;
  $biaya = 299000;
  $tanggal = $waktuCatat;

  $pernyataan->execute(['nama'=>$nama, 'jumlah'=>4, 'harga'=>$biaya,
                  'tanggal'=>$tanggal]);
  echo "Query Ok, ".$pernyataan->rowCount()." baris berhasil ditambah <br>";

  // Input data 2
  $arr_input = [
  'nama' => "Philips Blender HR 2157",
  'jumlah' => 11,
  'harga' => 629000,
  'tanggal' => $waktuCatat
  ];

  $pernyataan->execute($arr_input);
  echo "Query Ok, ".$pernyataan->rowCount()." baris berhasil ditambah <br>";
  $pernyataan = NULL;

  echo "<hr>";
  // Tampilkan data inventaris
  $perintahSql = "SELECT * FROM inventaris";
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
