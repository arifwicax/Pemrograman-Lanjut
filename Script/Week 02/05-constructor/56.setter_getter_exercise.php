<?php
class Perangkat {
  private $sku = "";
  private $stok = 0;

  private function setSku($sku){
    if (preg_match("/^[A-Z]{3}[0-9]{3}$/",$sku)) {
      $this->sku = $sku;
    }
    else {
      die("Error: sku harus 6 digit (3 huruf dan 3 angka), seperti AAA001");
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

  public function __construct($sku, $stok){
    $this->setSku($sku);
    $this->setStok($stok);
  }

  public function getsku(){
    return $this->sku;
  }

  public function getStok(){
    return $this->stok;
  }
}

$perangkat01 = new Perangkat('ACR014',9);
echo "Stok produk ".$perangkat01->getSku().": ".$perangkat01->getStok()." buah";
// Stok produk ACR014: 9 buah

echo "<br>";

$perangkat02 = new Perangkat('LNV023',100);
echo "Stok produk ".$perangkat02->getSku().": ".$perangkat02->getStok()." buah";
// Stok produk LNV023: 100 buah

echo "<br>";

$perangkat03 = new Perangkat('2NV050',67);
echo "Stok produk ".$perangkat03->getSku().": ".$perangkat03->getStok()." buah";
// Error: sku harus 6 digit (3 huruf dan 3 angka), seperti AAA001

echo "<br>";

$perangkat04 = new Perangkat('HP002',10);
echo "Stok produk ".$perangkat04->getSku().": ".$perangkat04->getStok()." buah";
// Error: sku harus 6 digit (3 huruf dan 3 angka), seperti AAA001

echo "<br>";

$produk05 = new Perangkat('DEL099',-5);
echo "Stok produk ".$produk05->getSku().": ".$produk05->getStok()." buah";
// Error: stok harus angka bulat positif 