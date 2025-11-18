<?php
class Produk {
  public $nama;       // bisa diakses dari mana saja
  private $harga;     // hanya bisa diakses dalam class Produk
  protected $stok;    // bisa diakses di class Produk & turunannya

  public function __construct($nama, $harga, $stok) {
    $this->nama = $nama;
    $this->harga = $harga;
    $this->stok = $stok;
  }

  // Getter untuk harga
  public function getHarga() {
    return $this->harga;
  }

  // Setter untuk harga
  public function setHarga($hargaBaru) {
    $this->harga = $hargaBaru;
  }

  // Getter untuk stok
  public function getStok() {
    return $this->stok;
  }

  // Setter untuk stok
  public function setStok($stokBaru) {
    $this->stok = $stokBaru;
  }

  public function tampilkanInfo() {
    return "Nama: $this->nama, Harga: $this->harga, Stok: $this->stok";
  }
}

// Inheritance: class Turunan
class Elektronik extends Produk {
  private $garansi;

  public function __construct($nama, $harga, $stok, $garansi) {
    parent::__construct($nama, $harga, $stok);
    $this->garansi = $garansi;
  }

  public function tampilkanInfoElektronik() {
    return $this->tampilkanInfo().", Garansi: ".$this->garansi." tahun";
  }
}

// Pemakaian
$produk1 = new Produk("Buku", 50000, 20);
echo $produk1->tampilkanInfo();
echo "<br>";

$produk1->setHarga(60000);   // ubah harga lewat setter
$produk1->setStok(15);       // ubah stok lewat setter
echo $produk1->tampilkanInfo();
echo "<br><br>";

// Contoh inheritance
$tv = new Elektronik("Televisi", 2500000, 10, 2);
echo $tv->tampilkanInfoElektronik();
?>
