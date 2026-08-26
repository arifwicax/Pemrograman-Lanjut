<?php
class Perangkat {
  public $merek = "CakraDigital";
}

class Monitor extends Perangkat {
  public $merek = "Panasonic";
  public $merekProduk = parent::merek;
}

$perangkat01 = new Monitor();
echo $perangkat01->merekProduk;