<?php
class Produk {
  public $merek = "Sharp";
  public $stok = 50;
  public function cekStok() {
    return "Sisa stok: ".$this->stok;
  }
}

class Televisi extends Produk {
  public $jenis = "Televisi";
}

$produk01 = new Televisi();
echo $produk01->cekStok();  // Sisa stok: 50

?>