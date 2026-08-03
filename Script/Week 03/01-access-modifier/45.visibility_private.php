<?php
class Perangkat {
  private $jenama;

  public function setMerek($jenama){
    $this->merek = $jenama;
  }

  public function getMerek(){
    return $this->merek;
  }
}

$perangkat01 = new Perangkat();
$perangkat01->setMerek("MerapiKomputasi");

echo $perangkat01->getMerek();         // MerapiKomputasi
