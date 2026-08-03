<?php
class Perangkat {
  private static $jumlahPerangkat = 100;

  public static function cekProduk(){
    return "Total Perangkat ada ".Perangkat::$jumlahPerangkat;
  }
}

echo Perangkat::cekProduk();   // Total Perangkat ada 100
