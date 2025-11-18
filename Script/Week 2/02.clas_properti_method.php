<?php
class Produk {
  public $kode = "000";
  public $merek = "";
  public $harga = 0;

  public function pesanProduk() {
    return "Produk dipesan...";
  }
}

$televisi = new Produk();
$televisi->kode   = "001";
$televisi->merek = "Samsung";
$televisi->harga = 4000000;

print_r($televisi);
?>