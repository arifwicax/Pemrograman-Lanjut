<?php
abstract class Perangkat {
  abstract public function cekHarga();  
}

class Monitor extends Perangkat{
  public function cekHarga(){
    return 3000000;
  }
}

$perangkat01 = new Monitor();
echo $perangkat01->cekHarga();  // 3000000