<?php
abstract class Perangkat {
  abstract public function cekHarga($kuantitas);  
}

class Monitor extends Perangkat{
  public function cekHarga(){
    return 3000000;
  }
}

$perangkat01 = new Monitor();
// Fatal error: Declaration of Monitor::cekHarga() must be 
// compatible with Perangkat::cekHarga($kuantitas)