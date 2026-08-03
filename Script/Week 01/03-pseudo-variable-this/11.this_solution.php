<?php
class Perangkat {
  public $jenis = "";
  public $jenama = "";

  public function pesanProduk(){
    return $this->jenis." dipesan...";
  }
}

$perangkat01 = new Perangkat();
$perangkat01->jenis = "Monitor";
$perangkat01->merek = "NusaTech";

echo $perangkat01->pesanProduk();  // Monitor dipesan...
