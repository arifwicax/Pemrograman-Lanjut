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
  public $ukuranLayar;

  public function __construct($jenis, $merek, $stok, $ukuranLayar){
    $this->jenis = $jenis;
    $this->merek = $merek;
    $this->stok = $stok;
    $this->ukuranLayar = $ukuranLayar;
  }
}

$perangkat01 = new Monitor("Monitor","NusaTech",20,32);

echo "<pre>";
print_r ($perangkat01);
echo "</pre>";