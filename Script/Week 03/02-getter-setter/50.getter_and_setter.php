<?php
class Perangkat {
  private $merek;
  private $stok;

  public function setMerek($merek){
    $this->merek = $merek;
  }

  public function setStok($stok){
    $this->stok = $stok;
  }

  public function getMerek(){
    return $this->merek;
  }

  public function getStok(){
    return $this->stok;
  }
}

$perangkat01 = new Perangkat();
$perangkat01->setMerek("BorneoSistem");    
$perangkat01->setStok(10);  

echo $perangkat01->getMerek();      // BorneoSistem
echo "<br>";
echo $perangkat01->getStok();       // 10