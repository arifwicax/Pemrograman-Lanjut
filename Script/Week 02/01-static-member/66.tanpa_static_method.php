<?php
class Perangkat {
  private $jumlahPerangkat = 0;
  
  public function __construct(){
    $this->totalProduk++;
    echo "class Perangkat dibuat, total produk = ".$this->totalProduk."<br>";
  }
}

$produkA = new Perangkat();
$produkB = new Perangkat();
$produkC = new Perangkat();
$produkD = new Perangkat();