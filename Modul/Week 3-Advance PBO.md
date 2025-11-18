# 📘 Advanced OOP PHP

Tujuan mempelajari materi ini adalah agar kita memahami **perancangan sistem** dalam OOP, termasuk salah satu konsep penting yaitu **design pattern**.

---

## 3.1 Abstract Class

### Pengertian

**Abstract class** adalah kelas khusus yang digunakan sebagai **kelas dasar (base class)** untuk kelas turunannya.
Fungsinya adalah **memaksa** kelas turunan agar menyediakan implementasi untuk method tertentu.

➡️ Intinya, abstract class menjadi **template** yang harus diikuti oleh semua class turunannya.

Contoh nyata dalam kehidupan sehari-hari:

* Semua perangkat elektronik pasti punya tombol **power**.
* Bentuknya mungkin berbeda, tapi fungsinya sama, yaitu menyalakan perangkat.

Dalam OOP, konsep ini disebut **polymorphism**: method dengan nama sama, tapi implementasi berbeda sesuai dengan kelasnya.

---

### Contoh Abstract Class

```php
<?php
abstract class Produk {
  // isi class di sini
}

$produk01 = new Produk(); // ❌ Error
```

👉 Hasil:
`Fatal error: Cannot instantiate abstract class Produk`

Kenapa error? Karena **abstract class tidak bisa dibuat object langsung**.
Abstract class hanya berfungsi sebagai **template**, sehingga yang digunakan adalah **class turunan**.

---

### Membuat Class Turunan dari Abstract Class

```php
<?php
abstract class Produk {
}

class Televisi extends Produk {
}

$produk01 = new Televisi(); // ✅ Boleh
```

Di sini class `Televisi` mewarisi `Produk`, dan object dapat dibuat dari `Televisi`.

---

## 3.2 Abstract Method

### Pengertian

* Abstract method adalah method yang hanya dituliskan **nama (signature)** tanpa isi.
* Hanya boleh ditulis di dalam abstract class.
* Implementasi method harus ditulis di class turunan.

---

### Contoh Salah (Error)

```php
<?php
abstract class Produk {
  abstract public function cekHarga() {
    return 3000000; // ❌ Tidak boleh ada isi
  }
}
```

👉 Hasil:
`Fatal error: Abstract function Produk::cekHarga() cannot contain body`

Abstract method **tidak boleh ada implementasi** di class abstract.

---

### Contoh Benar

```php
<?php
abstract class Produk {
  abstract public function cekHarga();
}

class Televisi extends Produk {
  public function cekHarga() {
    return 3000000;
  }
}

$tv = new Televisi();
echo $tv->cekHarga(); // 3000000
```

👉 Kelas turunan `Televisi` wajib menulis ulang (override) method `cekHarga()`.

---

### Beberapa Class Turunan

```php
<?php
abstract class Produk {
  abstract public function cekHarga();
}

class Televisi extends Produk {
  public function cekHarga() {
    return 3000000;
  }
}

class MesinCuci extends Produk {
  public function cekHarga() {
    return 1500000;
  }
}

$tv = new Televisi();
echo $tv->cekHarga(); // 3000000

$mesin = new MesinCuci();
echo $mesin->cekHarga(); // 1500000
```

👉 Setiap class turunan memiliki implementasi `cekHarga()` sendiri.

---

### Abstract Class dengan Property & Method Biasa

```php
<?php
abstract class Produk {
  private $stok = 200;

  abstract public function cekHarga();

  public function cekStok() {
    return $this->stok;
  }
}

class Televisi extends Produk {
  public function cekHarga() {
    return 3000000;
  }
}

$tv = new Televisi();
echo $tv->cekHarga(); // 3000000
echo $tv->cekStok();  // 200
```

👉 Abstract class tetap bisa punya property & method biasa.

---

### Parameter pada Abstract Method

```php
<?php
abstract class Produk {
  abstract public function cekHarga($jumlah);
}

class Televisi extends Produk {
  public function cekHarga($jumlah) {
    return 3000000 * $jumlah;
  }
}

$tv = new Televisi();
echo $tv->cekHarga(2); // 6000000
```

👉 Signature method harus sama. Jika di abstract method ada parameter, maka di class turunan juga harus ada.

---

### Visibility pada Abstract Method

* Visibility harus **sama atau lebih luas** dari abstract method.
* Misalnya, jika `abstract method` diset `public`, maka di turunan juga harus `public`.

Contoh error:

```php
<?php
abstract class Produk {
  abstract public function cekHarga();
}

class Televisi extends Produk {
  protected function cekHarga() { // ❌ Error
    return 3000000;
  }
}
```

👉 Hasil:
`Fatal error: Access level must be public`

---

## 3.3 Polymorphism

**Polymorphism** berarti "banyak bentuk".
Dalam OOP, polymorphism memungkinkan beberapa class turunan memiliki **method dengan nama sama**, tetapi isi/implementasi berbeda.

---

### Contoh Polymorphism

```php
<?php
abstract class Produk {
  abstract public function cekMerek();
}

class Televisi extends Produk {
  public function cekMerek() {
    return "Polytron";
  }
}

class MesinCuci extends Produk {
  public function cekMerek() {
    return "Electrolux";
  }
}

class LemariEs extends Produk {
  public function cekMerek() {
    return "Sharp";
  }
}

$produk1 = new Televisi();
$produk2 = new MesinCuci();
$produk3 = new LemariEs();

echo $produk1->cekMerek(); // Polytron
echo $produk2->cekMerek(); // Electrolux
echo $produk3->cekMerek(); // Sharp
```

👉 Semua class memiliki method `cekMerek()`, tapi hasilnya berbeda-beda.

---

### Polymorphism dengan Function Generik

```php
<?php
<?php

// Interface sebagai kontrak
interface Produk
{
    public function cekMerek(): string;
}

// Kelas Televisi
class Televisi implements Produk
{
    public function cekMerek(): string
    {
        return "Polytron";
    }
}

// Kelas MesinCuci
class MesinCuci implements Produk
{
    public function cekMerek(): string
    {
        return "Electrolux";
    }
}

// Kelas LemariEs
class LemariEs implements Produk
{
    public function cekMerek(): string
    {
        return "Sharp";
    }
}

// Fungsi yang menerima tipe Produk (polymorphic)
function tampilkanMerek(Produk $produk): string
{
    return $produk->cekMerek();
}

// Output
echo tampilkanMerek(new Televisi()) . "\n";    // Output: Polytron
echo tampilkanMerek(new MesinCuci()) . "\n";   // Output: Electrolux
echo tampilkanMerek(new LemariEs()) . "\n";    // Output: Sharp
```

👉 Dengan cara ini, kita bisa membuat function generik yang menerima **object apapun** dari turunan `Produk`.

---

# 📌 Kesimpulan

1. **Abstract Class** → Tidak bisa dibuat object langsung, hanya sebagai template.
2. **Abstract Method** → Harus diimplementasikan di class turunan.
3. **Polymorphism** → Semua turunan punya method dengan nama sama, tapi isi berbeda.
4. **Visibility** → Turunan harus mengikuti atau memperluas visibility dari abstract method.


# 3.2 Interface

### Apa itu Interface?

Interface dalam PHP adalah sebuah mekanisme untuk membuat semacam **kontrak** atau **perjanjian method**. Bisa dibilang interface merupakan bentuk khusus dari **abstract class**.

Secara umum, interface memiliki fungsi yang sama seperti abstract class: yaitu berisi kumpulan **signature method** (nama method + parameter, tanpa isi) yang wajib diimplementasikan oleh class yang memakainya.

➡️ Jadi, setiap class yang menggunakan interface akan **dipaksa** untuk membuat ulang semua method yang ada di dalam interface.

---

### Perbedaan Abstract Class dan Interface

1. **Abstract class** bisa menjadi induk (parent) bagi class lain. Sedangkan **interface** tidak masuk ke dalam hierarki class (tidak ada hubungan child–parent).
2. **Abstract class** bisa berisi: konstanta, property, method biasa, dan abstract method.
   Sedangkan **interface** hanya bisa berisi:

   * signature method
   * konstanta
     Tidak bisa punya property atau method biasa.
3. **Interface** dibuat menggunakan keyword `interface`, dan class yang memakainya menggunakan keyword `implements`.

---

### Kapan Memakai Interface?

* Tujuan interface mirip dengan abstract class, yaitu untuk membuat **desain logika antar class**.
* Bedanya, interface lebih cocok dipakai kalau ada method yang **tidak pantas ditempatkan di abstract class**, tapi tetap harus dimiliki oleh class tertentu.

