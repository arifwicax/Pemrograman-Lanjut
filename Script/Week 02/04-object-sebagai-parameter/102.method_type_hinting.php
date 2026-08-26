<?php
class Perusahaan {
  private $namaPerusahaan;
  private $kotaPerusahaan;

  public function __construct($nama,$kota){
    $this->namaPerusahaan = $nama;
    $this->kotaPerusahaan = $kota;
  }

  public function cekPerusahaan(){
    return $this->namaPerusahaan." dari kota ".$this->kotaPerusahaan;
  }

}

class Smartphone {
  private $merek;
  private $suplier;

  public function __construct($merek, Perusahaan $suplier){
    $this->merek = $merek;
    $this->suplier = $suplier;
  }

  public function cekSmartphone(){
    return "Smartphone ".$this->merek.", di supply oleh ".
           $this->suplier->cekPerusahaan();
  }
}

$suplier01 = new Perusahaan("CV Maju Terus","Bandung");
$perangkat01 = new Smartphone("RinjaniLabs",$suplier01);

echo $perangkat01->cekSmartphone();
