<?php
abstract class Perangkat {
  abstract public function cekHarga();  
}

class Monitor extends Perangkat{
  public function cekHarga(){
    return 3000000;
  }
}

class MesinCuci extends Perangkat{
  public function cekHarga(){
    return 1500000;
  }
}

$perangkat01 = new Monitor();
echo $perangkat01->cekHarga();  // 3000000

echo "<br>";

$perangkat01 = new MesinCuci();
echo $perangkat01->cekHarga();  // 1500000