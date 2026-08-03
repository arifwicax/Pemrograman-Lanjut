<?php
class Perangkat {
  public $jenis;
  public $jenama;
  public $stok;

  public function borongProduk($kuantitas = 10){
    $this->stok = $this->stok - $kuantitas;
  }

  public function cekStok(){
    return "Sisa stok: ". $this->stok ."<br>";
  }
}

$perangkat01 = new Perangkat();
$perangkat01->jenis = "Monitor";
$perangkat01->merek = "NusaTech";
$perangkat01->stok = 54;

$perangkat01->borongProduk();
echo $perangkat01->cekStok();   // Sisa stok: 44

$perangkat01->borongProduk(20);
echo $perangkat01->cekStok();   // Sisa stok: 44