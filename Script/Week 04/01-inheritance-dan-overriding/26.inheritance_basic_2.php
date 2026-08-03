<?php
class Perangkat {
  public $jenama = "SagaraElektronik";
  public $stok = 50;

  public function cekStok(){
    return "Sisa stok: ".$this->stok;
  }
}

class Monitor extends Perangkat {
  public $jenis = "Monitor";

  public function cekStokTelevisi(){
    return $this->jenis." ".$this->merek.", ".$this->cekStok();
  }
}

$perangkat01 = new Monitor();
echo $perangkat01->jenis;               // Monitor
echo "<br>";
echo $perangkat01->cekStokTelevisi();   // Monitor SagaraElektronik, Sisa stok: 50