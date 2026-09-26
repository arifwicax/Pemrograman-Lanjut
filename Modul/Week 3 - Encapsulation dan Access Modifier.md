# MODUL PERKULIAHAN

## Mata Kuliah: Pemrograman Lanjut

### Minggu Ke-3: Encapsulation dan Access Modifier

# 1. IDENTITAS MATA KULIAH

| Komponen       | Keterangan                                         |
| -------------- | -------------------------------------------------- |
| Mata Kuliah    | Pemrograman Lanjut                                 |
| Minggu         | 3                                                  |
| Topik          | Encapsulation dan Access Modifier                  |
| Dosen Pengampu | **Arif Wicaksono Septyanto, S.Kom., M.Kom.** |
| Durasi         | 1 Pertemuan (3 × 50 menit)                        |

# 2. SUB-CPMK

> **Mahasiswa mampu mengaplikasikan konsep encapsulation, dan access modifier (C3, A4, P2).**

# 3. BAHAN KAJIAN

- Tujuan encapsulation dan konsistensi state object.
- Access modifier `public`, `protected`, dan `private` pada property dan method.
- Perbandingan akses langsung dengan akses melalui getter dan setter.
- Validasi tipe dan nilai pada setter.
- Pemrosesan nilai keluaran pada getter.
- Penggunaan setter private melalui constructor.
- Validasi kode produk dan stok.

Pewarisan diperkenalkan secara terbatas melalui `Perangkat` dan `Laptop` untuk memperlihatkan perbedaan `protected` dan `private`, sesuai script 47–48. Pembahasan utama inheritance dan overriding tetap berada pada Minggu 4.

# 4. INDIKATOR PENILAIAN

Mahasiswa mampu:

1. Menjelaskan alasan property tidak selalu dibuat `public`.
2. Memilih access modifier sesuai kebutuhan akses property dan method.
3. Menjelaskan penyebab kesalahan akses dari luar class dan dari class turunan.
4. Membuat getter dan setter untuk mengendalikan akses data.
5. Menerapkan validasi tipe dan nilai sebelum mengubah state object.
6. Mengolah nilai keluaran melalui getter tanpa mengubah nilai property.
7. Menggunakan constructor untuk memanggil setter private.
8. Memvalidasi kode produk dan stok serta menjelaskan alur ketika input ditolak.

# 5. MATERI PERKULIAHAN

## 5.1. Encapsulation dan State Object

**Encapsulation (enkapsulasi)** adalah konsep dalam **Object-Oriented Programming (OOP)** untuk  **membungkus data (property) dan fungsi (method) dalam sebuah class serta mengatur bagaimana data tersebut dapat diakses atau diubah dari luar class** .

**State object** adalah kumpulan nilai property pada suatu saat. Pada class `Perangkat`, state dapat berupa merek `BorneoSistem` dan stok `10`. Jika aturan stok mengharuskan bilangan bulat positif, nilai seperti `"Satu"`, `10.5`, dan `-5` harus ditolak sebelum disimpan.

Encapsulation membantu:

- Membatasi perubahan langsung dari kode di luar class.
- Memusatkan pemeriksaan input agar aturan tidak tersebar di banyak tempat.
- Mempertahankan nilai lama ketika perubahan tidak valid ditolak.
- Memisahkan cara penyimpanan data dari cara data ditampilkan.

Property `private` saja belum menjamin data valid. Method yang mengubahnya juga harus menerapkan aturan yang dibutuhkan.

## 5.2. Access Modifier: `public`, `protected`, dan `private`

Access modifier menentukan dari konteks mana sebuah property atau method boleh diakses.

| Modifier      | Dari class yang mendeklarasikan | Dari class turunan    | Dari luar class |
| ------------- | ------------------------------- | --------------------- | --------------- |
| `public`    | Ya                              | Ya                    | Ya              |
| `protected` | Ya                              | Ya                    | Tidak           |
| `private`   | Ya                              | Tidak secara langsung | Tidak           |

