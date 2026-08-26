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

interface SmartElectronic{
  public function cekOS();
}

class Monitor extends Perangkat implements SmartElectronic{
  public function cekOS(){
    return "Android 9.0 (Pie)";
  }
}

function tampilkanProduk(SmartElectronic $inventaris){
  return "Perangkat ".$inventaris->merek." ".$inventaris->tipe.", dengan "
         .$inventaris->cekOS()." di jual seharga Rp. "
         .number_format($inventaris->harga,2,",",".");
}

$perangkat01 = new Monitor("NusaTech", "LED TV 40 inch UA40M5000",4499000);
echo tampilkanProduk($perangkat01);
