<?php
abstract class Perangkat {
  abstract public function cekMerek();
}

class Monitor extends Perangkat{
  public function cekMerek(){
    return "ArunikaDigital";
  }
}

class MesinCuci extends Perangkat{
  public function cekMerek(){
    return "Electrolux";
  }
}

class LemariEs extends Perangkat{
  public function cekMerek(){
    return "SagaraElektronik";
  }
}

$perangkat01 = new Monitor();
$perangkat02 = new MesinCuci();
$perangkat03 = new LemariEs();

function tampilkanMerek($objectProduk){
   return $objectProduk->cekMerek(). "<br>";
}

echo tampilkanMerek($perangkat01);    // ArunikaDigital
echo tampilkanMerek($perangkat02);    // Electrolux
echo tampilkanMerek($perangkat03);    // SagaraElektronik
