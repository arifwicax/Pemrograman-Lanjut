<?php
abstract class Perangkat {
  abstract public function cekHarga();
}

abstract class Monitor extends Perangkat{
  abstract public function cekTipe();
}

class TelevisiLED extends Monitor{
  public function cekHarga(){
    return 3000000;
  }
  public function cekTipe(){
    return "TV LED";
  }
}

$perangkat01 = new TelevisiLED();
echo $perangkat01->cekHarga();   // 3000000
echo "<br>";
echo $perangkat01->cekTipe();    // TV LED
