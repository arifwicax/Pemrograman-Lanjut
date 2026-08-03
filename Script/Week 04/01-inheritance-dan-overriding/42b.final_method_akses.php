<?php
class Perangkat {
  final public function hello(){
    return "Ini dari Perangkat";
  }
}

$perangkat01 = new Perangkat();
echo $perangkat01->hello();    // Ini dari Perangkat