### A. Akses public

Pada script `43.visibility_public.php`, property dideklarasikan menggunakan `var`. Dalam contoh tersebut, `var $merek` memiliki visibilitas public. Untuk memperjelas maksud kode, deklarasi dapat ditulis sebagai `public $merek`.

```php
<?php
class Perangkat {
    public $merek;

    public function hello() {
        return "Ini adalah Perangkat";
    }
}

$perangkat01 = new Perangkat();
$perangkat01->merek = "MerapiKomputasi";
echo $perangkat01->merek;
echo "<br>";
echo $perangkat01->hello();
```

Keluaran di browser:

```text
MerapiKomputasi
Ini adalah Perangkat
```

Kode di luar class dapat mengisi dan membaca `$merek`, serta memanggil `hello()` secara langsung.

### B. Akses private

Pada script `44.visibility_private_error.php`, `$merek` dan `hello()` bersifat private. Operasi berikut dari luar class tidak diizinkan:

```php
$perangkat01->merek = "MerapiKomputasi";
echo $perangkat01->merek;
echo $perangkat01->hello();
```

Penulisan dan pembacaan property memicu `Cannot access private property Perangkat::$merek`, sedangkan pemanggilan method memicu `Call to private method Perangkat::hello()`.

**Program berhenti pada kesalahan pertama yang tidak ditangani.** Untuk mengamati setiap kesalahan, jalankan operasi tersebut satu per satu dengan menonaktifkan operasi lain.

Script `45.visibility_private.php` menyediakan method public untuk mengakses property private:

```php
<?php
class Perangkat {
    private $merek;

    public function setMerek($merek) {
        $this->merek = $merek;
    }

    public function getMerek() {
        return $this->merek;
    }
}

$perangkat01 = new Perangkat();
$perangkat01->setMerek("MerapiKomputasi");
echo $perangkat01->getMerek(); // MerapiKomputasi
```

Akses terhadap `$this->merek` diizinkan karena berlangsung di dalam class `Perangkat`. Kode pemanggil menggunakan method public yang disediakan class.

### C. Akses protected dan perbandingan pada class turunan

Script `46.visibility_protected.php` menunjukkan bahwa property dan method protected juga tidak dapat diakses langsung dari luar class. Seperti pada script 44, eksekusi berhenti pada pelanggaran akses pertama.

Perbedaannya terlihat pada script `47.visibility_inheritance_protected.php`:

```php
<?php
class Perangkat {
    protected $merek = "MerapiKomputasi";

    protected function hello() {
        return "Ini adalah Perangkat";
    }
}

class Laptop extends Perangkat {
    public function helloLaptop() {
        return $this->hello() . " Laptop " . $this->merek;
    }
}

$perangkat01 = new Laptop();
echo $perangkat01->helloLaptop();
// Ini adalah Perangkat Laptop MerapiKomputasi
```

`extends` menyatakan bahwa `Laptop` merupakan class turunan `Perangkat`. Method `helloLaptop()` dapat mengakses anggota protected milik induknya, lalu menyediakan hasil melalui method public.

Pada script `48.visibility_inheritance_private.php`, kedua anggota induk tersebut menjadi private. Pemanggilan `$this->hello()` dari konteks `Laptop` gagal dengan pesan `Call to private method Perangkat::hello() from context 'Laptop'`. Property private milik induk juga tidak dapat diakses langsung dari class turunan; pada script ini eksekusi sudah berhenti saat memanggil method tersebut.

Gunakan `private` untuk bagian internal class, `protected` jika class turunan memang membutuhkan akses, dan `public` untuk operasi yang disediakan bagi pemanggil.

## 5.3. Dari Akses Langsung ke Getter dan Setter

### Getter dan Setter dalam Encapsulation

