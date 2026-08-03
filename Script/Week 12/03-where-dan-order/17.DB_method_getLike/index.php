<?php
require 'DB.php';
$DB = DB::getInstance();

$tabelBarang = $DB->getLike('inventaris','nama_inventaris','%kulkas%');
// $tabelBarang = $DB->select('nama_inventaris,id_inventaris')
//                   ->getLike('inventaris','nama_inventaris','%k%');

echo "<pre>";
print_r($tabelBarang);
echo "</pre>";

echo $tabelBarang[0]->nama_inventaris;

// Menampilkan data dalam HTML
foreach ($tabelBarang as $elemen) {
    echo "<table border='1'>
            <tr>
                <th>ID Barang</th>
                <th>Nama Barang</th>
                <th>Jumlah Barang</th>
                <th>Harga Barang</th>
                <th>Tanggal Update</th>
            </tr>
            <tr>
                <td>{$elemen->id_inventaris}</td>
                <td>{$elemen->nama_inventaris}</td>
                <td>{$elemen->jumlah_inventaris}</td>
                <td>" . number_format($elemen->biaya_inventaris, 0, ',', '.') . "</td>
                <td>{$elemen->waktu_pembaruan}</td>
            </tr>
          </table>";
}