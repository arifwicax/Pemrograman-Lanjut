<?php
class Produk {
  public $jenis;
  public $merek;
  public $stok;

  public function __construct($jenis, $merek, $stok = 10) {
    $this->jenis = $jenis;
    $this->merek = $merek;
    $this->stok  = $stok;
  }
}

$produk01 = new Produk("Televisi", "Samsung", 20);
print_r($produk01);
?>