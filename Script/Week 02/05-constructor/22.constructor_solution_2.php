<?php
class Perangkat {
  public $jenis;
  public $jenama;
  public $stok;

  public function __construct($jenis, $jenama, $stok = 10){
    $this->jenis = $jenis;
    $this->merek = $jenama;
    $this->stok = $stok;
  }
}

$perangkat01 = new Perangkat("Monitor","NusaTech",20);
$perangkat02 = new Perangkat("Mesin cuci","LenteraTech");

print_r ($perangkat01);
echo "<br>";
print_r ($perangkat02);