Contoh kasus:

* Kita sudah punya abstract class `Barang`. Turunannya misalnya `TV`, `Kulkas`, dan `MesinCuci`.
* Beberapa barang bisa **diekspor** ke luar negeri. Maka, dibutuhkan method `getHargaUsd()` (harga dalam USD) dan `getTujuanEkspor()` (daftar negara tujuan).
* Tidak semua produk diekspor, jadi method ini **kurang pas** jika diletakkan langsung di abstract class `Barang`.
* Solusinya: buat **interface** `BarangEkspor` yang berisi method `getHargaUsd()` dan `getTujuanEkspor()`.

---

### Contoh Membuat Interface

```php
<?php
interface BarangEkspor {
  public function getHargaUsd();
  public function getTujuanEkspor();
}
```

* Interface dibuat dengan keyword `interface`.
* Isinya hanya **signature method** (tanpa isi).

---

### Implementasi Interface di Class

```php
<?php
interface BarangEkspor {
  public function getHargaUsd();
  public function getTujuanEkspor();
}

class TV implements BarangEkspor {
  public function getHargaUsd() {
    return 250;
  }

  public function getTujuanEkspor() {
    return ["Singapura", "Malaysia", "Vietnam"];
  }
}

$produkA = new TV();
echo $produkA->getHargaUsd(); // 250
echo "<br>";
echo implode(", ", $produkA->getTujuanEkspor());
```

👉 Hasil output:

```
250
Singapura, Malaysia, Vietnam
```

Keterangan:

* Class `TV` menggunakan interface `BarangEkspor` dengan keyword `implements`.
* Karena menggunakan interface, maka class ini **wajib** membuat ulang kedua method tersebut.
* Fungsi `implode()` digunakan untuk mengubah array menjadi string agar bisa ditampilkan dengan `echo`.

---

### Jika Class Tidak Mengimplementasikan Method Interface

```php
<?php
interface BarangEkspor {
  public function getHargaUsd();
  public function getTujuanEkspor();
}

class MesinCuci implements BarangEkspor {
  // ❌ Tidak membuat ulang method
}
```

👉 Hasil error:

```
Fatal error: Class MesinCuci contains 2 abstract methods and must therefore be 
declared abstract or implement the remaining methods (BarangEkspor::getHargaUsd, BarangEkspor::getTujuanEkspor)
```

---

### Visibility pada Method Interface

* Semua method di dalam interface **wajib public**.
* Tidak boleh `private` atau `protected`.

```php
<?php
interface BarangEkspor {
  private function getHargaUsd();   // ❌ Error
  protected function getTujuanEkspor(); // ❌ Error
}
```

👉 Hasil error:

```
Fatal error: Access type for interface method BarangEkspor::getHargaUsd() must be omitted
```

Atau cukup tanpa menulis visibility, otomatis dianggap `public`:

```php
<?php
interface BarangEkspor {
  function getHargaUsd();
  function getTujuanEkspor();
}
```

---

### Satu Class Bisa Menggunakan Banyak Interface

```php
<?php
interface BarangEkspor {
  public function getHargaUsd();
  public function getTujuanEkspor();
}

interface ProdukMakanan {
  public function getExpired();
}

interface ProdukMakananBeku {
  public function getSuhuMin();
}

class Nugget implements BarangEkspor, ProdukMakanan, ProdukMakananBeku {
  public function getHargaUsd() {
    return 8.5;
  }
  public function getTujuanEkspor() {
    return ["Singapura", "Malaysia", "Thailand"];
  }
  public function getExpired() {
    return "Juni 2026";
  }
  public function getSuhuMin() {
    return -20;
  }
}

$produkB = new Nugget();
echo $produkB->getHargaUsd();
echo "<br>";
echo implode(", ", $produkB->getTujuanEkspor());
echo "<br>";
echo $produkB->getExpired();
echo "<br>";
echo $produkB->getSuhuMin();
```

👉 Hasil output:

```
8.5
Singapura, Malaysia, Thailand
Juni 2026
-20
```

---

### Interface Inheritance

Interface juga bisa **menurunkan** ke interface lain, seperti class dengan `extends`:

```php
<?php
interface BarangEkspor {
  public function getHargaUsd();
  public function getTujuanEkspor();
}

interface ProdukMakanan {
  public function getExpired();
}

interface ProdukMakananBeku extends ProdukMakanan {
  public function getSuhuMin();
}

class Nugget implements BarangEkspor, ProdukMakananBeku {
  public function getHargaUsd() {
    return 9;
  }
  public function getTujuanEkspor() {
    return ["Singapura", "Malaysia"];
  }
  public function getSuhuMin() {
    return -18;
  }
}
```

👉 Hasil error:

```
Fatal error: Class Nugget contains 1 abstract method and must therefore be declared
abstract or implement the remaining methods (ProdukMakanan::getExpired)
```

Kenapa error? Karena interface `ProdukMakananBeku` mewarisi `ProdukMakanan`. Artinya, `Nugget` juga harus membuat ulang method `getExpired()`.

Solusinya

```php
<?php

interface BarangEkspor {
    public function getHargaUsd();
    public function getTujuanEkspor();
}

interface ProdukMakanan {
    public function getExpired();
}

interface ProdukMakananBeku extends ProdukMakanan {
    public function getSuhuMin();
}

class Nugget implements BarangEkspor, ProdukMakananBeku
{
    public function getHargaUsd()
    {
        return 9;
    }

    public function getTujuanEkspor()
    {
        return ["Singapura", "Malaysia"];
    }

    public function getSuhuMin()
    {
        return -18;
    }

    // WAJIB diimplementasi karena warisan dari ProdukMakanan
    public function getExpired()
    {
        return "2025-12-31"; // contoh: format tanggal expired
    }
}

// Contoh penggunaan:
$nugget = new Nugget();
echo "Harga USD: " . $nugget->getHargaUsd() . "\n";
print_r($nugget->getTujuanEkspor());
echo "Suhu Min: " . $nugget->getSuhuMin() . "°C\n";
echo "Expired: " . $nugget->getExpired() . "\n";
```

---

### Interface dengan Konstanta

Interface juga bisa memiliki **konstanta**:

```php
<?php
interface BarangEkspor {
  public function getHargaUsd();
  public function getTujuanEkspor();
  public const PAJAK = 0.5;
}

echo BarangEkspor::PAJAK; // 0.5
```

👉 Konstanta diakses menggunakan `::` seperti pada class biasa.

---

### Penamaan Interface

Nama interface tidak boleh sama dengan nama class.

```php
<?php
interface BarangEkspor {
  public function getHargaUsd();
  public function getTujuanEkspor();
}

class BarangEkspor {
  // ❌ Error
}
```

👉 Hasil error:

```
Fatal error: Cannot declare class BarangEkspor, because the name is already in use
```

---

### Kapan Memakai Abstract Class vs Interface?

* **Abstract class** → Cocok jika method hampir selalu dipakai di semua turunan.
* **Interface** → Cocok jika method hanya digunakan pada sebagian class saja, atau tidak berhubungan langsung dengan struktur turunan class.

---

📌 **Kesimpulan**:

* Interface adalah **kontrak method** yang harus dipenuhi oleh class.
* Tidak bisa memiliki property & method biasa.
* Bisa punya konstanta.
* Class bisa memakai banyak interface sekaligus.
* Bisa terjadi pewarisan antar interface (interface inheritance).

Baik, saya bantu parafrasekan materi **Trait di PHP** agar lebih mudah dipahami, tetap lengkap, dan tidak ada informasi yang hilang. Saya pecah jadi bagian per bagian supaya jelas.

---

## 3.3 Trait

**Trait** adalah solusi di PHP untuk mengatasi keterbatasan *multiple inheritance*.

👉 *Multiple inheritance* artinya sebuah class bisa diturunkan (inheritance) dari **lebih dari satu class**.
Namun, PHP **tidak mendukung multiple inheritance** dan hanya mendukung **single inheritance** (satu class hanya bisa memiliki satu parent).

Mari lihat contoh kode berikut:

```php
<?php
class Televisi {
  public function cekResolusi(){
    return "Full HD";
  }
}

class Smartphone {
  public function cekOS(){
    return "Android 9.0 (Pie)";
  }
}

// ERROR! PHP tidak mendukung multiple inheritance
class SmartTV extends Televisi, Smartphone {
}
```

📌 Penjelasan kode:

