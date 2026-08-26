<?php
class Perangkat {
  public $merek;
  public $tipe;
  public $harga;

  public function __construct($merek,$tipe,$harga){
    $this->merek = $merek;
    $this->tipe = $tipe;
    $this->harga = $harga;
  }
}

class Smartphone extends Perangkat { }
class Monitor extends Perangkat { }

function tampilkanProduk(Perangkat $inventaris){
  return "Perangkat ".$inventaris->merek." ".$inventaris->tipe." di jual seharga Rp. "
       .number_format($inventaris->harga,2,",",".");
}

$perangkat01 = new Monitor("NusaTech", "LED TV 40 inch UA40M5000",4499000);
$perangkat02 = new Smartphone("NusaTech","Galaxy S9+",11999000);

echo tampilkanProduk($perangkat01);
echo "<br>";
echo tampilkanProduk($perangkat02);