Dalam Object-Oriented Programming (OOP), **getter** dan **setter** digunakan untuk mengatur akses terhadap property suatu object. Penggunaan getter dan setter merupakan salah satu bentuk penerapan **encapsulation**.

Secara sederhana:

- **Getter** digunakan untuk **mengambil atau membaca nilai** property.
- **Setter** digunakan untuk **memberikan atau mengubah nilai** property.

### 1. Tanpa Getter dan Setter

Perhatikan contoh berikut, sesuai script `49.tanpa_getter_dan_setter.php`:

```php
class Perangkat {
    public $merek;
    public $stok;
}

$perangkat01 = new Perangkat();

$perangkat01->merek = "BorneoSistem";
$perangkat01->stok = 10;

echo $perangkat01->merek;
echo $perangkat01->stok;
```

Pada contoh tersebut, property `$merek` dan `$stok` menggunakan access modifier `public`. Artinya, nilai property dapat dibaca dan diubah secara langsung dari luar class.

Cara tersebut memang sederhana, tetapi memiliki kelemahan. Nilai yang tidak sesuai juga dapat diberikan secara langsung.

```php
$perangkat01->stok = "Satu";
$perangkat01->stok = -5;
$perangkat01->stok = 10.5;
```

Jika stok seharusnya berupa bilangan bulat dan tidak boleh negatif, nilai tersebut seharusnya tidak diperbolehkan.

### 2. Menggunakan Getter dan Setter

Untuk membatasi akses langsung, property dapat dibuat menjadi `private`.

Contoh berikut mengembangkan class `Perangkat` pada script `50.getter_and_setter.php` dengan menambahkan validasi stok. Jalankan contoh ini secara terpisah dari contoh sebelumnya karena nama class-nya sama.

```php
class Perangkat {
    private $merek;
    private $stok;

    public function setMerek($merek) {
        $this->merek = $merek;
    }

    public function getMerek() {
        return $this->merek;
    }

    public function setStok($stok) {
        if (is_int($stok) && $stok >= 0) {
            $this->stok = $stok;
        }
    }

    public function getStok() {
        return $this->stok;
    }
}

$perangkat01 = new Perangkat();
```

Karena property menggunakan `private`, kode dari luar class tidak dapat lagi mengubahnya secara langsung. Baris berikut merupakan contoh akses yang menghasilkan error:

```php
$perangkat01->stok = 10; // Tidak diperbolehkan
```

Perubahan nilai dilakukan melalui **setter**.

```php
$perangkat01->setMerek("BorneoSistem");
$perangkat01->setStok(10);
```

Sedangkan untuk membaca nilai digunakan **getter**.

```php
echo $perangkat01->getMerek();
echo $perangkat01->getStok();
```

### 3. Validasi Menggunakan Setter

Salah satu keuntungan setter adalah kita dapat melakukan pemeriksaan sebelum nilai disimpan ke dalam property.

Perhatikan method berikut:

```php
public function setStok($stok) {
    if (is_int($stok) && $stok >= 0) {
        $this->stok = $stok;
    }
}
```

Method tersebut memiliki dua aturan:

1. `is_int($stok)` memastikan nilai stok berupa bilangan bulat.
2. `$stok >= 0` memastikan stok tidak bernilai negatif.

Dengan demikian:

```php
$perangkat01->setStok(10);      // diterima
$perangkat01->setStok("Satu");  // ditolak
$perangkat01->setStok(10.5);    // ditolak
$perangkat01->setStok(-5);      // ditolak
```

Pada contoh ini, “ditolak” berarti nilai tidak disimpan. Setter tidak menampilkan pesan kesalahan, dan nilai stok tetap `10` setelah ketiga input yang tidak sesuai tersebut diberikan. Nilai `0` juga diterima karena memenuhi syarat `$stok >= 0`.

Setter bertindak sebagai **pintu masuk** sebelum nilai property berubah.

Alur sederhananya:

