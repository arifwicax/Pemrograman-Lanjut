<?php
class Perangkat {
  public $hargaUSD = 0;
  private const KURSUSD = 15000;

  public function hargaIDR(){
    return $this->hargaUSD * self::KURSUSD;
  }
}

$perangkat01 = new Perangkat();
$perangkat01->hargaUSD = 15;

echo $perangkat01->hargaIDR();  // 225000
