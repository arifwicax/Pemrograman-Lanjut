<?php
interface BarangEkspor {
  public function getHargaUsd();
  public function getTujuanEkspor();
}

class TV implements BarangEkspor {
  public function getHargaUsd() {
    return 250;
  }

  public function getTujuanEkspor() {
    return ["Singapura", "Malaysia", "Vietnam"];
  }
}

$produkA = new TV();
echo $produkA->getHargaUsd(); // 250
echo "<br>";
echo implode(", ", $produkA->getTujuanEkspor());