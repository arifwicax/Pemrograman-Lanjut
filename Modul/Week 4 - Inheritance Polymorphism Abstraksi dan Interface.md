# MODUL PERKULIAHAN

## Mata Kuliah: Pemrograman Lanjut

### Minggu Ke-4: Inheritance, Polymorphism, Abstraksi, dan Interface

# 1. IDENTITAS MATA KULIAH

| Komponen | Keterangan |
| --- | --- |
| Mata Kuliah | Pemrograman Lanjut |
| Minggu | 4 |
| Topik | Inheritance, Polymorphism, Abstraksi, dan Interface |
| Dosen Pengampu | **Arif Wicaksono Septyanto, S.Kom., M.Kom.** |
| Durasi | 1 Pertemuan (3 x 50 menit) |

# 2. SUB-CPMK

> **Mahasiswa mampu mengaplikasikan inheritance, polymorphism, abstraksi dan interface (C3, A4, P2).**

# 3. BAHAN KAJIAN

- Inheritance dengan `extends`.
- Relasi **is-a** pada object turunan.
- Property, method, constructor, dan destructor pada inheritance.
- Method overriding dan penggunaan `parent`.
- Pembatasan pewarisan menggunakan `final`.
- Abstract class dan abstract method.
- Polymorphism melalui parent class atau abstract class.
- Interface dan `implements`.
- Interface inheritance dan implementasi lebih dari satu interface.

Trait, magic method selain `__construct()` dan `__destruct()`, late static binding, dan method chaining tidak menjadi materi inti minggu ini karena tidak dinyatakan dalam Sub-CPMK.

# 4. INDIKATOR PENILAIAN

Mahasiswa mampu:

1. Membuat parent class dan child class menggunakan `extends`.
2. Menjelaskan bahwa object child class tetap termasuk tipe parent class.
3. Melakukan overriding property, method, constructor, dan destructor sesuai kebutuhan.
4. Menggunakan `parent::` untuk memanggil method atau constructor milik parent class.
5. Membuat abstract class dan mengimplementasikan abstract method pada child class.
6. Memproses beberapa object berbeda melalui tipe atau method yang sama.
7. Membuat interface, mengimplementasikannya pada class, dan memahami aturan method interface.

# 5. MATERI PERKULIAHAN

## 5.1 Gambaran Umum OOP Minggu Ke-4

Pada minggu sebelumnya, class digunakan sebagai cetakan object. Pada minggu ini, class tidak hanya berdiri sendiri, tetapi dapat saling berhubungan.

Misalnya, `Monitor`, `MesinCuci`, dan `Speaker` sama-sama termasuk jenis `Perangkat`. Daripada menulis property yang sama berulang-ulang di setiap class, kita dapat membuat class umum bernama `Perangkat`, lalu class lain mewarisi isinya.

Empat konsep utama pada minggu ini adalah:

| Konsep | Makna Singkat |
| --- | --- |
| Inheritance | Child class mewarisi property dan method dari parent class. |
| Overriding | Child class membuat ulang property atau method yang sudah ada di parent class. |
| Abstraksi | Parent class berisi aturan umum, detailnya wajib dilengkapi oleh child class. |
| Interface | Kontrak method yang wajib dimiliki oleh class yang mengimplementasikannya. |
| Polymorphism | Object berbeda dapat diproses dengan cara yang sama selama memiliki kontrak yang sama. |

## 5.2 Inheritance

Inheritance berarti pewarisan. Dalam PHP, inheritance dibuat menggunakan keyword `extends`.

Contoh:

```php
<?php
class Perangkat {
  public $merek = "SagaraElektronik";
  public $stok = 50;

  public function cekStok(){
    return "Sisa stok: ".$this->stok;
  }
}

class Monitor extends Perangkat {
}

$perangkat01 = new Monitor();
echo $perangkat01->merek;       // SagaraElektronik
echo "<br>";
echo $perangkat01->cekStok();   // Sisa stok: 50
```

Penjelasan:

