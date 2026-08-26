<?php
class Perangkat {
  public $jenis;
  public $merek;
  public $stok;

  public function pesanProduk(){
    $this->stok = $this->stok - 1;
  }

  public function borongProduk($kuantitas){
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

echo $perangkat01->cekStok();   // Sisa stok: 54

$perangkat01->borongProduk(10);
echo $perangkat01->cekStok();   // Sisa stok: 44

$perangkat01->borongProduk(25);
echo $perangkat01->cekStok();   // Sisa stok: 19