```text
Nilai dari luar
      ↓
    Setter
      ↓
   Validasi
      ↓ (jika sesuai aturan)
Property Private
```


```
Property Private
      ↓
    Getter
      ↓
Nilai dapat dibaca
```

```text
Property Private
      ↓
    Getter
      ↓
Nilai dapat dibaca
```

**Kaitan dengan script Week 03:** script 50 memperkenalkan getter dan setter tanpa validasi. Script `51.setter_validation.php` menambahkan `is_int()`, sedangkan script `56.setter_getter_exercise.php` menggunakan `is_int($stok) && ($stok > 0)`. Contoh pada bagian ini menggunakan `$stok >= 0` agar stok kosong (`0`) diperbolehkan. Jadi, aturan nilainya merupakan pengembangan dari script, bukan salinan persis aturan script 56.

### 4. Perbedaan Getter dan Setter

| Getter                               | Setter                                           |
| ------------------------------------ | ------------------------------------------------ |
| Digunakan untuk membaca data         | Digunakan untuk mengubah data                    |
| Biasanya menggunakan awalan`get`   | Biasanya menggunakan awalan`set`               |
| Biasanya tidak membutuhkan parameter | Biasanya menerima parameter                      |
| Mengembalikan nilai dengan`return` | Dapat melakukan validasi sebelum menyimpan nilai |
| Contoh:`getStok()`                 | Contoh:`setStok(10)`                           |

### 5. Kesimpulan

Getter dan setter membantu class mengontrol bagaimana property digunakan dari luar object.

Tanpa getter dan setter, pada contoh property public:

```php
$perangkat01->stok = -10;
```

Property dapat diubah secara langsung tanpa melalui aturan yang dibuat oleh class.

Dengan encapsulation:

```php
$perangkat01->setStok(10);
echo $perangkat01->getStok();
```

Perubahan dan pembacaan data dilakukan melalui method yang telah disediakan.

Dengan demikian, penggunaan `private`, getter, dan setter yang menerapkan validasi membantu **melindungi data, mengontrol perubahan nilai, dan menjaga data object tetap sesuai dengan aturan yang ditentukan**.

## 5.4. Validasi pada Setter

Script `51.setter_validation.php` memeriksa tipe stok dengan `is_int()`:

```php
private $stok = 0;

public function setStok($stok) {
    if (is_int($stok)) {
        $this->stok = $stok;
    } else {
        echo "Error: stok harus angka bulat <br>";
    }
}

public function getStok() {
    return $this->stok;
}
```

Potongan di atas ditempatkan di dalam class `Perangkat`. Hasil urutan percobaan pada script adalah:

| Operasi             | Hasil pemeriksaan | Nilai stok setelah operasi |
| ------------------- | ----------------- | -------------------------- |
| Membuat object      | Nilai awal        | `0`                      |
| `setStok(10.5)`   | Ditolak: float    | `0`                      |
| `setStok("Satu")` | Ditolak: string   | `0`                      |
| `setStok(10)`     | Diterima: integer | `10`                     |

`is_int()` memeriksa tipe data, sehingga `5` diterima, tetapi `'5'` dan `5.0` ditolak. Pada versi ini, `0` dan bilangan negatif masih diterima karena belum ada pemeriksaan rentang nilai. Aturan stok positif baru ditambahkan pada script 56.

Saat input ditolak, pesan ditampilkan menggunakan `echo` dan property tidak diubah. Program tetap berjalan, sehingga getter sesudahnya masih dapat membaca nilai sebelumnya.

## 5.5. Pemrosesan Nilai pada Getter

Script `52.getter_processing.php` menggabungkan validasi merek dan pengolahan hasil getter:

```php
private $merek = "";

public function setMerek($merek) {
    if (is_string($merek)) {
        $this->merek = $merek;
    } else {
        echo "Error: merek harus berbentuk string <br>";
    }
}

public function getMerek() {
    return strtoupper($this->merek);
}
```