- `Perangkat` adalah parent class.
- `Monitor` adalah child class.
- Karena `Monitor extends Perangkat`, object `Monitor` dapat menggunakan property `$merek`, `$stok`, dan method `cekStok()` dari class `Perangkat`.
- Class `Monitor` tetap boleh kosong jika seluruh kebutuhan awalnya sudah tersedia di parent class.

Dengan inheritance, kode menjadi lebih ringkas karena bagian yang sama cukup ditulis satu kali pada parent class.

## 5.3 Tanpa Inheritance dan Dengan Inheritance

Tanpa inheritance, class yang mirip sering memiliki property yang ditulis berulang-ulang.

```php
<?php
class Monitor {
  public $kodeProduk;
  public $stok;
}

class MesinCuci {
  public $kodeProduk;
  public $stok;
}
```

Kode di atas bisa berjalan, tetapi kurang efisien karena `kodeProduk` dan `stok` ditulis ulang di banyak class.

Dengan inheritance:

```php
<?php
class Perangkat {
  public $kodeProduk;
  public $stok;
}

class Monitor extends Perangkat {
  public $ukuranLayar;
}

class MesinCuci extends Perangkat {
  public $kapasitas;
}

class Speaker extends Perangkat {
  public $konfigurasi;
}
```

Penjelasan:

- Property umum ditempatkan di `Perangkat`.
- Property khusus ditempatkan di masing-masing child class.
- `Monitor` punya `kodeProduk` dan `stok` dari `Perangkat`, serta punya `ukuranLayar` miliknya sendiri.
- `MesinCuci` punya `kodeProduk` dan `stok` dari `Perangkat`, serta punya `kapasitas` miliknya sendiri.

## 5.4 Relasi Is-A

Inheritance membentuk hubungan **is-a**, artinya object child class juga dianggap sebagai object parent class.

Contoh:

```php
<?php
class Perangkat {
  public $kodeProduk;
  public $stok;
}

class Monitor extends Perangkat {
  public $ukuranLayar;
}

class MesinCuci extends Perangkat {
  public $kapasitas;
}

$perangkat01 = new Monitor();
$perangkat02 = new MesinCuci();

var_dump(is_a($perangkat01, 'Perangkat')); // bool(true)
var_dump(is_a($perangkat01, 'Monitor'));   // bool(true)
var_dump(is_a($perangkat02, 'Perangkat')); // bool(true)
var_dump(is_a($perangkat02, 'Monitor'));   // bool(false)
```

Maknanya:

- `Monitor` adalah `Perangkat`.
- `MesinCuci` adalah `Perangkat`.
- Tetapi `MesinCuci` bukan `Monitor`.

Konsep ini penting karena menjadi dasar polymorphism.

## 5.5 Method Overriding

Overriding terjadi ketika child class membuat method dengan nama yang sama seperti method di parent class.

Contoh:

```php
<?php
class Perangkat {
  public function hello(){
    return "Ini dari Perangkat";
  }
}

class Monitor extends Perangkat {
  public function hello(){
    return "Ini dari Monitor";
  }
}

$perangkat01 = new Monitor();
echo $perangkat01->hello(); // Ini dari Monitor
```

Karena object yang dibuat adalah `Monitor`, maka method `hello()` milik `Monitor` yang dijalankan. Method `hello()` dari `Perangkat` tertimpa oleh method `hello()` dari child class.

Overriding berguna ketika child class membutuhkan perilaku yang lebih khusus dibanding parent class.

## 5.6 Menggunakan `parent::`

Kadang child class tidak ingin mengganti seluruh isi method parent, tetapi hanya ingin menambahkan perilaku baru. Untuk memanggil method parent class dari child class, gunakan `parent::`.

Contoh:

```php
<?php
class Perangkat {
  public function deskripsi(){
    return "Perangkat elektronik";
  }
}

class Monitor extends Perangkat {
  public function deskripsi(){
    return parent::deskripsi()." berupa monitor";
  }
}

$perangkat01 = new Monitor();
echo $perangkat01->deskripsi(); // Perangkat elektronik berupa monitor
```

