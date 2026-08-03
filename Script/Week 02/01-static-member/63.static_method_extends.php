<?php
class Perangkat {
  private static $jumlahPerangkat = 100;
  
  public static function cekProduk(){
    return "Total Perangkat ada ".self::$jumlahPerangkat;
  }
}

class Blender extends Perangkat {
}

echo Blender::cekProduk();   // Total Perangkat ada 100