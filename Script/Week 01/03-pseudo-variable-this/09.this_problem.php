<?php
class Perangkat {
  public $jenis = "";
  public $merek = "";

  public function pesanProdukTelevisi(){
    return "Monitor dipesan...";
  }

  public function pesanProdukMesinCuci(){
    return "Mesin cuci dipesan...";
  }
}

$perangkat01 = new Perangkat();
$perangkat01->jenis = "Monitor";
$perangkat01->merek = "NusaTech";

$perangkat02 = new Perangkat();
$perangkat02->jenis = "Mesin cuci";
$perangkat02->merek = "LenteraTech";

echo $perangkat01->pesanProdukTelevisi();    // Monitor dipesan...
echo "<br>";
echo $perangkat02->pesanProdukMesinCuci();   // Mesin cuci dipesan...