Penjelasan:

- `parent::deskripsi()` memanggil method `deskripsi()` milik `Perangkat`.
- Child class `Monitor` menambahkan teks `" berupa monitor"`.
- Hasil akhirnya merupakan gabungan dari perilaku parent dan child.

## 5.7 Constructor pada Inheritance

Constructor adalah method khusus `__construct()` yang otomatis dijalankan saat object dibuat.

Contoh:

```php
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

$perangkat01 = new Perangkat("Monitor", "NusaTech", 20);

echo "<pre>";
print_r($perangkat01);
echo "</pre>";
```

Jika child class tidak membuat constructor sendiri, constructor parent class akan digunakan.

```php
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
}

$perangkat01 = new Monitor("Monitor", "NusaTech", 20);
```

Namun, jika child class membuat constructor sendiri, constructor parent tidak otomatis dijalankan.

```php
<?php
class Monitor extends Perangkat {
  public function __construct(){
  }
}
```

Pada kondisi tersebut, parameter yang dikirim saat membuat object `Monitor` tidak lagi diproses oleh constructor `Perangkat`.

Jika tetap ingin memakai constructor parent, panggil dengan `parent::__construct()`.

```php
<?php
class Monitor extends Perangkat {
  public $ukuranLayar;

  public function __construct($jenis, $merek, $stok, $ukuranLayar){
    parent::__construct($jenis, $merek, $stok);
    $this->ukuranLayar = $ukuranLayar;
  }
}

$perangkat01 = new Monitor("Monitor", "NusaTech", 20, "24 inch");
```

## 5.8 Destructor pada Inheritance

Destructor adalah method khusus `__destruct()` yang otomatis dijalankan ketika object selesai digunakan atau program berakhir.

Contoh:

```php
<?php
class Perangkat {
  public function __destruct(){
    echo "Object Perangkat selesai digunakan";
  }
}

class Monitor extends Perangkat {
}

$perangkat01 = new Monitor();
```

Jika child class membuat `__destruct()` sendiri, maka destructor parent dapat tertimpa. Jika perilaku parent masih dibutuhkan, panggil `parent::__destruct()`.

```php
<?php
class Monitor extends Perangkat {
  public function __destruct(){
    echo "Object Monitor selesai digunakan";
    parent::__destruct();
  }
}
```

## 5.9 Final Class dan Final Method

Keyword `final` digunakan untuk membatasi pewarisan atau overriding.

Final method tidak boleh dioverride:

```php
<?php
class Perangkat {
  final public function hello(){
    return "Ini dari Perangkat";
  }
}

class Monitor extends Perangkat {
  public function hello(){
    return "Ini dari Monitor";
  }
}

// Fatal error: Cannot override final method Perangkat::hello()
```

Final class tidak boleh diturunkan:

```php
<?php
final class Perangkat {
}

class Monitor extends Perangkat {
}

// Fatal error: Class Monitor cannot extend final class Perangkat
```

Gunakan `final` jika suatu class atau method memang tidak boleh diubah perilakunya oleh class lain.

## 5.10 Abstract Class

Abstract class adalah class yang tidak dapat dibuat object secara langsung. Abstract class biasanya dipakai sebagai class dasar yang berisi konsep umum.

Contoh:

```php
<?php
abstract class Perangkat {
}

$perangkat01 = new Perangkat();
// Fatal error: Cannot instantiate abstract class Perangkat
```

Artinya, `Perangkat` hanya boleh menjadi parent class, bukan object langsung.

```php
<?php
abstract class Perangkat {
}

class Monitor extends Perangkat {
}

$perangkat01 = new Monitor();
```

Object yang dibuat adalah `Monitor`, bukan `Perangkat`.

## 5.11 Abstract Method

Abstract method adalah method yang hanya ditulis nama dan parameternya, tanpa isi method.

Contoh yang salah:

```php
<?php
abstract class Perangkat {
  abstract public function cekHarga(){
    return 3000000;
  }
}

// Fatal error: Abstract function cannot contain body
```

