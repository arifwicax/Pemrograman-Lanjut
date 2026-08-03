<?php
class Perangkat {
  protected $jenama;

  protected function hello(){
    return "Ini adalah Perangkat";
  }
}

$perangkat01 = new Perangkat();

// Fatal error: Uncaught Error: Cannot access protected property Perangkat::$jenama
$perangkat01->merek = "MerapiKomputasi";

// Fatal error: Uncaught Error: Cannot access protected property Perangkat::$jenama
echo $perangkat01->merek;    

// Fatal error: Uncaught Error: Call to protected method Perangkat::hello()
echo $perangkat01->hello();   