- `setMerek(9)` ditolak karena input bukan string; nilai awal tetap string kosong.
- `setMerek("BorneoSistem")` menyimpan merek tersebut.
- `getMerek()` mengembalikan `BORNEOSISTEM` melalui `strtoupper()`.

Getter ini tidak menulis kembali hasil konversi ke property. Nilai tersimpan tetap `BorneoSistem`, sementara nilai yang dikembalikan ditampilkan dalam huruf kapital.

**Catatan script:** komentar `// ACER` pada baris terakhir script 52 tidak sesuai dengan input. Keluaran yang sesuai kode adalah `BORNEOSISTEM`. Penulisan `echo $perangkat01->setMerek(9)` juga tidak diperlukan: setter tidak mengembalikan nilai secara eksplisit, dan pesan kesalahannya sudah dicetak dari dalam setter.

`is_string()` hanya memeriksa tipe. String kosong masih diterima; aturan merek tidak boleh kosong memerlukan pemeriksaan tambahan.

## 5.6. Constructor dan Setter Private

Script `53.setter_getter_constructor.php` memindahkan pengisian data awal ke constructor. Setter dibuat private agar hanya digunakan dari dalam class:

```php
<?php
class Perangkat {
    private $merek;
    private $stok;

    private function setMerek($merek) {
        if (is_string($merek)) {
            $this->merek = $merek;
        } else {
            die("Error: merek harus berbentuk string <br>");
        }
    }

    private function setStok($stok) {
        if (is_int($stok)) {
            $this->stok = $stok;
        } else {
            die("Error: stok harus angka bulat <br>");
        }
    }

    public function __construct($merek, $stok) {
        $this->setMerek($merek);
        $this->setStok($stok);
    }

    public function getMerek() {
        return strtoupper($this->merek);
    }

    public function getStok() {
        return $this->stok;
    }
}

$perangkat01 = new Perangkat("BorneoSistem", 10);
echo "Stok produk " . $perangkat01->getMerek() . ": " . $perangkat01->getStok();
// Stok produk BORNEOSISTEM: 10
```

Alur pembuatan object:

1. `new Perangkat(...)` memanggil `__construct()`.
2. Constructor memanggil `setMerek()` untuk memeriksa dan menyimpan merek.
3. Jika pemeriksaan merek lolos, constructor memanggil `setStok()`.
4. Jika seluruh pemeriksaan lolos, kode berikutnya dapat membaca data melalui getter.

Constructor boleh memanggil method private karena berada dalam class yang sama. Pemanggil dari luar tidak dapat menggunakan `$perangkat01->setStok(20)` pada versi ini. Dengan antarmuka yang tersedia, data hanya diisi saat konstruksi dan kemudian dibaca melalui getter.

### Kegagalan validasi pada constructor

| Script | Input constructor         | Hasil                                                 |
| ------ | ------------------------- | ----------------------------------------------------- |
| 53     | `("BorneoSistem", 10)`  | Berhasil; menampilkan`Stok produk BORNEOSISTEM: 10` |
| 54     | `("BorneoSistem", '5')` | Merek lolos, stok ditolak karena string               |
| 55     | `(0, '5')`              | Merek ditolak; pemeriksaan stok belum dijalankan      |

Script 54 dan 55 memberi nilai awal `""` pada merek dan `0` pada stok. Nilai awal tersebut tidak membuat input constructor yang salah menjadi valid.

Berbeda dengan `echo` pada script 51–52, `die()` menampilkan pesan sekaligus **menghentikan seluruh eksekusi script**. Pada script 54–55, baris pencetakan stok sesudah `new Perangkat(...)` tidak dijalankan. Penggunaan `die()` mengikuti contoh praktikum ini; penanganan kegagalan menggunakan exception dipelajari pada Minggu 5.

## 5.7. Studi Kasus: Validasi Kode Produk dan Stok