Abstract method tidak boleh memiliki body karena isi method wajib dibuat oleh child class.

Contoh yang benar:

```php
<?php
abstract class Perangkat {
  abstract public function cekHarga();
}

class Monitor extends Perangkat {
  public function cekHarga(){
    return 3000000;
  }
}

$perangkat01 = new Monitor();
echo $perangkat01->cekHarga(); // 3000000
```

Aturan penting abstract method:

- Jika parent class memiliki abstract method, child class wajib mengimplementasikan method tersebut.
- Nama method pada child class harus sama.
- Parameter method harus sesuai dengan abstract method.
- Visibility tidak boleh lebih sempit dari abstract method parent.

Contoh dengan parameter:

```php
<?php
abstract class Perangkat {
  abstract public function cekHarga($kuantitas);
}

class Monitor extends Perangkat {
  public function cekHarga($kuantitas){
    return 3000000 * $kuantitas;
  }
}

$perangkat01 = new Monitor();
echo $perangkat01->cekHarga(2); // 6000000
```

## 5.12 Abstract Class Turunan

Child class dari abstract class juga boleh dibuat abstract. Jika begitu, implementasi abstract method dapat ditunda ke class turunannya lagi.

```php
<?php
abstract class Perangkat {
  abstract public function cekHarga();
}

abstract class Monitor extends Perangkat {
  abstract public function cekTipe();
}

class TelevisiLED extends Monitor {
  public function cekHarga(){
    return 3000000;
  }

  public function cekTipe(){
    return "TV LED";
  }
}

$perangkat01 = new TelevisiLED();
echo $perangkat01->cekHarga(); // 3000000
echo "<br>";
echo $perangkat01->cekTipe();  // TV LED
```

Pada contoh tersebut:

- `Perangkat` memiliki abstract method `cekHarga()`.
- `Monitor` masih abstract dan menambahkan abstract method `cekTipe()`.
- `TelevisiLED` adalah class konkret, sehingga wajib mengisi `cekHarga()` dan `cekTipe()`.

## 5.13 Polymorphism

Polymorphism berarti "banyak bentuk". Dalam OOP, polymorphism memungkinkan object yang berbeda diproses dengan cara yang sama selama object tersebut memiliki method yang dibutuhkan.

Contoh:

```php
<?php
abstract class Perangkat {
  abstract public function cekMerek();
}

class Monitor extends Perangkat {
  public function cekMerek(){
    return "ArunikaDigital";
  }
}

class MesinCuci extends Perangkat {
  public function cekMerek(){
    return "Electrolux";
  }
}

class LemariEs extends Perangkat {
  public function cekMerek(){
    return "SagaraElektronik";
  }
}

$perangkat01 = new Monitor();
$perangkat02 = new MesinCuci();
$perangkat03 = new LemariEs();

echo $perangkat01->cekMerek()."<br>"; // ArunikaDigital
echo $perangkat02->cekMerek()."<br>"; // Electrolux
echo $perangkat03->cekMerek()."<br>"; // SagaraElektronik
```

Ketiga class berbeda, tetapi semuanya memiliki method `cekMerek()` karena sama-sama turunan dari `Perangkat`.

Contoh polymorphism dalam function:

```php
<?php
function tampilkanMerek($objectProduk){
  return $objectProduk->cekMerek()."<br>";
}

echo tampilkanMerek($perangkat01); // ArunikaDigital
echo tampilkanMerek($perangkat02); // Electrolux
echo tampilkanMerek($perangkat03); // SagaraElektronik
```

Function `tampilkanMerek()` dapat menerima `Monitor`, `MesinCuci`, atau `LemariEs`, selama object tersebut memiliki method `cekMerek()`.

Agar lebih aman, parameter function dapat diberi type hint:

```php
<?php
function tampilkanMerek(Perangkat $objectProduk){
  return $objectProduk->cekMerek()."<br>";
}
```

Dengan type hint `Perangkat`, function hanya menerima object yang merupakan turunan dari `Perangkat`.

## 5.14 Interface