* `class Televisi` memiliki method `cekResolusi()` yang mengembalikan teks `"Full HD"`.
* `class Smartphone` memiliki method `cekOS()` yang mengembalikan teks `"Android 9.0 (Pie)"`.
* `class SmartTV` seharusnya menjadi gabungan dari `Televisi` dan `Smartphone`. Karena SmartTV di dunia nyata bisa menampilkan layar (fitur TV) sekaligus menjalankan OS Android (fitur smartphone).

Namun, kode ini akan menghasilkan **error** karena PHP tidak mendukung *multiple inheritance*.

---

### Solusi: Trait

Untuk mengatasi hal ini, PHP versi 5.3 memperkenalkan **Trait**.
Trait mirip seperti *interface*, namun di dalamnya kita bisa langsung menulis **property dan implementasi method**, bukan hanya definisinya saja.

Format dasar trait:

```php
trait NamaTrait {
  public $property1;
  public function method1() {
    // isi method
  }
}
```

Trait bisa dipakai dalam sebuah class dengan keyword `use`.

---

### Contoh penggunaan Trait

```php
<?php
class Televisi {
  public function cekResolusi(){
    return "Full HD";
  }
}

trait SmartElectronic {
  public function cekOS(){
    return "Android 9.0 (Pie)";
  }
}

class SmartTV extends Televisi {
  use SmartElectronic;

  public function cekInfo(){
    return "Smart TV " . $this->cekResolusi() . " - " . $this->cekOS();
  }
}

$produk01 = new SmartTV;
echo $produk01->cekInfo();
```

📌 Output:

```
Smart TV Full HD - Android 9.0 (Pie)
```

➡️ Di sini:

* Trait `SmartElectronic` menggantikan class `Smartphone`.
* Class `SmartTV` mewarisi `Televisi` dan **menggunakan** `SmartElectronic`.
* Method `cekInfo()` menggabungkan hasil dari method parent (`cekResolusi()`) dan trait (`cekOS()`).

---

### Menggunakan Beberapa Trait

```php
<?php
trait SmartElectronic {
  public function cekOS(){
    return "Android 9.0 (Pie)";
  }
}

trait LowWatt {
  public function efisiensi(){
    return "Konsumsi daya 0.8";
  }
}

class SmartTV {
  use SmartElectronic, LowWatt;

  public function cekInfo(){
    return "Smart TV " . $this->cekOS() . " - " . $this->efisiensi();
  }
}

$produk01 = new SmartTV;
echo $produk01->cekInfo();
```

📌 Output:

```
Smart TV Android 9.0 (Pie) - Konsumsi daya 0.8
```

➡️ Dengan `use SmartElectronic, LowWatt`, class `SmartTV` otomatis memiliki method dari kedua trait tersebut.

---

### Prioritas Method

Jika ada method dengan nama sama, urutan prioritasnya adalah:

1. Method di class itu sendiri.
2. Method dari trait.
3. Method dari parent class.

Contoh:

```php
<?php
class Televisi {
  public function efisiensi(){
    return "Konsumsi daya 1.0";
  }
}

trait LowWatt {
  public function efisiensi(){
    return "Konsumsi daya 0.8";
  }
}

class SmartTV extends Televisi {
  use LowWatt;
}

$produk01 = new SmartTV;
echo $produk01->efisiensi();
```

📌 Output:

```
Konsumsi daya 0.8
```

➡️ Trait **lebih diprioritaskan** daripada parent class.
Jika class `SmartTV` juga menuliskan `efisiensi()`, maka method dari class itu sendiri yang dipakai.

---

### Konflik antar Trait

Jika ada **dua trait dengan method sama**, PHP akan bingung.

```php
<?php
trait SmartElectronic {
  public function efisiensi(){
    return "Konsumsi daya 1.1";
  }
}

trait LowWatt {
  public function efisiensi(){
    return "Konsumsi daya 0.8";
  }
}

class SmartTV {
  use SmartElectronic, LowWatt;
}

$produk01 = new SmartTV;
echo $produk01->efisiensi();
```

📌 Output:

```
Fatal error: Trait method efisiensi has not been applied...
```

➡️ Solusinya, gunakan `insteadof` untuk memilih method mana yang dipakai, atau gunakan `as` untuk memberi alias.

---

### Fitur Lain Trait

1. **Trait dalam Trait** → Trait bisa menggunakan trait lain dengan `use`.
2. **Property dalam Trait** → Trait bisa punya property, sama seperti class.
3. **Static Method & Property** → Trait bisa punya method/property static.
4. **Abstract Method dalam Trait** → Trait bisa berisi abstract method yang wajib diimplementasikan di class.
5. **Access Modifier** → Hak akses method dari trait bisa diubah ketika digunakan di class (`as protected`).
6. **Name Collision** → Trait tidak boleh punya nama sama dengan class atau interface.

---

✅ **Kesimpulan:**
Trait di PHP adalah cara untuk menambahkan kembali fleksibilitas seperti *multiple inheritance* tanpa menimbulkan konflik desain. Dengan trait, sebuah class bisa memiliki banyak fitur dari berbagai trait sekaligus, tanpa menulis ulang kode.

# 3.4. Magic Constant

**Magic constant** adalah konstanta bawaan PHP yang berfungsi memberikan informasi tentang kode program yang sedang dijalankan. Penulisannya menggunakan dua garis bawah di depan dan di belakang nama konstanta (double underscore).

Magic constant tidak terbatas hanya pada pemrograman OOP, tapi juga bisa digunakan pada PHP prosedural.

Berikut daftar magic constant yang umum digunakan di PHP:

| Konstanta       | Keterangan                                                  |
| --------------- | ----------------------------------------------------------- |
| `__LINE__`      | Menampilkan nomor baris saat ini.                           |
| `__FILE__`      | Menampilkan lokasi lengkap file beserta namanya.            |
| `__DIR__`       | Menampilkan lokasi folder dari file yang sedang dijalankan. |
| `__FUNCTION__`  | Menampilkan nama fungsi.                                    |
| `__CLASS__`     | Menampilkan nama class.                                     |
| `__TRAIT__`     | Menampilkan nama trait.                                     |
| `__METHOD__`    | Menampilkan nama method.                                    |
| `__NAMESPACE__` | Menampilkan nama namespace.                                 |

Nilai dari magic constant akan menyesuaikan sesuai dengan tempat konstanta tersebut dipanggil.

### Contoh penggunaan (PHP Prosedural)

```php
<?php
echo "Kode ini berada di file: ".__FILE__."<br><br>";
echo "Folder file ini berada di: ".__DIR__."<br><br>";
echo "Perintah ini berada di baris: ".__LINE__."<br><br>";

function contohMagicConstant(){
    return "Fungsi ini bernama: ".__FUNCTION__;
}

echo contohMagicConstant();
```

**Output:**

```
Kode ini berada di file: C:\xampp\htdocs\belajar_oop_php\bab_03\40.magic_constant.php
Folder file ini berada di: C:\xampp\htdocs\belajar_oop_php\bab_03
Perintah ini berada di baris: 4
Fungsi ini bernama: contohMagicConstant
```

---

### Contoh penggunaan (OOP PHP)

```php
<?php
trait HardCover {
    public function cekTrait(){
        return "Method ini berasal dari ".__METHOD__." di dalam trait ".__TRAIT__;
    }
}

class Buku {
    use HardCover;

    public function cekClass(){
        return "Method ini berasal dari ".__METHOD__." di dalam class ".__CLASS__;
    }
}

$produk01 = new Buku();
echo $produk01->cekTrait()."<br>";
echo $produk01->cekClass();
```

**Output:**

```
Method ini berasal dari HardCover::cekTrait di dalam trait HardCover
Method ini berasal dari Buku::cekClass di dalam class Buku
```

---

### Contoh penggunaan `__NAMESPACE__`

```php
<?php
namespace Duniailkom;

class Buku {
    public function cekClass(){
        return "Class ini adalah ".__CLASS__." di dalam namespace ".__NAMESPACE__;
    }
}

$produk01 = new Buku();
echo $produk01->cekClass();
```

**Output:**

```
Class ini adalah Duniailkom\Buku di dalam namespace Duniailkom
```

📌 **Catatan penting**: Magic constant sering digunakan untuk **debugging**. Misalnya, ketika sebuah project besar memiliki banyak class dan method, akan sulit melacak asal error. Dengan bantuan magic constant seperti `__METHOD__`, `__CLASS__`, dan `__LINE__`, kita bisa lebih mudah menelusuri sumber masalah.

---

# 3.5. Magic Method

**Magic method** adalah method khusus di PHP yang otomatis dijalankan ketika kondisi tertentu terjadi. Sama seperti magic constant, penulisannya menggunakan awalan `__` (double underscore).

Beberapa magic method yang sering dipakai:

