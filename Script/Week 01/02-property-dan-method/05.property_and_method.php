<?php
class Perangkat {
  public $sku = "001";
  public $jenama = "NusaTech";
  public $biaya = 4000000;

  public function pesanProduk(){
    return "Perangkat dipesan...";
  }
}

$monitor = new Perangkat();