Interface adalah kontrak. Jika sebuah class menggunakan interface, class tersebut wajib memiliki semua method yang ditentukan oleh interface.

Interface dibuat dengan keyword `interface`, sedangkan class menggunakannya dengan keyword `implements`.

Contoh:

```php
<?php
interface ProdukEkspor {
  public function cekHargaUsd();
  public function cekNegara();
}

class Monitor implements ProdukEkspor {
  public function cekHargaUsd(){
    return 185;
  }

  public function cekNegara(){
    return ["Singapura", "Malaysia", "Thailand"];
  }
}

$perangkat01 = new Monitor();
echo $perangkat01->cekHargaUsd();
echo "<br>";
echo implode(", ", $perangkat01->cekNegara());
```

Penjelasan:

- `ProdukEkspor` menentukan bahwa class harus memiliki method `cekHargaUsd()` dan `cekNegara()`.
- `Monitor implements ProdukEkspor` berarti `Monitor` berjanji menyediakan kedua method tersebut.
- Jika salah satu method tidak dibuat, program akan error.

## 5.15 Aturan Interface

Beberapa aturan penting interface:

1. Method pada interface tidak memiliki body.
2. Method interface harus bersifat `public`.
3. Class yang menggunakan interface wajib mengimplementasikan semua method interface.
4. Satu class boleh mengimplementasikan lebih dari satu interface.
5. Interface boleh mewarisi interface lain menggunakan `extends`.

Contoh visibility yang salah:

```php
<?php
interface DapatDikirim {
  private function hitungBiayaDolar();
  protected function daftarTujuan();
}

// Fatal error: access type method pada interface harus public.
```

Contoh implementasi lebih dari satu interface:

```php
<?php
interface ProdukEkspor {
  public function cekHargaUsd();
  public function cekNegara();
}

interface ProdukMakanan {
  public function cekExpired();
}

interface ProdukMakananBeku {
  public function cekSuhuMin();
}

class Nugget implements ProdukEkspor, ProdukMakanan, ProdukMakananBeku {
  public function cekHargaUsd(){
    return 7.5;
  }

  public function cekNegara(){
    return ["Singapura", "Malaysia", "Thailand"];
  }

  public function cekExpired(){
    return "April 2019";
  }

  public function cekSuhuMin(){
    return -14;
  }
}
```

PHP tidak mendukung multiple inheritance antar class:

```php
<?php
class Monitor {
}

class Smartphone {
}

class SmartTV extends Monitor, Smartphone {
}

// Parse error: syntax error, unexpected ',', expecting '{'
```

Solusinya, gunakan satu parent class dengan `extends`, lalu gunakan satu atau lebih interface dengan `implements`.

```php
<?php
class Monitor {
}

interface DapatTerhubungInternet {
  public function koneksiInternet();
}

interface MemilikiAplikasi {
  public function daftarAplikasi();
}

class SmartTV extends Monitor implements DapatTerhubungInternet, MemilikiAplikasi {
  public function koneksiInternet(){
    return "Terhubung WiFi";
  }

  public function daftarAplikasi(){
    return ["YouTube", "Netflix"];
  }
}
```

## 5.16 Interface Inheritance

Interface juga dapat mewarisi interface lain.

```php
<?php
interface DapatDikirim {
  public function hitungBiayaDolar();
  public function daftarTujuan();
}

interface PanganTersimpan {
  public function cekKedaluwarsa();
}

interface PanganBeku extends PanganTersimpan {
  public function suhuMinimum();
}

class PaketSayuran implements DapatDikirim, PanganBeku {
  public function hitungBiayaDolar(){
    return 8.25;
  }

  public function daftarTujuan(){
    return ["Brunei", "Vietnam", "Filipina"];
  }

  public function cekKedaluwarsa(){
    return "Desember 2026";
  }

  public function suhuMinimum(){
    return -16;
  }
}
```

Karena `PanganBeku extends PanganTersimpan`, class `PaketSayuran` wajib mengimplementasikan:

