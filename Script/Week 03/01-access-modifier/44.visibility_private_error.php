<?php
class Perangkat {
  private $merek;

  private function hello(){
    return "Ini adalah Perangkat";
  }
}

$perangkat01 = new Perangkat();

// Fatal error: Uncaught Error: Cannot access private property Perangkat::$merek
$perangkat01->merek = "MerapiKomputasi";

// Fatal error: Uncaught Error: Cannot access private property Perangkat::$merek
echo $perangkat01->merek;    

// Fatal error: Uncaught Error: Call to private method Perangkat::hello()
echo $perangkat01->hello();   