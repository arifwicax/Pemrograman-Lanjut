<?php
abstract class Perangkat {
  abstract public function cekHarga($kuantitas);
}

class Monitor extends Perangkat{
  public function cekHarga($kuantitas){
    return 3000000 * $kuantitas;
  }
}

$perangkat01 = new Monitor();
echo $perangkat01->cekHarga(2);    // 6000000