* `__construct()` → dijalankan otomatis ketika object dibuat.
* `__destruct()` → dijalankan otomatis ketika object dihapus.
* `__toString()` → dijalankan ketika object dipaksa ditampilkan sebagai string.
* `__get()` → dipanggil ketika mengakses property yang tidak ada atau tidak bisa diakses.
* `__set()` → dipanggil ketika mencoba memberikan nilai pada property yang tidak ada atau tidak bisa diakses.

PHP juga memiliki banyak magic method lain (`__call()`, `__invoke()`, `__clone()`, dll), tetapi yang paling sering dipakai adalah yang sudah disebut di atas.

---

### Contoh: Magic Method `__toString()`

```php
<?php
class Produk {
    public function __toString(){
        return "Ini berasal dari class Produk";
    }
}

$produk01 = new Produk();
echo $produk01; 
```

**Output:**

```
Ini berasal dari class Produk
```

Tanpa `__toString()`, kode di atas akan error karena object tidak bisa langsung diubah menjadi string.

---

### Contoh: Magic Method `__get()`

```php
<?php
class Produk {
    public function __get($name){
        return "Property '$name' tidak ditemukan.";
    }
}

$produk01 = new Produk();
echo $produk01->merek; // Property 'merek' tidak ditemukan.
```

Magic method `__get($name)` akan otomatis dipanggil jika kita mencoba mengakses property yang tidak tersedia.

---

### Contoh: Magic Method `__set()`

```php
<?php
class Produk {
    public function __set($name, $value){
        echo "Tidak bisa menetapkan property '$name' dengan nilai '$value'.";
    }
}

$produk01 = new Produk();
$produk01->harga = 150000;
```

**Output:**

```
Tidak bisa menetapkan property 'harga' dengan nilai '150000'.
```

Dengan `__set()`, kita bisa membuat aturan ketika ada usaha menambahkan atau mengubah property yang tidak ada di dalam class.

---

📌 **Kesimpulan:**

* **Magic constant** → memberikan informasi otomatis tentang kode (nama file, baris, class, method, dll).
* **Magic method** → memberikan "reaksi otomatis" ketika object berinteraksi dengan kondisi tertentu (misalnya di-echo, diakses property-nya, atau ditambah property baru).
* Keduanya sangat berguna untuk debugging, logging, atau membuat class lebih fleksibel.

---

# Magic Method `__get()`

`__get()` adalah magic method yang otomatis dijalankan **ketika kita mencoba mengakses property yang tidak tersedia** dalam sebuah class.

Sintaks dasarnya:

```php
public function __get($name)
```

Parameter `$name` akan berisi **nama property** yang coba diakses.

### Contoh penggunaan:

```php
<?php
class Produk {
    public function __get($name){
        return "Property '$name' tidak ditemukan di dalam class.";
    }
}

$produk01 = new Produk();
echo $produk01->merek;
```

**Output:**

```
Property 'merek' tidak ditemukan di dalam class.
```

📌 **Catatan:**
Dengan `__get()`, programmer bisa menambahkan mekanisme error handling atau memberikan nilai default ketika property yang tidak ada dipanggil.

---

### Contoh dengan property private

Magic method ini juga sering dipakai untuk mengakses property yang **bersifat private atau protected**.

```php
<?php
class Produk {
    private $harga = 100000;

    public function __get($name){
        if ($name == "harga") {
            return "Harga produk adalah Rp ".$this->harga;
        }
        return "Property '$name' tidak tersedia.";
    }
}

$produk01 = new Produk();
echo $produk01->harga;
```

**Output:**

```
Harga produk adalah Rp 100000
```

Pada contoh ini, meskipun `$harga` didefinisikan `private`, kita tetap bisa membacanya dari luar class menggunakan `__get()`.

---

# Magic Method `__set()`

`__set()` adalah magic method yang otomatis dijalankan **ketika kita mencoba memberikan nilai pada property yang tidak tersedia atau tidak bisa diakses**.

Sintaks dasarnya:

```php
public function __set($name, $value)
```

* `$name` → nama property yang coba diisi.
* `$value` → nilai yang akan diberikan.

---

### Contoh penggunaan:

```php
<?php
class Produk {
    public function __set($name, $value){
        echo "Tidak bisa menetapkan property '$name' dengan nilai '$value'.";
    }
}

$produk01 = new Produk();
$produk01->warna = "Merah";
```

**Output:**

```
Tidak bisa menetapkan property 'warna' dengan nilai 'Merah'.
```

---

### Contoh dengan property private

`__set()` juga berguna ketika kita ingin **mengatur aturan khusus saat property private diubah**.

```php
<?php
class Produk {
    private $harga;

    public function __set($name, $value){
        if ($name == "harga") {
            if ($value < 0) {
                echo "Harga tidak boleh negatif!<br>";
            } else {
                $this->harga = $value;
                echo "Harga berhasil diset menjadi Rp ".$this->harga."<br>";
            }
        } else {
            echo "Property '$name' tidak tersedia.<br>";
        }
    }
}

$produk01 = new Produk();
$produk01->harga = 150000;   // Valid
$produk01->harga = -50000;   // Tidak valid
$produk01->stok  = 100;      // Property tidak ada
```

**Output:**

```
Harga berhasil diset menjadi Rp 150000
Harga tidak boleh negatif!
Property 'stok' tidak tersedia.
```

📌 **Catatan:**
Dengan `__set()`, kita bisa mengatur **validasi otomatis** saat property diubah.

---

# Kombinasi `__get()` dan `__set()`

Kedua magic method ini biasanya digunakan **bersamaan** untuk mengontrol akses property private dalam sebuah class.

### Contoh lengkap:

```php
<?php
class Produk {
    private $nama;
    private $harga;

    public function __get($name){
        if ($name == "nama") {
            return $this->nama;
        } elseif ($name == "harga") {
            return "Rp ".$this->harga;
        }
        return "Property '$name' tidak tersedia.";
    }

    public function __set($name, $value){
        if ($name == "harga") {
            if ($value < 0) {
                echo "Harga tidak boleh negatif!<br>";
            } else {
                $this->harga = $value;
            }
        } elseif ($name == "nama") {
            $this->nama = $value;
        } else {
            echo "Property '$name' tidak tersedia.<br>";
        }
    }
}

$produk01 = new Produk();
$produk01->nama  = "Buku PHP OOP";   // Menggunakan __set()
$produk01->harga = 120000;           // Menggunakan __set()
echo $produk01->nama."<br>";         // Menggunakan __get()
echo $produk01->harga."<br>";        // Menggunakan __get()
$produk01->stok = 10;                // Property tidak ada
```

**Output:**

```
Buku PHP OOP
Rp 120000
Property 'stok' tidak tersedia.
```

---

# Kesimpulan

* `__get($name)` → otomatis dipanggil saat property yang tidak tersedia/terlindungi **diakses**.
* `__set($name, $value)` → otomatis dipanggil saat property yang tidak tersedia/terlindungi **diubah nilainya**.
* Berguna untuk **enkapsulasi**, **validasi otomatis**, dan **menangani property yang tidak ada**.
* Bisa dipakai sebagai alternatif manual **getter dan setter** dalam OOP PHP.

---

## Latihan Praktikum – Magic Method `__get()` dan `__set()`

### Tujuan

Mahasiswa memahami bagaimana `__get()` dan `__set()` bekerja untuk mengakses atau mengubah properti **private** dalam sebuah class.

---

## 📌 Soal 1 – Percobaan `__set()`

Buat sebuah class `Produk` dengan properti **private**:

* `$nama`
* `$harga`

Tambahkan **magic method `__set($property, $value)`** sehingga ketika mahasiswa mencoba:

```php
$produk1->nama = "Laptop";
$produk1->harga = 7000000;
```

maka nilai tersebut tersimpan di properti private.

👉 **Tugas:** Cetak isi dari `$produk1` dengan `print_r()` untuk melihat hasilnya.

---

## 📌 Soal 2 – Percobaan `__get()`

Gunakan class `Produk` di atas, lalu tambahkan **magic method `__get($property)`** untuk mengambil nilai properti private.

👉 **Tugas:**
Tampilkan informasi berikut:

```
Nama produk: Laptop
Harga produk: 7000000
```

---

## 📌 Soal 3 – Validasi Data

Modifikasi method `__set()` agar **harga tidak boleh kurang dari 0**.
Jika mahasiswa memberikan nilai negatif, maka atur harga menjadi **0** secara otomatis.

👉 **Tugas:**
Uji dengan kode:

```php
$produk2 = new Produk();
$produk2->nama = "Smartphone";
$produk2->harga = -500000;
echo $produk2->harga;
```

