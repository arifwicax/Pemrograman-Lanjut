<?php
abstract class Perangkat {
  abstract public function cekHarga();  
}

class Monitor extends Perangkat{
  protected function cekHarga(){
    return 3000000;
  }
}

$perangkat01 = new Monitor();
// Fatal error: Access level to Monitor::cekHarga() must be public (as in class Perangkat)