Script `56.setter_getter_exercise.php` menerapkan dua aturan:

- Kode produk mengikuti pola tiga huruf kapital diikuti tiga angka, misalnya `ACR014`.
- Stok harus bertipe integer dan lebih besar dari nol.

Property `$kodeProduk` dan `$stok` bersifat private. Constructor memanggil setter private, sedangkan `getKodeProduk()` dan `getStok()` menjadi akses baca public.

Bagian validasinya adalah:

```php
private function setKodeProduk($kodeProduk) {
    if (preg_match("/^[A-Z]{3}[0-9]{3}$/", $kodeProduk)) {
        $this->kodeProduk = $kodeProduk;
    } else {
        die("Error: kode produk harus 6 digit (3 huruf dan 3 angka), seperti AAA001");
    }
}

private function setStok($stok) {
    if (is_int($stok) && ($stok > 0)) {
        $this->stok = $stok;
    } else {
        die("Error: stok harus angka bulat positif <br>");
    }
}
```

Pola regular expression dibaca sebagai berikut:

| Bagian pola  | Fungsi                                                                            |
| ------------ | --------------------------------------------------------------------------------- |
| `/.../`    | Pembatas pola                                                                     |
| `^`        | Awal string                                                                       |
| `[A-Z]{3}` | Tiga huruf kapital A–Z                                                           |
| `[0-9]{3}` | Tiga angka 0–9                                                                   |
| `$`        | Akhir string, atau posisi sebelum newline terakhir pada perilaku default pola ini |

Pesan script menggunakan istilah “6 digit”, tetapi maksud formatnya adalah **6 karakter: 3 huruf kapital dan 3 angka**. Untuk pengembangan validasi yang harus menolak newline terakhir juga, pola dapat menggunakan `\A[A-Z]{3}[0-9]{3}\z` sebagai batas awal dan akhir mutlak. Contoh praktikum tetap menggunakan pola asli script.

Operator `&&` mensyaratkan kedua pemeriksaan stok bernilai benar. Integer negatif gagal pada pemeriksaan `$stok > 0`, sedangkan string numerik seperti `'9'` gagal pada `is_int()`.

| Input kode dan stok | Hasil jika diuji sendiri                         |
| ------------------- | ------------------------------------------------ |
| `('ACR014', 9)`   | `Stok produk ACR014: 9 buah`                   |
| `('LNV023', 100)` | `Stok produk LNV023: 100 buah`                 |
| `('2NV050', 67)`  | Ditolak: bagian awal bukan tiga huruf kapital    |
| `('HP002', 10)`   | Ditolak: hanya dua huruf dan total lima karakter |
| `('DEL099', -5)`  | Ditolak: stok tidak positif                      |

**Pada eksekusi file asli**, dua object pertama berhasil, kemudian program berhenti saat kode `2NV050` ditolak. Percobaan `HP002` dan stok `-5` belum dijalankan. Untuk mengamatinya, jalankan setiap kasus secara terpisah atau nonaktifkan kasus gagal sebelumnya pada salinan script.

# 6. PRAKTIKUM DAN LATIHAN

## 6.1. Panduan Menjalankan Script

Script tersedia dalam [folder Week 03](<../Script/Week 03/>). Jalankan setiap file secara terpisah karena beberapa file mendeklarasikan class bernama sama, yaitu `Perangkat`.

Dari direktori utama repository, contoh perintah PHP CLI adalah:

```bash
php "Script/Week 03/01-access-modifier/43.visibility_public.php"
php "Script/Week 03/02-getter-setter/51.setter_validation.php"
php "Script/Week 03/02-getter-setter/56.setter_getter_exercise.php"
```

PHP harus tersedia untuk menjalankan perintah tersebut. Jika dijalankan melalui browser dengan server PHP, `<br>` menjadi pergantian baris; di terminal, tag tersebut tercetak sebagai teks. File demonstrasi error memang ditujukan untuk memperlihatkan pembatasan akses atau penolakan input.

