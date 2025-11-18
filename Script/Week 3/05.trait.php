<?php
class Televisi {
  public function cekResolusi(){
    return "Full HD";
  }
}

trait SmartElectronic {
  public function cekOS(){
    return "Android 9.0 (Pie)";
  }
}

class SmartTV extends Televisi {
  use SmartElectronic;

  public function cekInfo(){
    return "Smart TV " . $this->cekResolusi() . " - " . $this->cekOS();
  }
}

$produk01 = new SmartTV;
echo $produk01->cekInfo()