Hasil yang diharapkan:

```
0
```

---

## 📌 Soal 4 – Studi Kasus Mini

Buat class `Mahasiswa` dengan properti private:

* `$nama`
* `$nim`
* `$jurusan`

Implementasikan `__get()` dan `__set()`.
Lalu buat object baru dan isi datanya menggunakan `__set()`, kemudian tampilkan kembali menggunakan `__get()`.

👉 **Tugas Tambahan:**
Buat validasi agar panjang NIM **harus 10 digit**. Jika tidak, tampilkan pesan error:

```
Format NIM tidak valid.
```

---

## Magic Method `__call()` dan `__callStatic()` dalam PHP

## 1. Magic Method `__call()`

`__call()` adalah **magic method** yang otomatis dijalankan ketika kita mencoba memanggil sebuah **method yang tidak ada** atau **tidak dapat diakses** dalam sebuah class.

📌 Secara default, PHP akan menampilkan error jika kita memanggil method yang tidak tersedia.
Contoh:

```php
<?php
class Produk {
}

$produk01 = new Produk();
$produk01->tambah(3, 7, 8);
```

🖥️ Hasil:

```
Fatal error: Uncaught Error: Call to undefined method Produk::tambah()
```

Artinya, method `tambah()` tidak ditemukan dalam class `Produk`.

---

### Menggunakan `__call()`

Jika class memiliki method `__call()`, maka pemanggilan method yang tidak ada akan diarahkan ke `__call()`.

```php
<?php
class Produk {
  public function __call($name, $arguments) {
    echo "Maaf, method $name tidak tersedia";
  }
}

$produk01 = new Produk();
$produk01->tambah(3, 7, 8);
```

🖥️ Hasil:

```
Maaf, method tambah tidak tersedia
```

👉 `__call()` menerima 2 parameter:

* `$name` → nama method yang dipanggil
* `$arguments` → argumen yang dikirim dalam bentuk array

---

### Menampilkan Argumen

Kita bisa menampilkan isi argumen dengan `print_r()`:

```php
<?php
class Produk {
  public function __call($name, $arguments) {
    echo "Maaf method $name tidak tersedia <br>";
    print_r($arguments);
  }
}

$produk01 = new Produk();
$produk01->tambah(3, 7, 8);
```

🖥️ Hasil:

```
Maaf method tambah tidak tersedia
Array ( [0] => 3 [1] => 7 [2] => 8 )
```

* `$name` berisi `"tambah"`.
* `$arguments` berisi `[3, 7, 8]`.

Contoh lain:

```php
$produk01->setMerek("Xiaomi","Vivo","Oppo");
```

* `$name` = `"setMerek"`
* `$arguments` = `["Xiaomi","Vivo","Oppo"]`

---

### Mempercantik Output dengan `implode()`

Untuk membuat array argumen lebih rapi, gunakan `implode()`:

```php
<?php
class Produk {
  public function __call($name, $arguments) {
    echo "Maaf method $name dengan argument ". implode(", ", $arguments);
    echo " tidak tersedia <br>";
  }
}

$produk01 = new Produk();
$produk01->tambah(3, 7, 8);
$produk01->setMerek("Xiaomi","Vivo","Oppo");
```

🖥️ Hasil:

```
Maaf method tambah dengan argument 3, 7, 8 tidak tersedia
Maaf method setMerek dengan argument Xiaomi, Vivo, Oppo tidak tersedia
```

---

### `__call()` Tidak Aktif Jika Method Ada

Jika method benar-benar didefinisikan, maka `__call()` tidak dijalankan:

```php
<?php
class Produk {
  public function tambah($a,$b,$c){
    echo "Hasil = ".($a + $b + $c)."<br>";
  }

  public function __call($name,$arguments){
    echo "Maaf method $name dengan argument ". implode(", ",$arguments);
    echo " tidak tersedia <br>";
  }
}

$produk01 = new Produk();
$produk01->tambah(3, 7, 8); 
$produk01->setMerek("Xiaomi","Vivo","Oppo");
```

🖥️ Hasil:

```
Hasil = 18
Maaf method setMerek dengan argument Xiaomi, Vivo, Oppo tidak tersedia
```

📌 Catatan: Jika method `tambah()` dibuat **private**, maka pemanggilan dari luar tetap diarahkan ke `__call()`.

---

## 2. Magic Method `__callStatic()`

`__callStatic()` bekerja mirip dengan `__call()`, tetapi khusus untuk **static method** yang tidak ada.

Tanpa `__callStatic()`, pemanggilan static method yang tidak tersedia akan error:

```php
<?php
class Produk {
  public function __call($name,$arguments){
    echo "Maaf method $name tidak tersedia";
  }
}

Produk::tambah(3, 7, 8);
```

🖥️ Hasil:

```
Fatal error: Uncaught Error: Call to undefined method Produk::tambah()
```

---

### Menggunakan `__callStatic()`

```php
<?php
class Produk {
  public static function __callStatic($name,$arguments){
    echo "Maaf method static $name dengan argument ". implode(", ",$arguments);
    echo " tidak tersedia <br>";
  }
}

Produk::tambah(3, 7, 8);
```

🖥️ Hasil:

```
Maaf method static tambah dengan argument 3, 7, 8 tidak tersedia
```

---

### Menggabungkan `__call()` dan `__callStatic()`

Keduanya bisa dibuat bersamaan:

```php
<?php
class Produk {
  public function __call($name,$arguments){
    echo "Maaf method $name dengan argument ". implode(", ",$arguments);
    echo " tidak tersedia <br>";
  }

  public static function __callStatic($name,$arguments){
    echo "Maaf method static $name dengan argument ". implode(", ",$arguments);
    echo " tidak tersedia <br>";
  }
}

$produk01 = new Produk();
$produk01->tambah(3, 7, 8);

Produk::tambah(3, 7, 8);
```

🖥️ Hasil:

```
Maaf method tambah dengan argument 3, 7, 8 tidak tersedia
Maaf method static tambah dengan argument 3, 7, 8 tidak tersedia
```

---

## 3. Magic Method `__isset()`

`__isset()` dijalankan ketika sebuah property yang **tidak ada** atau **tidak bisa diakses** diperiksa dengan `isset()` atau `empty()`.

🔹 `isset()` → memeriksa apakah variabel terdefinisi dan punya nilai.
🔹 `empty()` → memeriksa apakah variabel bernilai kosong (`0`, `""`, `[]`, atau `NULL`).

Contoh dasar:

```php
<?php
class Produk {
  public $merek = "Sony";
  public $stok;
  public $tipe = "";
}

$produk01 = new Produk();
var_dump(isset($produk01->merek)); // true
var_dump(isset($produk01->stok));  // false
var_dump(isset($produk01->tipe));  // true
```

---

### `__isset()` dengan Properti Non-Public

Jika property dibuat `protected` atau `private`, maka `isset()` akan menganggapnya tidak ada.
Untuk mengatasinya, gunakan `__isset()`:

```php
<?php
class Produk {
  public $merek = "Sony";
  protected $stok = 9;
  private $tipe = "Televisi";

  public function __isset($name) {
    echo "Apakah property '$name' ada? ";
    return isset($this->$name);
  }
}

$produk01 = new Produk();
var_dump(isset($produk01->merek)); 
var_dump(isset($produk01->stok));  
var_dump(isset($produk01->tipe));  
var_dump(isset($produk01->warna));
```

🖥️ Hasil:

```
bool(true)
Apakah property 'stok' ada? bool(true)
Apakah property 'tipe' ada? bool(true)
Apakah property 'warna' ada? bool(false)
```

---

## 4. Magic Method `__unset()`

`__unset()` dijalankan ketika property yang tidak ada (atau tidak bisa diakses) dihapus dengan `unset()`.

```php
<?php
class Produk {
  public $merek = "Sony";

  public function __unset($name){
    echo "Maaf, property $name tidak ada / tidak bisa diakses";
  }
}

$produk01 = new Produk();
unset($produk01->stok);
```

🖥️ Hasil:

```
Maaf, property stok tidak ada / tidak bisa diakses
```

---

## 5. Method Overloading dalam PHP

Di PHP, penggunaan magic method seperti `__get()`, `__set()`, `__isset()`, `__unset()`, `__call()`, dan `__callStatic()` dikenal dengan istilah **overloading**.

➡️ Artinya: membuat property atau method **secara dinamis** (meski sebenarnya tidak ada dalam class).

---

# 🔗 3.6 Method Chaining

## Apa itu Method Chaining?

