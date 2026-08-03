<?php

class Monitor {
  private $jenama;
  private $jenisLayar;
  private $ukuranLayar;

  public function setMerek($jenama){
    $this->merek = $jenama;
    return $this;
  }
  public function setJenisLayar($jenisLayar){
    $this->jenisLayar = $jenisLayar;
    return $this;
  }
  public function setUkuranLayar($ukuranLayar){
    $this->ukuranLayar = $ukuranLayar;
    return $this;
  }

  public function cekInfo(){
    return "Monitor ".$this->jenisLayar." ".$this->merek." ".
           $this->ukuranLayar." inch";
  }

}

$perangkat01 = new Monitor();
echo $perangkat01->setMerek("NusaTech")->setJenisLayar("LED")->setUkuranLayar("42")->cekInfo();
