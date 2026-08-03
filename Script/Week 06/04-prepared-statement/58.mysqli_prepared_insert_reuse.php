<?php
mysqli_report(MYSQLI_REPORT_STRICT);

try {
  $databaseMysqli = new mysqli("localhost", "root", "","kampus_lanjut");

  // Buat format tanggal hari ini
  $sekarang = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
  $waktuCatat = $sekarang->format("Y-m-d H:i:s");

  // Buat prepared statement untuk input data inventaris
  $pernyataan = $databaseMysqli->prepare("INSERT INTO inventaris (nama_inventaris,
  jumlah_inventaris, biaya_inventaris, waktu_pembaruan) VALUES (?,?,?,?)");

  $pernyataan->bind_param("siis", $nama_inventaris, $jumlah_inventaris,
                     $biaya_inventaris, $waktu_pembaruan);

  // Input data 1
  $nama_inventaris = "Cosmos CRJ-8229 - Rice Cooker";
  $jumlah_inventaris = 4;
  $biaya_inventaris = 299000;
  $waktu_pembaruan = $waktuCatat;

  $pernyataan->execute();
  echo "Terdapat ".$databaseMysqli->affected_rows." baris yang ditambah <br>";

  // Input data 2
  $nama_inventaris = "Philips Blender HR 2157";
  $jumlah_inventaris = 11;
  $biaya_inventaris = 629000;
  $waktu_pembaruan = $waktuCatat;

  $pernyataan->execute();
  echo "Terdapat ".$databaseMysqli->affected_rows." baris yang ditambah <br><br>";

  $pernyataan->close();

  // Proses prepare untuk menampilkan semua isi tabel inventaris
  $pernyataan = $databaseMysqli->prepare("SELECT * FROM inventaris WHERE id_inventaris");

  // Proses execute
  $pernyataan->execute();

  // Proses menampilkan hasil query
  $hasil = $pernyataan->get_result();
    while ($baris = $hasil->fetch_assoc()){
      echo $baris['id_inventaris'];       echo " | ";
      echo $baris['nama_inventaris'];     echo " | ";
      echo $baris['jumlah_inventaris'];   echo " | ";
      echo $baris['biaya_inventaris'];    echo " | ";
      echo $baris['waktu_pembaruan'];
      echo "<br>";
    }

  // Hapus memory dan tutup prepared statement
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
