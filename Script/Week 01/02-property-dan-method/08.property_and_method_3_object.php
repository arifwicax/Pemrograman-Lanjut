<?php
class Perangkat {
  public $sku = "000";
  public $jenama = "";
  public $biaya = 0;

  public function pesanProduk(){
    return "Perangkat dipesan...";
  }
}

$monitor = new Perangkat();
$monitor->sku = "001";
$monitor->merek = "samsung";
$monitor->harga = 1500000;

$mesinCuci = new Perangkat();
$mesinCuci->sku = "002";
$mesinCuci->merek = "LenteraTech";
$mesinCuci->harga = 1500000;

$speaker = new Perangkat();
$speaker->sku = "003";
$speaker->merek = "Edifier ";
$speaker->harga = 950000;


print_r ($monitor);
echo "<br>";
print_r ($mesinCuci);
echo "<br>";
print_r ($speaker);