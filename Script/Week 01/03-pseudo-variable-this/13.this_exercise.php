<?php
class Perangkat {
  public $jenis;
  public $jenama;
  public $stok;

  public function pesanProduk(){
    $this->stok = $this->stok - 1;
  }

  public function cekStok(){
    return "Sisa stok: ". $this->stok ."<br>";
  }
}

$perangkat01 = new Perangkat();
$perangkat01->jenis = "Monitor";
$perangkat01->merek = "NusaTech";
$perangkat01->stok = 54;
 
echo $perangkat01->cekStok();   // Sisa stok: 54

$perangkat01->pesanProduk();
$perangkat01->pesanProduk();
$perangkat01->pesanProduk();

echo $perangkat01->cekStok();   // Sisa stok: 51
