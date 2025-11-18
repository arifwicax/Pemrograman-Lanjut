<?php
class Barang {
  public $kategori;
  public $brand;

  public function beliBarang() {
    return $this->kategori." ".$this->brand." berhasil dibeli.";
  }
}

$barang1 = new Barang();
$barang1->kategori = "Laptop";
$barang1->brand    = "Asus";

echo $barang1->beliBarang();  // Laptop Asus berhasil dibeli.
?>