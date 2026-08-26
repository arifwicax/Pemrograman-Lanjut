<?php
class Perangkat {
  public $jenis;
  public $merek;
  public $stok;

  public function tambahStok($kuantitas = 12){

    $totalStok = $this->stok + $kuantitas;

    if ($totalStok <=100){
      $this->stok = $totalStok;
      $pesan = "Stok berhasil ditambah <br>"; 
      $pesan .= "Jumlah stok saat ini: ".$this->stok."<br>";  
    } 
    else {
      $pesan = "Maaf, stok sudah penuh. Penambahan stok dibatalkan <br>"; 
      $pesan .= "Jumlah stok saat ini: ".$this->stok."<br>"; 
    }
    return $pesan;
  }

}

$perangkat01 = new Perangkat();
$perangkat01->jenis = "Monitor";
$perangkat01->merek = "NusaTech";
$perangkat01->stok = 54;

echo $perangkat01->tambahStok();
echo "<br>";
echo $perangkat01->tambahStok(20);
echo "<br>";
echo $perangkat01->tambahStok(15);