<?php
abstract class Produk {
  abstract public function cekMerek();
}

class Televisi extends Produk {
  public function cekMerek() {
    return "Polytron";
  }
}

class MesinCuci extends Produk {
  public function cekMerek() {
    return "Electrolux";
  }
}

class LemariEs extends Produk {
  public function cekMerek() {
    return "Sharp";
  }
}

$produk1 = new Televisi();
$produk2 = new MesinCuci();
$produk3 = new LemariEs();

echo $produk1->cekMerek(); // Polytron
echo $produk2->cekMerek(); // Electrolux
echo $produk3->cekMerek(); // Sharp