**Method chaining** adalah teknik pemrograman di mana sebuah **method** dapat dipanggil secara berurutan atau dirangkai seperti sebuah rantai (chain).

Biasanya, jika kita ingin mengisi beberapa properti pada sebuah object, kita menuliskannya seperti ini:

```php
<?php
$produk01 = new Televisi();

$produk01->setMerek("Samsung");
$produk01->setJenisLayar("LED");
$produk01->setUkuranLayar("42");
```

Pada contoh di atas:

* `$produk01` adalah object hasil instansiasi dari class `Televisi`.
* Kita memanggil method setter (`setMerek`, `setJenisLayar`, `setUkuranLayar`) satu per satu.

👉 Cara ini benar, tetapi bisa dibuat lebih ringkas dengan **method chaining**:

```php
<?php
$produk01 = new Televisi();

$produk01->setMerek("Samsung")->setJenisLayar("LED")->setUkuranLayar("42");
```

Kini pemanggilan method bisa ditulis **dalam satu baris** dengan format yang lebih rapi.
Teknik ini populer di banyak **library** dan **framework**. Jika Anda pernah menggunakan **jQuery**, hampir pasti sudah menjumpai method chaining.

---

## Bagaimana Cara Kerjanya?

Agar method bisa disambung (chaining), setiap method harus **mengembalikan object itu sendiri**, yaitu variabel `$this`.

---

## Contoh Pemanggilan Biasa (Reguler)

```php
<?php
class Televisi {
  private $merek;
  private $jenisLayar;
  private $ukuranLayar;

  public function setMerek($merek) {
    $this->merek = $merek;
  }

  public function setJenisLayar($jenisLayar) {
    $this->jenisLayar = $jenisLayar;
  }

  public function setUkuranLayar($ukuranLayar) {
    $this->ukuranLayar = $ukuranLayar;
  }

  public function cekInfo() {
    return "Televisi ".$this->jenisLayar." ".$this->merek." ".$this->ukuranLayar." inch";
  }
}

$produk01 = new Televisi();

$produk01->setMerek("Samsung");
$produk01->setJenisLayar("LED");
$produk01->setUkuranLayar("42");

echo $produk01->cekInfo();
```

🖥️ Output:

```
Televisi LED Samsung 42 inch
```

**Penjelasan:**

* Class `Televisi` memiliki 3 property: `$merek`, `$jenisLayar`, `$ukuranLayar`.
* Ketiga properti diatur melalui method setter.
* Method `cekInfo()` menampilkan semua informasi dalam bentuk string.

---

## Contoh dengan Method Chaining

Sekarang kita ubah agar setiap method setter **mengembalikan `$this`**, sehingga bisa disambung.

```php
<?php
class Televisi {
  private $merek;
  private $jenisLayar;
  private $ukuranLayar;

  public function setMerek($merek) {
    $this->merek = $merek;
    return $this; // mengembalikan object saat ini
  }

  public function setJenisLayar($jenisLayar) {
    $this->jenisLayar = $jenisLayar;
    return $this;
  }

  public function setUkuranLayar($ukuranLayar) {
    $this->ukuranLayar = $ukuranLayar;
    return $this;
  }

  public function cekInfo() {
    return "Televisi ".$this->jenisLayar." ".$this->merek." ".$this->ukuranLayar." inch";
  }
}

$produk01 = new Televisi();
echo $produk01->setMerek("Samsung")->setJenisLayar("LED")->setUkuranLayar("42")->cekInfo();
```

🖥️ Output:

```
Televisi LED Samsung 42 inch
```

📌 Perbedaan utama:

* Di setiap setter ada `return $this;`
* Hal ini memungkinkan method dipanggil berurutan.

---

## Penulisan Multi-Baris

Selain dalam satu baris, method chaining bisa ditulis ke bawah agar lebih rapi:

```php
echo $produk01->setMerek("Samsung")
              ->setJenisLayar("LED")
              ->setUkuranLayar("42")
              ->cekInfo();
```

⚠️ Ingat: tanda `;` harus diletakkan di baris paling bawah, bukan setelah setiap method.

---

## 📌 Latihan Penggunaan

Method chaining banyak dipakai dalam **library database**. Contoh penulisan query dengan teknik chaining:

```php
$mahasiswa01->select("nim, nama")->from("mahasiswa")->where("nim='13012012'");
```

Hasil akhirnya menjadi query SQL:

```sql
SELECT nim, nama FROM mahasiswa WHERE nim = '13012012'
```

👉 Tugas Anda: Buat class `DisplayDatabase` dengan method:

* `select()`
* `from()`
* `where()`
* `getQuery()`

Agar method chaining bisa dilakukan.

---

## Contoh Implementasi

```php
<?php
class DisplayDatabase {
  private $query;

  public function select($column) {
    $this->query = "SELECT $column ";
    return $this;
  }

  public function from($table) {
    $this->query .= "FROM $table ";
    return $this;
  }

  public function where($condition) {
    $this->query .= "WHERE $condition";
    return $this;
  }

  public function getQuery() {
    return $this->query;
  }
}

$mahasiswa01 = new DisplayDatabase();
$mahasiswa01->select("nim, nama")->from("mahasiswa")->where("nim='13012012'");

echo $mahasiswa01->getQuery();
```

🖥️ Output:

```
SELECT nim, nama FROM mahasiswa WHERE nim = '13012012'
```

---

## Kesimpulan

* **Method chaining** memungkinkan method dipanggil berurutan seperti rantai.
* Kuncinya adalah menambahkan `return $this;` pada setiap method.
* Teknik ini sangat berguna untuk membuat kode lebih ringkas, jelas, dan mirip dengan penulisan query database atau konfigurasi dalam framework.


# 3.7. Type Hinting

**Type hinting** adalah fitur di PHP yang berfungsi untuk membatasi tipe data dari parameter yang boleh diterima oleh sebuah *function* atau *method*.

Secara umum, tipe data di PHP terbagi menjadi dua kelompok besar:

1. **Tipe data scalar (dasar)** → integer, float, boolean, string.
2. **Tipe data composite (gabungan)** → array dan object.

Fitur type hinting untuk **composite** (array dan object) sudah ada sejak **PHP 5**, sedangkan untuk **scalar** baru ditambahkan di **PHP 7**.

Kita mulai dengan pembahasan type hinting untuk **array**.

---

## **Array Type Hinting**

Array termasuk tipe data composite, dan sudah bisa menggunakan type hinting sejak PHP 5.1.

Contoh tanpa type hinting:

```php
<?php
function hitungRata2($data){
    return ($data[0] + $data[1] + $data[2]) / 3;
}

echo hitungRata2([3, 6, 12]); // 7
```

➡️ Fungsi `hitungRata2()` memiliki parameter `$data` yang berisi array.
Fungsinya adalah menghitung rata-rata dari tiga elemen pertama array.

Pemanggilan `hitungRata2([3, 6, 12])` menghasilkan output **7** karena (3+6+12)/3.

---

Bagaimana jika argumen yang dikirim **bukan array**?

```php
<?php
function hitungRata2($data){
    return ($data[0] + $data[1] + $data[2]) / 3;
}

echo hitungRata2(3, 6, 12); // 0
```

➡️ Hasilnya 0, padahal jelas tidak masuk akal. PHP tidak menampilkan error, sehingga bisa membingungkan.

Untuk mencegah hal ini, kita gunakan **type hinting**:

```php
<?php
function hitungRata2(array $data){
    return ($data[0] + $data[1] + $data[2]) / 3;
}

echo hitungRata2(3, 6, 12);
```

➡️ Hasil:

```
Fatal error: Uncaught TypeError: Argument 1 passed to hitungRata2() must be of the type array, integer given
```

Dengan menambahkan keyword `array` sebelum parameter, PHP memastikan bahwa `$data` **hanya bisa berisi array**.

---

## **Object Type Hinting**

Prinsip type hinting pada object sama dengan array, hanya saja kita menuliskan **nama class**.

Contoh:

```php
<?php
class Smartphone {
    public $merek;
    public $tipe;
    public $harga;

    public function __construct($merek,$tipe,$harga){
        $this->merek = $merek;
        $this->tipe = $tipe;
        $this->harga = $harga;
    }
}

function tampilkanSmartphone($hp){
    return "Smartphone ".$hp->merek." ".$hp->tipe." dijual seharga Rp. "
         . number_format($hp->harga,2,",",".");
}

$produk01 = new Smartphone("Xiaomi","Redmi Note 6",2799000);
$produk02 = new Smartphone("Samsung","Galaxy S9+",11999000);
$produk03 = new Smartphone("Apple","iPhone X",15700000);

echo tampilkanSmartphone($produk01);
```

