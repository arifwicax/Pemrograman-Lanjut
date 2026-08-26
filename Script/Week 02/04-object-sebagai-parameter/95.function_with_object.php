<?php
class Smartphone {
  public $merek;
  public $tipe;
  public $harga;

  public function __construct($merek,$tipe,$harga){
    $this->merek = $merek;
    $this->tipe = $tipe;
    $this->harga = $harga;
  }
}

function tampilkanSmartphone($hp){
  return "Smartphone ".$hp->merek." ".$hp->tipe." di jual seharga Rp. "
       .number_format($hp->harga,2,",",".");
}

$perangkat01 = new Smartphone("RinjaniLabs","Redmi Note 6",2799000);
$perangkat02 = new Smartphone("NusaTech","Galaxy S9+",11999000);
$perangkat03 = new Smartphone("Apple","iPhone X",15700000);

echo tampilkanSmartphone($perangkat01);
echo "<br>";
echo tampilkanSmartphone($perangkat02);
echo "<br>";
echo tampilkanSmartphone($perangkat03);
