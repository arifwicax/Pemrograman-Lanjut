<?php
class Perangkat {
  public $merek = "CakraDigital";
}

class Monitor extends Perangkat {
  public $merek = "Panasonic";
}

$perangkat01 = new Monitor();
echo $perangkat01->merek;     // Panasonic
