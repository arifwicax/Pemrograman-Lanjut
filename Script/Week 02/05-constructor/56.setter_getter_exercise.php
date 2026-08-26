<?php
class Perangkat {
  private $kodeProduk = "";
  private $stok = 0;

  private function setKodeProduk($kodeProduk){
    if (preg_match("/^[A-Z]{3}[0-9]{3}$/",$kodeProduk)) {
      $this->kodeProduk = $kodeProduk;
    }
    else {
      die("Error: kode produk harus 6 digit (3 huruf dan 3 angka), seperti AAA001");
    }
  }

  private function setStok($stok){
    if (is_int($stok) && ($stok>0)) {
      $this->stok = $stok;
    }
    else {
      die("Error: stok harus angka bulat positif <br>");
    }
  }

  public function __construct($kodeProduk, $stok){
    $this->setKodeProduk($kodeProduk);
    $this->setStok($stok);
  }

  public function getKodeProduk(){
    return $this->kodeProduk;
  }

  public function getStok(){
    return $this->stok;
  }
}

$perangkat01 = new Perangkat('ACR014',9);
echo "Stok produk ".$perangkat01->getKodeProduk().": ".$perangkat01->getStok()." buah";
// Stok produk ACR014: 9 buah

echo "<br>";

$perangkat02 = new Perangkat('LNV023',100);
echo "Stok produk ".$perangkat02->getKodeProduk().": ".$perangkat02->getStok()." buah";
// Stok produk LNV023: 100 buah

echo "<br>";

$perangkat03 = new Perangkat('2NV050',67);
echo "Stok produk ".$perangkat03->getKodeProduk().": ".$perangkat03->getStok()." buah";
// Error: kode produk harus 6 digit (3 huruf dan 3 angka), seperti AAA001

echo "<br>";

$perangkat04 = new Perangkat('HP002',10);
echo "Stok produk ".$perangkat04->getKodeProduk().": ".$perangkat04->getStok()." buah";
// Error: kode produk harus 6 digit (3 huruf dan 3 angka), seperti AAA001

echo "<br>";

$produk05 = new Perangkat('DEL099',-5);
echo "Stok produk ".$produk05->getKodeProduk().": ".$produk05->getStok()." buah";
// Error: stok harus angka bulat positif 