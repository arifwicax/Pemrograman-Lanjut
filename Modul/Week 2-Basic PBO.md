# 📘 Modul 2 – Pengenalan Object dalam PHP

---

## 2.1 Apa itu Object dalam PHP?

Dalam pemrograman berorientasi objek (OOP), **object** adalah hasil instansiasi dari sebuah **class**.

* **Class** dapat diibaratkan sebagai cetakan atau blueprint.
* **Object** adalah wujud nyata dari cetakan tersebut.

Dengan kata lain:

* Class mendefinisikan struktur dan perilaku suatu entitas.
* Object adalah implementasi konkret dari class tersebut.

---

## 2.2 Membuat Object Sederhana dalam PHP

```php
<?php
class Produk {
}

// Membuat tiga object dari class Produk
$televisi  = new Produk();
$mesinCuci = new Produk();
$speaker   = new Produk();

var_dump($televisi);
echo "<br>";
var_dump($mesinCuci);
echo "<br>";
var_dump($speaker);
?>
```

### Penjelasan

1. `class Produk {}` → mendefinisikan class kosong.
2. `$televisi = new Produk();` → membuat object baru dari class.
3. `var_dump()` → menampilkan informasi object, misalnya:

   ```
   object(Produk)#1 (0) { }
   ```

   Angka `#1`, `#2`, `#3` adalah identitas unik untuk tiap object.

---

## 2.3 Class dengan Properti dan Method

```php
<?php
class Produk {
  public $kode = "000";
  public $merek = "";
  public $harga = 0;

  public function pesanProduk() {
    return "Produk dipesan...";
  }
}

$televisi = new Produk();
$televisi->kode   = "001";
$televisi->merek = "Samsung";
$televisi->harga = 4000000;

print_r($televisi);
?>
```

### Penjelasan

* **Properti**: `$kode`, `$merek`, `$harga`.
* **Method**: `pesanProduk()`.
* Nilai properti diatur melalui **object**.
* Hasil `print_r()`:

  ```
  Produk Object
  (
    [kode] => 001
    [merek] => Samsung
    [harga] => 4000000
  )
  ```

---

## 2.4 Pseudo-variable `$this`

`$this` adalah variabel khusus dalam PHP yang digunakan **di dalam class** untuk merujuk pada object yang sedang aktif.

```php
<?php
class Barang {
  public $kategori;
  public $brand;

  public function beliBarang() {
    return $this->kategori." ".$this->brand." berhasil dibeli.";
  }
}

$barang1 = new Barang();
$barang1->kategori = "Laptop";
$barang1->brand    = "Asus";

echo $barang1->beliBarang();  // Laptop Asus berhasil dibeli.
?>
```

---

## 2.5 Constructor dan Destructor

### Constructor (`__construct`)

Dijalankan otomatis ketika object dibuat.

```php
<?php
class Produk {
  public $jenis;
  public $merek;
  public $stok;

  public function __construct($jenis, $merek, $stok = 10) {
    $this->jenis = $jenis;
    $this->merek = $merek;
    $this->stok  = $stok;
  }
}

$produk01 = new Produk("Televisi", "Samsung", 20);
print_r($produk01);
?>
```

### Destructor (`__destruct`)

Dijalankan otomatis ketika object dihancurkan atau program selesai.

```php
public function __destruct() {
  echo "Object $this->jenis $this->merek dihapus.";
}
```

---

## 2.6 Inheritance (Pewarisan)

```php
<?php
class Produk {
  public $merek = "Sharp";
  public $stok = 50;
  public function cekStok() {
    return "Sisa stok: ".$this->stok;
  }
}

class Televisi extends Produk {
  public $jenis = "Televisi";
}

$produk01 = new Televisi();
echo $produk01->cekStok();  // Sisa stok: 50
?>
```

---

## 2.7 Visibility: Public, Private, Protected

```php
<?php
class Produk {
  public $nama;       // public
  private $harga;     // private
  protected $stok;    // protected

  public function __construct($nama, $harga, $stok) {
    $this->nama = $nama;
    $this->harga = $harga;
    $this->stok = $stok;
  }

  public function tampilkanInfo() {
    return "Nama: $this->nama, Harga: $this->harga, Stok: $this->stok";
  }
}
?>
```

| Modifier  | Dalam Class | Luar Class | Turunan Class |
| --------- | ----------- | ---------- | ------------- |
| Public    | ✅           | ✅          | ✅             |
| Private   | ✅           | ❌          | ❌             |
| Protected | ✅           | ❌          | ✅             |

---

## 2.8 Getter dan Setter

```php
<?php
class Produk {
  private $nama;
  private $harga;

  public function __construct($nama, $harga) {
    $this->nama = $nama;
    $this->harga = $harga;
  }

  public function getNama() {
    return $this->nama;
  }

  public function setHarga($harga) {
    if ($harga > 0) $this->harga = $harga;
  }
}
?>
```

👉 Getter & Setter menjaga **enkapsulasi**, agar data lebih aman.

---

## 2.9 Static Method

```php
<?php
class Matematika {
  public static function tambah($a, $b) {
    return $a + $b;
  }
}

echo Matematika::tambah(5, 3); // 8
?>
```

* Dipanggil langsung tanpa object: `NamaClass::namaMethod()`.
* Tidak dapat menggunakan `$this`.
* Cocok untuk fungsi utilitas (perhitungan, konversi, dll).

---

Baik Pak 🙌, berikut saya ambilkan **soal saja (tanpa jawaban)** sesuai versi yang sudah dipermudah:

---

# 📘 Latihan Soal OOP PHP

### Soal 1

Buat class `Produk` dengan property `nama` dan `harga`. Tambahkan method `tampilkanInfo()` untuk menampilkan informasi produk.

---

### Soal 2

Buat class `Mahasiswa` dengan properti:

* `nama` (public)
* `nim` (private)
* `jurusan` (protected)

Tambahkan **getter** dan **setter** untuk mengatur dan mengambil data tersebut.

---

### Soal 3

Buat class `Counter` dengan properti **static** untuk menghitung berapa banyak object yang sudah dibuat.

---

### Soal 4

Buat class `Kendaraan`, lalu buat class `Mobil` yang mewarisi `Kendaraan`, dan `MobilSport` yang mewarisi `Mobil`. Tambahkan method unik di masing-masing class.

---

### Soal 5

Buat class `Converter` dengan **static method** untuk:

* Mengubah suhu dari Celsius ke Fahrenheit.
* Mengubah jarak dari Kilometer ke Meter.

---