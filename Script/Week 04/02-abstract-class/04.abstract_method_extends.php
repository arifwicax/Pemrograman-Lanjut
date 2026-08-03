<?php
abstract class Perangkat {
  abstract public function cekHarga();  
}

class Monitor extends Perangkat{
}

$perangkat01 = new Monitor();
// Fatal error: Class Monitor contains 1 abstract method and 
// must therefore be declared abstract or implement the remaining methods (Perangkat::cekHarga)