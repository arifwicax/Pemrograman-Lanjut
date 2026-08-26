<?php
class Perangkat {
  public $kodeProduk = "001";
  public $merek = "NusaTech";
  public $harga = 4000000;

  public function pesanProduk(){
    return "Perangkat dipesan...";
  }
}

$monitor = new Perangkat();
