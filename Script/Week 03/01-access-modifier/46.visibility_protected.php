<?php
class Perangkat {
  protected $merek;

  protected function hello(){
    return "Ini adalah Perangkat";
  }
}

$perangkat01 = new Perangkat();

// Fatal error: Uncaught Error: Cannot access protected property Perangkat::$merek
$perangkat01->merek = "MerapiKomputasi";

// Fatal error: Uncaught Error: Cannot access protected property Perangkat::$merek
echo $perangkat01->merek;    

// Fatal error: Uncaught Error: Call to protected method Perangkat::hello()
echo $perangkat01->hello();   