➡️ Fungsi `tampilkanSmartphone()` hanya menerima parameter berupa object `Smartphone`.

---

Jika kita membuat class lain, misalnya `Televisi`:

```php
class Televisi {
    public $merek;
    public $tipe;
    public $harga;

    public function __construct($merek,$tipe,$harga){
        $this->merek = $merek;
        $this->tipe = $tipe;
        $this->harga = $harga;
    }
}

function tampilkanSmartphone($hp){
    return "Smartphone ".$hp->merek." ".$hp->tipe." dijual seharga Rp. "
         . number_format($hp->harga,2,",",".");
}

$produk01 = new Televisi("Samsung","LED TV 40 inch UA40M5000",4499000);
echo tampilkanSmartphone($produk01);
```

➡️ Hasil:

```
Smartphone Samsung LED TV 40 inch UA40M5000 dijual seharga Rp. 4.499.000,00
```

Padahal objek tersebut **bukan smartphone**, tapi televisi.

---

### Solusi dengan Object Type Hinting

```php
function tampilkanSmartphone(Smartphone $hp){
    return "Smartphone ".$hp->merek." ".$hp->tipe." dijual seharga Rp. "
         . number_format($hp->harga,2,",",".");
}
```

➡️ Sekarang, jika kita memasukkan object `Televisi`, PHP akan memberikan **error**:

```
Fatal error: Uncaught TypeError: Argument 1 passed to tampilkanSmartphone() must be an instance of Smartphone, instance of Televisi given
```

---

## **Inheritance + Type Hinting**

Untuk menghindari duplikasi function, kita bisa memakai **class induk (parent)** dan **inheritance**:

```php
class Produk {
    public $merek;
    public $tipe;
    public $harga;

    public function __construct($merek,$tipe,$harga){
        $this->merek = $merek;
        $this->tipe = $tipe;
        $this->harga = $harga;
    }
}

class Smartphone extends Produk {}
class Televisi extends Produk {}

function tampilkanProduk(Produk $barang){
    return "Produk ".$barang->merek." ".$barang->tipe." dijual seharga Rp. "
         . number_format($barang->harga,2,",",".");
}
```

➡️ Karena `Smartphone` dan `Televisi` adalah turunan dari `Produk`, maka type hinting `Produk` bisa menerima keduanya.

---

## **Interface + Type Hinting**

Type hinting juga bisa digunakan untuk **interface**:

```php
interface SmartElectronic {
    public function cekOS();
}

class Televisi extends Produk implements SmartElectronic {
    public function cekOS(){
        return "Android 9.0 (Pie)";
    }
}

function tampilkanProduk(SmartElectronic $barang){
    return "Produk ".$barang->merek." ".$barang->tipe.", dengan "
         .$barang->cekOS()." dijual seharga Rp. "
         .number_format($barang->harga,2,",",".");
}
```

➡️ Hanya object yang **mengimplementasikan interface** `SmartElectronic` yang bisa diterima.

---

## **Operator instanceof**

PHP menyediakan operator `instanceof` untuk memeriksa apakah sebuah object termasuk bagian dari class tertentu, interface, atau tidak.

```php
echo var_dump($produk01 instanceof Produk);
```

Hasilnya berupa **true** atau **false**.

---

## **Method Type Hinting**

Type hinting juga berlaku pada **method** di dalam class.

Contoh:

```php
class Perusahaan {
    private $namaPerusahaan;
    private $kotaPerusahaan;

    public function __construct($nama,$kota){
        $this->namaPerusahaan = $nama;
        $this->kotaPerusahaan = $kota;
    }

    public function cekPerusahaan(){
        return $this->namaPerusahaan." dari kota ".$this->kotaPerusahaan;
    }
}

class Smartphone {
    private $merek;
    private $suplier;

    public function __construct($merek, Perusahaan $suplier){
        $this->merek = $merek;
        $this->suplier = $suplier;
    }

    public function cekSmartphone(){
        return "Smartphone ".$this->merek.", disupply oleh ".$this->suplier->cekPerusahaan();
    }
}
```

➡️ Constructor di `Smartphone` hanya bisa menerima object `Perusahaan` sebagai supplier.

Jika tidak, akan muncul error **TypeError**.

---

## **Scalar Type Hinting (PHP 7)**

PHP 7 menambahkan fitur type hinting untuk tipe data dasar: `int`, `float`, `string`, `bool`.

Contoh:

```php
function tambah(int $a, int $b){
    return $a + $b;
}
```

Namun secara default, PHP masih mengizinkan **konversi otomatis** (*type juggling*).

Untuk benar-benar membatasi tipe data, kita harus mengaktifkan **strict mode**:

```php
declare(strict_types=1);
```

Jika tidak sesuai, PHP akan memunculkan **TypeError**.

---

📌 **Kesimpulan:**
Type hinting membantu memastikan parameter function/method memiliki tipe data yang sesuai (array, object, class parent, interface, maupun scalar). Fitur ini meningkatkan keamanan kode dan meminimalisir error yang sulit dilacak.

---

# **3.8. Late Static Binding**

**Late static binding** diperkenalkan di **PHP 5.3** sebagai solusi atas keterbatasan *static method* yang **tidak mendukung konsep inheritance (pewarisan)**.

Topik ini memang sedikit rumit, jadi kita bahas bertahap. Sebelum masuk ke late static binding, kita pelajari dulu apa itu **early binding** dan **late binding**.

---

## **Early Binding**

Secara sederhana:

* **Early binding** artinya PHP sudah tahu hasil akhir method yang dipanggil sejak awal (compile time).
* Dengan kata lain, hasil method bisa langsung ditebak sebelum dijalankan.

Contoh kode:

```php
<?php
class Produk {
    protected $merek = "LG";

    public function cekMerek(){
        return "Produk dengan merek $this->merek tersedia";
    }
}

class MesinCuci extends Produk {
    public function cekMerek(){
        return "Mesin cuci dengan merek $this->merek tersedia";
    }
}

$produk01 = new Produk;
echo $produk01->cekMerek();

echo "<br>";

$produk02 = new MesinCuci;
echo $produk02->cekMerek();
```

**Hasil output:**

```
Produk dengan merek LG tersedia
Mesin cuci dengan merek LG tersedia
```

➡️ Analisis:

* `Produk::cekMerek()` menghasilkan **"Produk dengan merek LG tersedia"**.
* `MesinCuci::cekMerek()` menghasilkan **"Mesin cuci dengan merek LG tersedia"**.

Tanpa menjalankan kodenya pun, kita bisa menebak hasilnya. Itulah yang disebut **early binding** atau **compile-time binding**.

---

## **Late Binding**

Berbeda dengan early binding, pada **late binding**:

* PHP **baru bisa menentukan hasil method saat runtime**.
* Artinya, PHP harus menunggu **object apa** yang memanggil method.

Contoh kode:

```php
<?php
class Produk {
    protected $merek = "LG";

    public function cekMerek(){
        return "Produk dengan merek $this->merek tersedia";
    }

    public function getInfo(){
        return $this->cekMerek();
    }
}

class MesinCuci extends Produk {
    public function cekMerek(){
        return "Mesin cuci dengan merek $this->merek tersedia";
    }
}

$produk01 = new Produk;
echo $produk01->getInfo();

echo "<br>";

$produk02 = new MesinCuci;
echo $produk02->getInfo();
```

**Hasil output:**

```
Produk dengan merek LG tersedia
Mesin cuci dengan merek LG tersedia
```

➡️ Analisis:

* Di class `Produk`, method `getInfo()` memanggil `$this->cekMerek()`.
* Karena `MesinCuci` adalah turunan `Produk`, maka ia juga punya `getInfo()`.
* PHP menunggu siapa object pemanggil:

  * Jika object `Produk` → hasilnya teks produk.
  * Jika object `MesinCuci` → hasilnya teks mesin cuci.

Inilah yang disebut **late binding** (atau runtime binding).

---

## **Masalah di Static Method**

Sekarang coba kita ubah semua property dan method jadi **static**:

```php
<?php
class Produk {
    protected static $merek = "LG";

    public static function cekMerek(){
        return "Produk dengan merek ".self::$merek." tersedia";
    }

    public static function getInfo(){
        return self::cekMerek();
    }
}

class MesinCuci extends Produk {
    public static function cekMerek(){
        return "Mesin cuci dengan merek ".self::$merek." tersedia";
    }
}

echo Produk::getInfo();
echo "<br>";
echo MesinCuci::getInfo();
```

**Hasil output:**

