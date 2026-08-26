<?php
class Perangkat {
  public $kodeProduk = "001";
  public $merek = "NusaTech";
  public $harga = 4000000;

  public function pesanProduk(){
    return "Perangkat dipesan...";
  }
}

$mesinCuci = new Perangkat();
$mesinCuci->kodeProduk = "002";
$mesinCuci->merek = "LenteraTech";
$mesinCuci->harga = 1500000;

echo $mesinCuci->kodeProduk;              // 002
echo "<br>";
echo $mesinCuci->merek;            // LenteraTech
echo "<br>"; 
echo $mesinCuci->harga;            // 1500000
echo "<br>";
echo $mesinCuci->pesanProduk();    // Perangkat dipesan...
