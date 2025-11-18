<?php
abstract class Produk {
  abstract public function cekHarga();
}

class Televisi extends Produk {
  public function cekHarga() {
    return 3000000;
  }
}

class MesinCuci extends Produk {
  public function cekHarga() {
    return 1500000;
  }
}

$tv = new Televisi();
echo $tv->cekHarga(); // 3000000

$mesin = new MesinCuci();
echo $mesin->cekHarga(); // 1500000