- `suhuMinimum()` dari `PanganBeku`.
- `cekKedaluwarsa()` dari `PanganTersimpan`.

## 5.17 Perbedaan Abstract Class dan Interface

Abstract class dan interface sama-sama dapat dipakai sebagai kontrak, tetapi tujuannya berbeda.

| Aspek | Abstract Class | Interface |
| --- | --- | --- |
| Keyword | `abstract class` | `interface` |
| Digunakan oleh class dengan | `extends` | `implements` |
| Jumlah yang bisa dipakai class | Satu parent class | Bisa lebih dari satu interface |
| Isi method | Bisa abstract dan non-abstract | Umumnya hanya kontrak method |
| Property | Bisa memiliki property | Tidak dipakai untuk menyimpan state object |
| Cocok untuk | Hubungan "adalah bagian dari keluarga yang sama" | Kemampuan atau kontrak yang bisa dimiliki banyak class |

Contoh pemilihan:

- Gunakan abstract class `Perangkat` jika `Monitor`, `MesinCuci`, dan `LemariEs` memang satu keluarga perangkat.
- Gunakan interface `ProdukEkspor` jika berbagai class berbeda bisa memiliki kemampuan diekspor.
- Gunakan interface `DapatDikirim` jika berbagai object perlu diproses oleh sistem pengiriman.

## 5.18 Alur Berpikir Saat Mendesain Class

Saat membuat program berbasis OOP, gunakan pertanyaan berikut:

1. Apakah beberapa class memiliki property atau method yang sama? Jika ya, pertimbangkan parent class.
2. Apakah child class membutuhkan perilaku yang berbeda dari parent class? Jika ya, gunakan overriding.
3. Apakah parent class terlalu umum untuk dibuat object langsung? Jika ya, jadikan abstract class.
4. Apakah ada method yang wajib dimiliki semua child class, tetapi detailnya berbeda? Jika ya, gunakan abstract method.
5. Apakah beberapa class berbeda perlu memiliki kemampuan yang sama, meskipun bukan satu keluarga? Jika ya, gunakan interface.
6. Apakah function perlu menerima banyak jenis object dengan cara proses yang sama? Jika ya, gunakan polymorphism dengan type hint parent class atau interface.

## 5.19 Kesalahan Umum

| Kesalahan | Penyebab | Solusi |
| --- | --- | --- |
| Membuat object dari abstract class | Abstract class tidak bisa diinstansiasi | Buat object dari child class konkret |
| Abstract method diberi isi | Abstract method hanya kontrak | Hapus body method |
| Child class tidak mengisi abstract method | Kontrak parent belum dipenuhi | Implementasikan semua abstract method |
| Signature method child berbeda | Parameter atau return type tidak cocok | Samakan signature dengan parent/interface |
| Method interface dibuat private/protected | Method interface harus public | Gunakan `public` |
| Meng-extend dua class sekaligus | PHP tidak mendukung multiple inheritance class | Gunakan satu `extends` dan beberapa `implements` |
| Mengubah method `final` | Final method tidak boleh dioverride | Jangan override method tersebut |

# 6. CONTOH STUDI KASUS

## 6.1 Studi Kasus: Data Perangkat

Program berikut menggabungkan inheritance, abstract class, polymorphism, dan interface.

