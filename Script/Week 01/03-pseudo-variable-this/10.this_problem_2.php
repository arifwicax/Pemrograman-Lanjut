<?php
class Perangkat {
  public $jenis = "";
  public $merek = "";

  public function pesanProduk(){
    return $jenis." dipesan...";
  }
}

$perangkat01 = new Perangkat();
$perangkat01->jenis = "Monitor";
$perangkat01->merek = "NusaTech";

echo $perangkat01->pesanProduk(); 