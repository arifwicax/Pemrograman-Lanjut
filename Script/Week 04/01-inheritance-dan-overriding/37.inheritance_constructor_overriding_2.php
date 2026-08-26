<?php
class Perangkat {
  public $jenis;
  public $merek;
  public $stok;

  public function __construct($jenis, $merek, $stok){
    $this->jenis = $jenis;
    $this->merek = $merek;
    $this->stok = $stok;
  }
}

class Monitor extends Perangkat {
  public function __construct($jenis, $merek, $stok){
    $this->jenis = $jenis;
    $this->merek = $merek;
    $this->stok = $stok;
  }
}

$perangkat01 = new Monitor("Monitor","NusaTech",20);

echo "<pre>";
print_r ($perangkat01);
echo "</pre>";