## 6.2. Peta Script dan Aktivitas Pengamatan

| Script                                                                                                                   | Fokus                                 | Aktivitas mahasiswa                                              |
| ------------------------------------------------------------------------------------------------------------------------ | ------------------------------------- | ---------------------------------------------------------------- |
| [43.visibility_public.php](<../Script/Week 03/01-access-modifier/43.visibility_public.php>)                               | Akses public                          | Ubah merek dari luar class dan amati hasilnya                    |
| [44.visibility_private_error.php](<../Script/Week 03/01-access-modifier/44.visibility_private_error.php>)                 | Akses private                         | Uji penulisan, pembacaan, dan pemanggilan method secara terpisah |
| [45.visibility_private.php](<../Script/Week 03/01-access-modifier/45.visibility_private.php>)                             | Method public untuk property private  | Jelaskan mengapa getter dan setter dapat mengakses merek         |
| [46.visibility_protected.php](<../Script/Week 03/01-access-modifier/46.visibility_protected.php>)                         | Akses protected dari luar             | Amati kesalahan pertama dan uji operasi lainnya secara terpisah  |
| [47.visibility_inheritance_protected.php](<../Script/Week 03/01-access-modifier/47.visibility_inheritance_protected.php>) | Protected pada turunan                | Telusuri akses dari`helloLaptop()` ke anggota induk            |
| [48.visibility_inheritance_private.php](<../Script/Week 03/01-access-modifier/48.visibility_inheritance_private.php>)     | Private pada induk                    | Bandingkan dengan script 47 dan jelaskan error                   |
| [49.tanpa_getter_dan_setter.php](<../Script/Week 03/02-getter-setter/49.tanpa_getter_dan_setter.php>)                     | Akses data langsung                   | Coba isi stok dengan string pada salinan script                  |
| [50.getter_and_setter.php](<../Script/Week 03/02-getter-setter/50.getter_and_setter.php>)                                 | Getter dan setter                     | Identifikasi bagian yang masih belum memvalidasi input           |
| [51.setter_validation.php](<../Script/Week 03/02-getter-setter/51.setter_validation.php>)                                 | Validasi integer                      | Catat nilai stok setelah setiap input ditolak atau diterima      |
| [52.getter_processing.php](<../Script/Week 03/02-getter-setter/52.getter_processing.php>)                                 | Validasi string dan pemrosesan getter | Bandingkan nilai tersimpan dengan keluaran huruf kapital         |
| [53.setter_getter_constructor.php](<../Script/Week 03/02-getter-setter/53.setter_getter_constructor.php>)                 | Constructor dan setter private        | Telusuri urutan validasi merek dan stok                          |
| [54.setter_getter_constructor_error.php](<../Script/Week 03/02-getter-setter/54.setter_getter_constructor_error.php>)     | String numerik sebagai stok           | Bandingkan`'5'` dengan `5`                                   |
| [55.setter_getter_constructor_error_2.php](<../Script/Week 03/02-getter-setter/55.setter_getter_constructor_error_2.php>) | Urutan kegagalan validasi             | Jelaskan mengapa pesan stok tidak muncul                         |
| [56.setter_getter_exercise.php](<../Script/Week 03/02-getter-setter/56.setter_getter_exercise.php>)                       | Kode produk dan stok positif          | Uji setiap kasus secara terpisah dan catat alasannya             |

## 6.3. Alokasi Kegiatan Pertemuan

| Kegiatan                                                | Durasi              |
| ------------------------------------------------------- | ------------------- |
| Pengantar encapsulation dan masalah akses data langsung | 15 menit            |
| Demonstrasi access modifier, script 43–48              | 30 menit            |
| Praktik getter, setter, dan validasi, script 49–52     | 35 menit            |
| Praktik constructor dan kode produk, script 53–56      | 35 menit            |
| Latihan mandiri dan pembahasan                          | 25 menit            |
| Refleksi dan rangkuman                                  | 10 menit            |
| **Total**                                         | **150 menit** |