```php
<?php
abstract class Perangkat {
  protected $merek;
  protected $stok;

  public function __construct($merek, $stok){
    $this->merek = $merek;
    $this->stok = $stok;
  }

  public function cekStok(){
    return "Sisa stok ".$this->merek.": ".$this->stok;
  }

  abstract public function cekKategori();
}

interface ProdukEkspor {
  public function cekHargaUsd();
  public function cekNegara();
}

class Monitor extends Perangkat implements ProdukEkspor {
  private $ukuranLayar;

  public function __construct($merek, $stok, $ukuranLayar){
    parent::__construct($merek, $stok);
    $this->ukuranLayar = $ukuranLayar;
  }

  public function cekKategori(){
    return "Monitor ".$this->ukuranLayar;
  }

  public function cekHargaUsd(){
    return 185;
  }

  public function cekNegara(){
    return ["Singapura", "Malaysia", "Thailand"];
  }
}

class MesinCuci extends Perangkat {
  public function cekKategori(){
    return "Mesin Cuci";
  }
}

function tampilkanPerangkat(Perangkat $perangkat){
  echo $perangkat->cekKategori()."<br>";
  echo $perangkat->cekStok()."<br>";
}

$monitor = new Monitor("ArunikaDigital", 15, "24 inch");
$mesinCuci = new MesinCuci("Electrolux", 8);

tampilkanPerangkat($monitor);
tampilkanPerangkat($mesinCuci);

echo "Harga ekspor monitor: ".$monitor->cekHargaUsd()." USD<br>";
echo "Tujuan ekspor: ".implode(", ", $monitor->cekNegara());
```

Konsep yang muncul:

- `Perangkat` adalah abstract class karena terlalu umum untuk dibuat object langsung.
- `Monitor` dan `MesinCuci` mewarisi property serta method dari `Perangkat`.
- `cekKategori()` adalah abstract method yang wajib diisi oleh child class.
- `Monitor` mengimplementasikan interface `ProdukEkspor`.
- Function `tampilkanPerangkat()` memakai polymorphism karena bisa menerima object `Monitor` maupun `MesinCuci`.

# 7. LATIHAN

## Latihan 1: Inheritance Dasar

Buat class `Produk` dengan property:

- `$nama`
- `$harga`
- `$stok`

Buat child class:

- `Buku`
- `Elektronik`

Tambahkan property khusus:

- `Buku` memiliki `$penulis`
- `Elektronik` memiliki `$garansi`

Buat object dari masing-masing class dan tampilkan semua datanya.

## Latihan 2: Overriding

Buat parent class `Karyawan` dengan method `hitungGaji()` yang mengembalikan nilai gaji pokok.

Buat child class:

- `KaryawanTetap`
- `KaryawanKontrak`

Override method `hitungGaji()` pada masing-masing child class agar perhitungan gajinya berbeda.

## Latihan 3: Abstract Class

Buat abstract class `BangunDatar` dengan abstract method:

```php
abstract public function hitungLuas();
```

Implementasikan pada class:

- `Persegi`
- `Lingkaran`
- `Segitiga`

Buat object dari ketiga class tersebut, lalu tampilkan luasnya.

## Latihan 4: Polymorphism

Lanjutkan Latihan 3. Buat function:

```php
function tampilkanLuas(BangunDatar $bangunDatar){
  echo $bangunDatar->hitungLuas()."<br>";
}
```

Panggil function tersebut menggunakan object `Persegi`, `Lingkaran`, dan `Segitiga`.

## Latihan 5: Interface

Buat interface `DapatDibayar` dengan method:

```php
public function bayar($jumlah);
```

Buat class:

- `TransferBank`
- `DompetDigital`
- `KartuKredit`

Setiap class harus mengimplementasikan method `bayar()` dengan pesan yang berbeda.

Contoh output:

```text
Pembayaran transfer bank sebesar 150000 berhasil.
Pembayaran dompet digital sebesar 150000 berhasil.
Pembayaran kartu kredit sebesar 150000 berhasil.
```

# 8. RANGKUMAN

- Inheritance memungkinkan child class mewarisi property dan method dari parent class.
- Relasi inheritance membentuk hubungan **is-a**.
- Overriding digunakan ketika child class perlu mengganti perilaku parent class.
- `parent::` digunakan untuk memanggil method atau constructor milik parent class.
- `final` digunakan untuk mencegah class diturunkan atau method dioverride.
- Abstract class tidak dapat dibuat object langsung.
- Abstract method wajib diimplementasikan oleh child class konkret.
- Polymorphism memungkinkan beberapa object berbeda diproses dengan cara yang sama.
- Interface adalah kontrak method yang wajib dipenuhi oleh class.
- PHP tidak mendukung multiple inheritance antar class, tetapi mendukung implementasi banyak interface.