```
Produk dengan merek LG tersedia
Produk dengan merek LG tersedia
```

➡️ Masalahnya:

* Walaupun dipanggil lewat `MesinCuci::getInfo()`, hasilnya tetap **Produk dengan merek LG tersedia**.
* Kenapa? Karena `self::` selalu terikat ke class tempat method didefinisikan (`Produk`), bukan class turunan.
* Itulah sebabnya **static method awalnya tidak mendukung inheritance**.

---

## **Solusi: Late Static Binding dengan `static::`**

PHP memperkenalkan operator baru **`static::`** untuk mengatasi masalah ini.

Kode yang salah:

```php
return self::cekMerek();
```

Kita ubah jadi:

```php
return static::cekMerek();
```

Contoh perbaikan:

```php
<?php
class Produk {
    protected static $merek = "LG";

    public static function cekMerek(){
        return "Produk dengan merek ".self::$merek." tersedia";
    }

    public static function getInfo(){
        return static::cekMerek();
    }
}

class MesinCuci extends Produk {
    public static function cekMerek(){
        return "Mesin cuci dengan merek ".self::$merek." tersedia";
    }
}

echo Produk::getInfo();
echo "<br>";
echo MesinCuci::getInfo();
```

**Hasil output:**

```
Produk dengan merek LG tersedia
Mesin cuci dengan merek LG tersedia
```

➡️ Sekarang hasilnya benar sesuai class pemanggil, karena `static::` menunjuk ke class yang **sedang memanggil method**, bukan hanya ke class induk.

---

## **Kesimpulan**

* **Early binding:** hasil method sudah bisa ditebak sejak awal (compile-time).
* **Late binding:** hasil method ditentukan saat runtime, bergantung pada object pemanggil.
* **Masalah static method:** `self::` selalu terikat ke class induk, sehingga tidak fleksibel dalam inheritance.
* **Late static binding (`static::`):** solusi agar method turunan tetap bisa override method induk meskipun bersifat static.

Walaupun **jarang dipakai dalam praktik sehari-hari**, konsep ini penting dipahami agar tidak bingung saat bekerja dengan inheritance di static method.

Baik, saya sudah pahami arahan Anda. Berikut hasil **parafrase yang disesuaikan agar lebih mudah dipahami, tanpa ada informasi yang dikurangi**:

---

### 3.11. Anonymous Class

Anonymous class adalah class **tanpa nama** (anonym) yang digunakan untuk membuat class **sekali pakai**. Artinya, class ini hanya bisa diinstansiasi **satu kali saja**.

Fitur anonymous class pertama kali diperkenalkan di PHP 7, meskipun konsep ini sudah lebih dulu populer di bahasa pemrograman lain seperti **JavaScript** (misalnya pada jQuery) untuk memberikan nilai input ke sebuah method.

Mari kita lihat contoh dasar penggunaan anonymous class di PHP:

**110.anonymous\_class\_basic.php**

```php
<?php
$produk01 = new class(){};

var_dump($produk01); 
// object(class@anonymous)#1 (0) { }
```

Untuk membuat anonymous class, kita cukup menuliskan `new class(){}`. Pada contoh di atas, hasil dari `var_dump()` menunjukkan bahwa `$produk01` dikenali PHP sebagai object dari `"class@anonymous"`. Karena dibuat langsung saat inisialisasi, object ini **hanya bisa dipakai sekali**.

Anonymous class juga dapat berisi **property** dan **method**, sama seperti class biasa:

**111.anonymous\_class\_property\_method.php**

```php
<?php
$produk01 = new class(){
    private $merek = "Polytron";
    public function getMerek(){
        return $this->merek;
    }
};

echo $produk01->getMerek(); // Polytron
echo $produk01->merek;
// Fatal error: Uncaught Error: Cannot access private property class@anonymous::$merek
```

Pada contoh ini, anonymous class memiliki property `merek` dan method `getMerek()`. Namun karena `merek` bersifat `private`, maka tidak bisa diakses langsung dari luar class. Ini membuktikan bahwa anonymous class bekerja sama seperti class biasa.

Selain itu, anonymous class juga mendukung **constructor**:

**112.anonymous\_class\_construct.php**

```php
<?php
$produk01 = new class("Sony"){
    private $merek;

    public function __construct($foo){
        $this->merek = $foo;
    }

    public function getMerek(){
        return $this->merek;
    }
};

echo $produk01->getMerek(); // Sony
```

Dalam contoh ini, constructor menerima parameter `"Sony"` yang kemudian disimpan pada property `merek`.

Anonymous class juga bisa **mewarisi class lain (inheritance)** dan **mengimplementasikan interface**:

**113.anonymous\_class\_inheritance.php**

```php
<?php
class Produk {
    protected $merek;

    public function __construct($foo){
        $this->merek = $foo;
    }
}

interface PunyaMerek {
    public function getMerek();
}

$produk01 = new class("Hitachi") extends Produk implements PunyaMerek {
    public function getMerek(){
        return $this->merek;
    }
};

echo $produk01->getMerek(); // Hitachi
```

Pada kode di atas, anonymous class mewarisi `Produk` dan mengimplementasikan interface `PunyaMerek`. Karena memakai interface, maka method `getMerek()` harus didefinisikan kembali di dalam anonymous class.

Praktiknya, anonymous class sering dipakai sebagai **input argument** ke dalam sebuah fungsi. Misalnya:

**114.anonymous\_class\_argument.php**

```php
<?php
function tampilkanSmartphone($hp){
    return "Smartphone ".$hp->merek." ".$hp->tipe." dijual seharga Rp. "
    .number_format($hp->harga,2,",",".");
}

echo tampilkanSmartphone(new class{
    public $merek= "Vivo";
    public $tipe= "V11";
    public $harga= "3599000";
});
```

**Hasil output:**

```
Smartphone Vivo V11 dijual seharga Rp. 3.599.000,00
```

Dengan cara ini, kita tidak perlu membuat class baru hanya untuk keperluan sekali pakai. Walau terlihat sedikit rumit, anonymous class bisa menjadi solusi praktis untuk kebutuhan tertentu.

---

Baik Pak 🙌, berikut saya lanjutkan **parafrase materi 3.12 stdClass** agar konsisten dengan gaya sebelumnya:

---

### 3.12. stdClass

Di PHP, ada sebuah class bawaan (default class) bernama **`stdClass`**. Class ini adalah representasi dasar dari sebuah object di PHP. Kita bisa menggunakannya untuk membuat object sederhana tanpa harus mendefinisikan class terlebih dahulu.

Untuk membuat object dari `stdClass`, cukup gunakan operator `new stdClass()`. Setelah itu, kita bisa menambahkan property secara langsung:

**115.stdClass\_basic.php**

```php
<?php
$produk01 = new stdClass();

$produk01->jenis = "Kulkas";
$produk01->merek = "Toshiba";
$produk01->harga = 3200000;

print_r($produk01);
```

**Hasil output:**

```
stdClass Object
(
    [jenis] => Kulkas
    [merek] => Toshiba
    [harga] => 3200000
)
```

Dari hasil di atas, terlihat bahwa `$produk01` otomatis menjadi object bertipe `stdClass`, dengan property `jenis`, `merek`, dan `harga` yang ditambahkan langsung.

Selain membuat object secara manual, `stdClass` juga sering digunakan saat **mengonversi array menjadi object**. Hal ini bisa dilakukan dengan `(object)` casting:

**116.stdClass\_array\_to\_object.php**

```php
<?php
$data = [
    "jenis" => "Mesin Cuci",
    "merek" => "LG",
    "harga" => 2800000
];

$produk02 = (object) $data;

echo $produk02->jenis; // Mesin Cuci
echo "<br>";
echo $produk02->merek; // LG
echo "<br>";
echo $produk02->harga; // 2800000
```

Pada contoh ini, array `$data` dikonversi menjadi object bertipe `stdClass`, sehingga bisa diakses menggunakan notasi object (`->`) bukan lagi indeks array.

Kelebihan `stdClass` adalah fleksibilitasnya. Kita bisa dengan cepat membentuk object tanpa perlu mendefinisikan class baru. Namun, berbeda dengan class biasa, `stdClass` **tidak bisa memiliki method** (kecuali ditambahkan melalui mekanisme lanjutan, seperti closure).

---

👉 Jadi, ringkasnya:

* **Anonymous class** dipakai ketika kita ingin membuat class “sekali pakai” yang bisa memiliki property, method, bahkan constructor.
* **stdClass** adalah class dasar bawaan PHP yang biasanya dipakai untuk membuat object sederhana atau mengonversi array menjadi object.

---

