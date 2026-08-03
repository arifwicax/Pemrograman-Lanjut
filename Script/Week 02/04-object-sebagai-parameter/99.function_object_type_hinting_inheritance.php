<?php
class Perangkat {
  public $jenama;
  public $tipe;
  public $biaya;

  public function __construct($jenama,$tipe,$biaya){
    $this->merek = $jenama;
    $this->tipe = $tipe;
    $this->harga = $biaya;
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
