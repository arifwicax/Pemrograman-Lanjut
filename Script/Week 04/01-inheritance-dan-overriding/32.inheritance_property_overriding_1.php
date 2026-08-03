<?php
class Perangkat {
  public $jenama = "CakraDigital";
}

class Monitor extends Perangkat {
  public $jenama = "Panasonic";
}

$perangkat01 = new Monitor();
echo $perangkat01->merek;     // Panasonic
