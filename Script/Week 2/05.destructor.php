<?php
class Produk {
    public $jenis;
    public $merek;

    // Constructor untuk mengisi data awal
    public function __construct($jenis, $merek){
        $this->jenis = $jenis;
        $this->merek = $merek;
        echo "Object $this->jenis $this->merek dibuat.<br>";
    }

    // Destructor untuk menampilkan pesan ketika object dihapus
    public function __destruct(){
        echo "Object $this->jenis $this->merek dihapus.<br>";
    }
}

// Membuat object pertama
$produk1 = new Produk("Televisi", "LG");

// Membuat object kedua
$produk2 = new Produk("Kulkas", "Samsung");

// Menghapus object secara manual
unset($produk1);

echo "Program selesai.<br>";
