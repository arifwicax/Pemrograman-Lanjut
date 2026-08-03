<?php
interface ProdukEkspor {
  public function cekHargaUsd();
  public function cekNegara();
}

class Monitor implements ProdukEkspor {
  public function cekHargaUsd(){
    return 185;
  }
  public function cekNegara(){
    return ["Singapura", "Malaysia","Thailand"];
  }
}

$perangkat01 = new Monitor();
echo $perangkat01->cekHargaUsd();
echo "<br>";
echo implode(", ",$perangkat01->cekNegara());