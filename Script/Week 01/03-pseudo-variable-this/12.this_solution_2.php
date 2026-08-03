<?php
class Perangkat {
  public $jenis;
  public $jenama;

  public function pesanProduk(){
    return $this->jenis." ".$this->merek." dipesan...";
  }
}

$perangkat01 = new Perangkat();
$perangkat01->jenis = "Monitor";
$perangkat01->merek = "NusaTech";

$perangkat02 = new Perangkat();
$perangkat02->jenis = "Mesin cuci";
$perangkat02->merek = "LenteraTech";

echo $perangkat01->pesanProduk();     // Monitor NusaTech dipesan...
echo "<br>";
echo $perangkat02->pesanProduk();     // Mesin cuci LenteraTech dipesan...