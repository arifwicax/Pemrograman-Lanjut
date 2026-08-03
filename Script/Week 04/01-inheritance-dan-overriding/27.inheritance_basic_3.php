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

class TelevisiLCD extends Monitor {
  public $tipe = "LCD";

  public function cekStokTelevisiLCD(){
    return $this->tipe." ".$this->cekStokTelevisi();
  }
}

$perangkat01 = new TelevisiLCD();
echo $perangkat01->merek;                   // SagaraElektronik
echo "<br>";
echo $perangkat01->jenis;                   // Monitor
echo "<br>";
echo $perangkat01->tipe;                    // LCD
echo "<br>";
echo $perangkat01->cekStokTelevisiLCD();    // LCD Monitor SagaraElektronik, Sisa stok: 50