<?php
class Perangkat {
  public $sku = "001";
  public $jenama = "NusaTech";
  public $biaya = 4000000;

  public function pesanProduk(){
    return "Perangkat dipesan...";
  }
}

$monitor = new Perangkat();
echo $monitor->sku;              // 001
echo "<br>";
echo $monitor->merek;            // NusaTech
echo "<br>"; 
echo $monitor->harga;            // 4000000
echo "<br>";
echo $monitor->pesanProduk();    // Perangkat dipesan...