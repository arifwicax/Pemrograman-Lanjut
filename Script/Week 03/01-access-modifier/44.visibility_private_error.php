<?php
class Perangkat {
  private $jenama;

  private function hello(){
    return "Ini adalah Perangkat";
  }
}

$perangkat01 = new Perangkat();

// Fatal error: Uncaught Error: Cannot access private property Perangkat::$jenama
$perangkat01->merek = "MerapiKomputasi";

// Fatal error: Uncaught Error: Cannot access private property Perangkat::$jenama
echo $perangkat01->merek;    

// Fatal error: Uncaught Error: Call to private method Perangkat::hello()
echo $perangkat01->hello();   