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