<?php
class Perangkat {
  public $jenama = "SagaraElektronik";
  public $stok = 50;

  public function cekStok(){
    return "Sisa stok: ".$this->stok;
  }
}

class Monitor extends Perangkat {
}

$perangkat01 = new Monitor();
echo $perangkat01->merek;         // SagaraElektronik
echo "<br>";
echo $perangkat01->cekStok();     // Sisa stok: 50