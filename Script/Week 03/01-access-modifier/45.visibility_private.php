<?php
class Perangkat {
  private $merek;

  public function setMerek($merek){
    $this->merek = $merek;
  }

  public function getMerek(){
    return $this->merek;
  }
}

$perangkat01 = new Perangkat();
$perangkat01->setMerek("MerapiKomputasi");

echo $perangkat01->getMerek();         // MerapiKomputasi
