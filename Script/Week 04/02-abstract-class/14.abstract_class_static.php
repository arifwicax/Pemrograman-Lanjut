<?php
abstract class Perangkat {
  public static $jumlahPerangkat = 100;
  
  public static function cekProduk(){
    return "Total Perangkat ada ".self::$jumlahPerangkat;
  }
}

echo Perangkat::$jumlahPerangkat;   // 100 
echo Perangkat::cekProduk();    // Total Perangkat ada 100