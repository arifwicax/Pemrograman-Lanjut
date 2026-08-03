<?php
class Perangkat {
  protected $jenama = "MerapiKomputasi";

  protected function hello(){
    return "Ini adalah Perangkat";
  }
}

class Laptop extends Perangkat{
  public function helloLaptop(){
    return $this->hello()." Laptop ".$this->merek;
  }
}

$perangkat01 = new Laptop();
echo $perangkat01->helloLaptop();      // Ini adalah Perangkat Laptop MerapiKomputasi