<?php
class Smartphone {
  public $jenama;
  public $tipe;
  public $biaya;
 
  public function __construct($jenama,$tipe,$biaya){
    $this->merek = $jenama;
    $this->tipe = $tipe;
    $this->harga = $biaya;
  }
}

class Monitor {
  public $jenama;
  public $tipe;
  public $biaya;
 
  public function __construct($jenama,$tipe,$biaya){
    $this->merek = $jenama;
    $this->tipe = $tipe;
    $this->harga = $biaya;
  }
}

function tampilkanSmartphone(Smartphone $hp){
  return "Smartphone ".$hp->merek." ".$hp->tipe." di jual seharga Rp. "
       .number_format($hp->harga,2,",",".");
}

function tampilkanTelevisi(Monitor $tv){
  return "Monitor ".$tv->merek." ".$tv->tipe." di jual seharga Rp. "
       .number_format($tv->harga,2,",",".");
}

$perangkat01 = new Monitor("NusaTech", "LED TV 40 inch UA40M5000",4499000);
$perangkat02 = new Smartphone("NusaTech","Galaxy S9+",11999000);

echo tampilkanTelevisi($perangkat01);
echo "<br>";
echo tampilkanSmartphone($perangkat02);

