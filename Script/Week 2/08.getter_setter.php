<?php
class Produk {
  private $nama;
  private $harga;

  public function __construct($nama, $harga) {
    $this->nama = $nama;
    $this->harga = $harga;
  }

  // Getter untuk nama
  public function getNama() {
    return $this->nama;
  }

  // Getter untuk harga
  public function getHarga() {
    return $this->harga;
  }

  // Setter untuk harga dengan validasi
  public function setHarga($harga) {
    if ($harga > 0) {
      $this->harga = $harga;
    }
  }

  // Method untuk menampilkan info produk
  public function tampilkanInfo() {
    return "Produk: {$this->nama}, Harga: Rp " . number_format($this->harga, 0, ",", ".");
  }
}

// Contoh penggunaan
$produk1 = new Produk("Laptop", 7500000);
echo $produk1->tampilkanInfo();
echo "<br>";

// Update harga pakai setter
$produk1->setHarga(8000000);
echo $produk1->tampilkanInfo();
?>
