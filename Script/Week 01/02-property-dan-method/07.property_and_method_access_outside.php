<?php
class Perangkat {
  public $sku = "001";
  public $jenama = "NusaTech";
  public $biaya = 4000000;

  public function pesanProduk(){
    return "Perangkat dipesan...";
  }
}

$mesinCuci = new Perangkat();
$mesinCuci->sku = "002";
$mesinCuci->merek = "LenteraTech";
$mesinCuci->harga = 1500000;

echo $mesinCuci->sku;              // 002
echo "<br>";
echo $mesinCuci->merek;            // LenteraTech
echo "<br>"; 
echo $mesinCuci->harga;            // 1500000
echo "<br>";
echo $mesinCuci->pesanProduk();    // Perangkat dipesan...