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

echo $perangkat01->cekMerek(). "<br>";    // ArunikaDigital
echo $perangkat02->cekMerek(). "<br>";    // Electrolux
echo $perangkat03->cekMerek(). "<br>";    // SagaraElektronik