## 6.4. Latihan Terarah: Perangkat

Kembangkan salinan script 56 dengan ketentuan:

1. Pertahankan property private dan getter public.
2. Pertahankan pengisian kode produk melalui constructor dan setter private.
3. Pastikan kode produk tepat tiga huruf kapital dan tiga angka, tanpa karakter tambahan.
4. Pertahankan aturan stok integer positif.
5. Uji kode `ABC123`, `abc123`, `AB123`, dan `123ABC` secara terpisah.
6. Dengan kode valid, uji stok `1`, `0`, `-1`, `'5'`, dan `5.5` secara terpisah.
7. Catat hasil aktual dan alasan penerimaan atau penolakan setiap input.

## 6.5. Latihan Mandiri: Mahasiswa

Buat class `Mahasiswa` dengan property `nim`, `nama`, dan `ipk`:

- Semua property bersifat private.
- Constructor menerima NIM, nama, dan IPK awal, lalu melakukan validasi melalui setter.
- NIM berupa string tidak kosong, diisi melalui setter private, dan dapat dibaca melalui getter public.
- Nama berupa string tidak kosong dan dapat diubah melalui setter public.
- IPK bertipe integer atau float dalam rentang **0–4**, termasuk kedua batasnya, dan dapat diubah melalui setter public.
- Input nama atau IPK yang tidak valid pada perubahan setelah konstruksi harus ditolak tanpa mengubah nilai sebelumnya. Tampilkan pesan kesalahan dan lanjutkan eksekusi.
- Input constructor yang tidak valid menghentikan script dengan pesan kesalahan, mengikuti pendekatan script 53–56.

Uji IPK `0`, `3.75`, `4`, `-0.1`, `4.1`, dan `"tiga"`. Tunjukkan bahwa nilai IPK sebelumnya tetap tersimpan setelah perubahan yang tidak valid ditolak.

Hasil yang dikumpulkan: file PHP, catatan hasil pengujian, dan penjelasan singkat alasan pemilihan access modifier.

## 6.6. Pertanyaan Refleksi

1. Mengapa mengganti property public dengan private belum cukup jika setter menerima semua nilai?
2. Mengapa method public dapat membaca property private dalam class yang sama?
3. Apa perbedaan akses protected dan private dari class turunan?
4. Mengapa `'5'` ditolak oleh `is_int()` walaupun berisi angka?
5. Apakah `strtoupper()` dalam getter pada script 52 mengubah property? Jelaskan.
6. Mengapa setter private masih dapat dipanggil melalui constructor?
7. Apa perbedaan alur eksekusi ketika validasi gagal menggunakan `echo` dan `die()`?
8. Mengapa dua kasus terakhir script 56 tidak tampil saat seluruh file dijalankan?

# 7. RANGKUMAN

- Encapsulation mengatur akses terhadap data dan memusatkan aturan perubahan state dalam class.
- `public` dapat diakses dari luar class, `protected` juga tersedia bagi class turunan tetapi tidak bagi pemanggil luar, dan `private` hanya dapat diakses langsung dalam class yang mendeklarasikannya.
- Getter menyediakan akses baca dan dapat mengolah hasil; setter menyediakan jalur perubahan data dan tempat validasi.
- Validasi tipe berbeda dari validasi nilai: `is_int()` tidak otomatis memastikan stok positif.
- Constructor dapat menggunakan setter private untuk memvalidasi data awal. Setter tidak harus dibuka untuk pemanggil luar.
- Pada contoh dengan `echo`, penolakan input tidak menghentikan script; pada contoh dengan `die()`, eksekusi berhenti segera.
- Studi kasus kode produk dan stok menunjukkan bahwa input harus memenuhi format, tipe, dan rentang yang ditentukan sebelum disimpan.
