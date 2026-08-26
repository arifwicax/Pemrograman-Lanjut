<?php
class Perangkat {
  private $merek;
  private $stok;

  private function setMerek($merek){
    if (is_string($merek)) {
      $this->merek = $merek;
    }
    else {
      die("Error: merek harus berbentuk string <br>");
    }
  }

  private function setStok($stok){
    if (is_int($stok)) {
      $this->stok = $stok;
    }
    else {
      die("Error: stok harus angka bulat <br>");
    }
  }

  public function __construct($merek, $stok){
    $this->setMerek($merek);
    $this->setStok($stok);
  }

  public function getMerek(){
    return strtoupper($this->merek);
  }

  public function getStok(){
    return $this->stok;
  }
}

$perangkat01 = new Perangkat("BorneoSistem",10);
echo "Stok produk ".$perangkat01->getMerek().": ".$perangkat01->getStok();
