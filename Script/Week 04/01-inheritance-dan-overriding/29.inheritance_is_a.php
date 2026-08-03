<?php
class Perangkat {
  public $sku;
  public $stok;
}

class Monitor extends Perangkat {
  public $ukuranLayar;
}

class MesinCuci extends Perangkat {
  public $kapasitas;
}

class Speaker extends Perangkat {
  public $konfigurasi;
}

$perangkat01 = new Monitor();
$perangkat02 = new MesinCuci();
$perangkat03 = new Speaker();

var_dump( is_a($perangkat01, 'Perangkat') );      // bool(true)
var_dump( is_a($perangkat01, 'Monitor') );    // bool(true)
var_dump( is_a($perangkat02, 'Perangkat') );      // bool(true)
var_dump( is_a($perangkat02, 'Monitor') );    // bool(false) 
var_dump( is_a($perangkat03, 'Speaker') );     // bool(true)