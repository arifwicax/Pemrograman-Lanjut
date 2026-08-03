<?php
class Perangkat {
  public $jenama = "CakraDigital";
}

class Monitor extends Perangkat {
  public $jenama = "Panasonic";
  public $merekProduk = parent::merek;
}

$perangkat01 = new Monitor();
echo $perangkat01->merekProduk;