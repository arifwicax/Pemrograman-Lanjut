<?php
class Perangkat {
  private $stok = 0;

  public function setStok($stok){
    if (is_int($stok)) {
      $this->stok = $stok;
    }
    else {
      echo "Error: stok harus angka bulat <br>";
    }
  }

  public function getStok(){
    return $this->stok;
  }
}

$perangkat01 = new Perangkat();
echo $perangkat01->getStok();         // 0
echo "<br>";

$perangkat01->setStok(10.5);          // Error: stok harus angka bulat 
echo $perangkat01->getStok();         // 0   
echo "<br>";

$perangkat01->setStok("Satu");        // Error: stok harus angka bulat 
echo $perangkat01->getStok();         // 0 
echo "<br>";

$perangkat01->setStok(10);  
echo $perangkat01->getStok();         // 10