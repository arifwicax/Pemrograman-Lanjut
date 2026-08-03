<?php
abstract class Perangkat {
  private $stok = 200;
  abstract public function cekHarga();  

  public function cekStok(){
    return $this->stok;
  }
}

class Monitor extends Perangkat{
  public function cekHarga(){
    return 3000000;
  }
}


$perangkat01 = new Monitor();
echo $perangkat01->cekHarga();  // 3000000

echo "<br>";

echo $perangkat01->cekStok();  // 15000