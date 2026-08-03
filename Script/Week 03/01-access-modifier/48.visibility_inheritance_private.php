<?php
class Perangkat {
  private $jenama = "MerapiKomputasi";

  private function hello(){
    return "Ini adalah Perangkat";
  }
}

class Laptop extends Perangkat{
  public function helloLaptop(){
    return $this->hello()." Laptop ".$this->merek;
  }
}

$perangkat01 = new Laptop();
echo $perangkat01->helloLaptop();      
// Fatal error: Uncaught Error: Call to private method Perangkat::hello() from context 'Laptop'