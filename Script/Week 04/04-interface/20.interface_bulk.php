<?php
interface ProdukEkspor {
  public function cekHargaUsd();
  public function cekNegara();
}

interface ProdukMakanan {
  public function cekExpired();
}

interface ProdukMakananBeku {
  public function cekSuhuMin();
}

class Nugget implements ProdukEkspor, ProdukMakanan, ProdukMakananBeku {
  public function cekHargaUsd(){
    return 7.5;
  }
  public function cekNegara(){
    return ["Singapura", "Malaysia","Thailand"];
  }
  public function cekExpired(){
    return "April 2019";
  }
  public function cekSuhuMin(){
    return -14;
  }
}

$perangkat01 = new Nugget();
echo $perangkat01->cekHargaUsd();
echo "<br>";
echo implode(", ",$perangkat01->cekNegara());
echo "<br>";
echo $perangkat01->cekExpired();
echo "<br>";
echo $perangkat01->cekSuhuMin();
