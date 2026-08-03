<?php
class Perangkat {
  private static $jumlahPerangkat = 0;
  
  public function __construct(){
    self::$jumlahPerangkat++;
    echo "class Perangkat dibuat, total produk = ".self::$jumlahPerangkat."<br>";
  }
}

$produkA = new Perangkat();
$produkB = new Perangkat();
$produkC = new Perangkat();
$produkD = new Perangkat();