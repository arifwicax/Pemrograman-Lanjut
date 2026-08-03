<?php
class Perangkat {
  private $jenama = "";

  public function setMerek($jenama){
    if (is_string($jenama)) {
      $this->merek = $jenama;
    }
    else {
      echo "Error: merek harus berbentuk string <br>";
    }
  }

  public function getMerek(){
    return strtoupper($this->merek);
  }
}

$perangkat01 = new Perangkat();
echo $perangkat01->setMerek(9);       // Error: merek harus berbentuk string 

$perangkat01->setMerek("BorneoSistem");  
echo $perangkat01->getMerek();        // ACER