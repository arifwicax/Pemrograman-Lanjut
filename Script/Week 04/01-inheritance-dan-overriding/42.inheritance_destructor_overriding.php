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

  public function __destruct(){
    unset($this->jenis, $this->merek, $this->stok);
    echo "Property class Perangkat sudah dihapus... <br>";
  }

}

class Monitor extends Perangkat {
  public $ukuranLayar;

  public function __construct($jenis, $merek, $stok, $ukuranLayar){
    parent::__construct($jenis, $merek, $stok);
    $this->ukuranLayar = $ukuranLayar;
  }

  public function __destruct(){
    unset($this->ukuranLayar);
    echo "Property class Monitor sudah dihapus... <br>";
    parent::__destruct();
  }
}

$perangkat01 = new Monitor("Monitor","NusaTech",20,32);

echo "<pre>";
print_r ($perangkat01);
echo "</pre>";