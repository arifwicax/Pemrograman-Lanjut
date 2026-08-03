<?php

class Monitor {
  private $jenama;
  private $jenisLayar;
  private $ukuranLayar;

  public function setMerek($jenama){
    $this->merek = $jenama;
  }
  public function setJenisLayar($jenisLayar){
    $this->jenisLayar = $jenisLayar;
  }
  public function setUkuranLayar($ukuranLayar){
    $this->ukuranLayar = $ukuranLayar;
  }

  public function cekInfo(){
    return "Monitor ".$this->jenisLayar." ".$this->merek." ".
           $this->ukuranLayar." inch";
  }

}

$perangkat01 = new Monitor();

$perangkat01->setMerek("NusaTech");
$perangkat01->setJenisLayar("LED");
$perangkat01->setUkuranLayar("42");

echo $perangkat01->cekInfo();
