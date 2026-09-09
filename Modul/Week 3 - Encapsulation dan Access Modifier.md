# MODUL PERKULIAHAN

## Mata Kuliah: Pemrograman Lanjut

### Minggu Ke-3: Encapsulation dan Access Modifier

# 1. IDENTITAS MATA KULIAH

| Komponen | Keterangan |
| --- | --- |
| Mata Kuliah | Pemrograman Lanjut |
| Minggu | 3 |
| Topik | Encapsulation dan Access Modifier |
| Dosen Pengampu | **Arif Wicaksono Septyanto, S.Kom., M.Kom.** |
| Durasi | 1 Pertemuan (3 × 50 menit) |

# 2. SUB-CPMK

> **Mahasiswa mampu mengaplikasikan konsep encapsulation, dan access modifier (C3, A4, P2).**

# 3. BAHAN KAJIAN

- Tujuan encapsulation untuk menjaga data tetap sesuai aturan.
- Access modifier `public`, `protected`, dan `private` pada property dan method.
- Perbandingan akses langsung dengan akses melalui getter dan setter.
- Validasi tipe dan nilai pada setter.
- Mengatur tampilan data melalui getter.
- Penggunaan setter private melalui constructor.
- Validasi kode produk dan stok.

Pewarisan diperkenalkan secara terbatas melalui `Perangkat` dan `Laptop` untuk memperlihatkan perbedaan `protected` dan `private`, sesuai script 47–48. Pembahasan utama inheritance dan overriding tetap berada pada Minggu 4.

# 4. INDIKATOR PENILAIAN

Mahasiswa mampu:

1. Menjelaskan alasan property tidak selalu dibuat `public`.
2. Memilih access modifier sesuai kebutuhan akses property dan method.
3. Menjelaskan penyebab kesalahan akses dari luar class dan dari class turunan.
4. Membuat getter dan setter untuk mengendalikan akses data.
5. Memeriksa jenis dan nilai data sebelum menyimpannya.
6. Menampilkan data dalam bentuk berbeda tanpa mengubah data yang disimpan.
7. Menggunakan constructor untuk memanggil setter private.
8. Memvalidasi kode produk dan stok serta menjelaskan alur ketika input ditolak.

# 5. MATERI PERKULIAHAN

## 5.1. Encapsulation: Mengatur Cara Membaca dan Mengubah Data

Bayangkan aplikasi toko buku. Setiap buku memiliki nama dan jumlah stok. Nama boleh berupa teks seperti `"Buku Tulis"`, tetapi jumlah stok harus berupa angka yang masuk akal. Jika stok diisi `"banyak"` atau `-5`, data toko menjadi sulit digunakan.

**Encapsulation** adalah cara mengatur agar data dalam objek dibaca dan diubah melalui cara yang sudah disediakan oleh class. Dengan begitu, class dapat memeriksa data sebelum menyimpannya.

Sebelum melihat kode, ingat kembali istilah berikut:

| Istilah | Arti sederhana | Contoh |
| --- | --- | --- |
| Class | Rancangan untuk membuat objek | `Buku` |
| Objek (*object*) | Hasil yang dibuat dari class | `$buku` |
| Property | Variabel di dalam class untuk menyimpan data | `$stok` |
| Method | Fungsi di dalam class untuk melakukan suatu pekerjaan | `setStok()` |
| Input | Data yang diberikan ke program | Angka `10` saat mengisi stok |
| Validasi | Pemeriksaan apakah data sesuai aturan | Memastikan stok tidak negatif |
| State object | Nilai data yang sedang tersimpan dalam objek | Stok buku saat ini adalah `10` |

Berikut contoh sederhana yang dapat dijalankan sendiri:

```php
<?php
class Buku {
    private $stok = 0;

    public function setStok($stok) {
        if (is_int($stok) && $stok >= 0) {
            $this->stok = $stok;
        } else {
            echo "Stok harus bilangan bulat dan tidak boleh negatif.<br>";
        }
    }

    public function getStok() {
        return $this->stok;
    }
}

$buku = new Buku();
$buku->setStok(10);
echo $buku->getStok(); // 10
echo "<br>";

$buku->setStok(-5);   // Ditolak dan menampilkan pesan kesalahan
echo $buku->getStok(); // Tetap 10
```

Cara membaca contoh tersebut:

1. `private $stok` membuat stok tidak bisa diubah langsung dari luar class.
2. `setStok(10)` meminta class menyimpan stok `10`.
3. `is_int($stok)` memeriksa apakah stok berupa bilangan bulat. Tanda `&&` berarti “dan”, sehingga syarat `$stok >= 0` juga harus terpenuhi.
4. `$this->stok` berarti property stok milik objek yang sedang digunakan. Sementara itu, `$stok` pada parameter method adalah nilai yang baru diterima.
5. `getStok()` membaca nilai stok. Kata `return` mengembalikan nilai tersebut, lalu `echo` menampilkannya.
6. Saat `-5` ditolak, nilai stok sebelumnya tetap `10`.

Pada contoh toko buku ini, stok `0` diperbolehkan karena berarti barang habis. Pada latihan script 56, aturan stok berbeda: stok harus lebih dari `0`. Aturan validasi perlu disesuaikan dengan kebutuhan aplikasi.

Contoh pada script Week 03 menggunakan class `Perangkat`, yaitu barang seperti laptop yang dicatat merek dan stoknya. Cara mengatur datanya sama seperti pada contoh buku. Nama class dan merek pada contoh script dipertahankan agar mudah dicocokkan saat praktikum.

**Hal yang perlu diingat:** membuat property menjadi `private` hanya membatasi akses langsung. Kita tetap perlu menambahkan pemeriksaan pada method yang mengubah datanya.

## 5.2. Access Modifier: `public`, `protected`, dan `private`

**Access modifier** adalah kata kunci untuk mengatur bagian program mana yang boleh menggunakan property atau method.

“Dari dalam class” berarti kode ditulis di dalam method class tersebut. “Dari luar class” berarti kode menggunakan objek, misalnya `$perangkat01->merek`. Class turunan adalah class yang dibuat dengan mengembangkan class lain; contohnya dibahas pada bagian C.

| Modifier | Dari class itu sendiri | Dari class turunan | Dari luar class |
| --- | --- | --- | --- |
| `public` | Ya | Ya | Ya |
| `protected` | Ya | Ya | Tidak |
| `private` | Ya | Tidak secara langsung | Tidak |

### A. Akses public

`public` berarti property atau method boleh digunakan dari dalam maupun luar class. Pada script `43.visibility_public.php`, penulisan `var $merek` juga berarti property tersebut public. Contoh berikut menuliskannya sebagai `public $merek` agar lebih mudah dibaca.

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

`private` berarti property atau method hanya boleh digunakan langsung dari dalam class yang membuatnya. Pada script `44.visibility_private_error.php`, `$merek` dan `hello()` bersifat private. Karena itu, ketiga baris berikut tidak boleh dijalankan dari luar class:

```php
$perangkat01->merek = "MerapiKomputasi";
echo $perangkat01->merek;
echo $perangkat01->hello();
```

Jika kita mencoba mengisi atau membaca `$merek`, muncul pesan `Cannot access private property Perangkat::$merek`. Artinya, property tersebut tidak boleh diakses langsung dari luar class. Jika kita mencoba memanggil `hello()`, muncul pesan `Call to private method Perangkat::hello()` dengan alasan yang sama.

**Program berhenti pada kesalahan pertama.** Untuk mencoba kesalahan berikutnya, tambahkan `//` di depan baris percobaan lain agar baris tersebut menjadi komentar dan tidak dijalankan.

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

Pada contoh ini, `setMerek()` mengisi merek dan `getMerek()` membaca merek. Keduanya boleh menggunakan `$this->merek` karena ditulis di dalam class `Perangkat`. Dari luar class, kita cukup memanggil kedua method public tersebut.

### C. Akses protected: Bisa Digunakan oleh Class Turunan

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

Laptop adalah salah satu jenis perangkat. Hubungan ini ditulis dengan `class Laptop extends Perangkat`: `Perangkat` disebut class induk, sedangkan `Laptop` disebut class turunan.

`protected` mengizinkan kode di dalam `Laptop` menggunakan property dan method tersebut. Itulah sebabnya `helloLaptop()` bisa membaca merek dan memanggil `hello()`. Dari luar class, kita memanggil `helloLaptop()` yang bersifat public.

Pada script `48.visibility_inheritance_private.php`, merek dan `hello()` di class `Perangkat` diubah menjadi private. Akibatnya, `Laptop` tidak boleh memanggil `hello()` milik induknya secara langsung. Program berhenti dengan pesan yang menyebut `Call to private method Perangkat::hello()`. Property merek yang private juga tidak boleh dibaca langsung dari `Laptop`.

Sebagai panduan awal, gunakan `private` untuk data yang hanya dikelola oleh class itu sendiri. Gunakan `protected` jika class turunan perlu menggunakannya, dan `public` untuk method yang boleh dipanggil dari luar.

## 5.3. Dari Akses Langsung ke Getter dan Setter

Script `49.tanpa_getter_dan_setter.php` mendeklarasikan `$merek` dan `$stok` sebagai public:

```php
$perangkat01->merek = "BorneoSistem";
$perangkat01->stok = 10;
```

Cara ini mudah, tetapi kode lain juga bisa mengisi `$perangkat01->stok = "Satu"`. Class belum memiliki cara untuk menolak nilai tersebut.

Pada script `50.getter_and_setter.php`, kedua property menjadi private dan diakses melalui method:

```php
<?php
class Perangkat {
    private $merek;
    private $stok;

    public function setMerek($merek) {
        $this->merek = $merek;
    }

    public function setStok($stok) {
        $this->stok = $stok;
    }

    public function getMerek() {
        return $this->merek;
    }

    public function getStok() {
        return $this->stok;
    }
}

$perangkat01 = new Perangkat();
$perangkat01->setMerek("BorneoSistem");
$perangkat01->setStok(10);
echo $perangkat01->getMerek(); // BorneoSistem
echo "<br>";
echo $perangkat01->getStok(); // 10
```

**Setter** adalah method untuk mengisi atau mengubah data, misalnya `setStok(10)`. **Getter** adalah method untuk membaca data, misalnya `getStok()`. Awalan `set` dan `get` merupakan kebiasaan penamaan agar tujuan method mudah dikenali.

Bayangkan mengisi dan melihat jumlah buku pada aplikasi toko: setter digunakan saat jumlahnya diubah, sedangkan getter digunakan saat jumlahnya ditampilkan.

Setter pada script 50 masih menerima nilai apa pun. Pada bagian berikutnya, kita menambahkan pemeriksaan sebelum data disimpan. Tidak semua data harus bisa diubah dari luar class. Misalnya, NIM mahasiswa dapat diisi saat objek dibuat, lalu hanya disediakan getter untuk membacanya.

## 5.4. Setter: Memeriksa Data Sebelum Disimpan

**Validasi** berarti memeriksa apakah input sesuai aturan. Untuk stok barang, kita perlu mengenali perbedaan jenis data berikut:

| Jenis data | Arti | Contoh |
| --- | --- | --- |
| Integer | Bilangan bulat | `5`, `10`, `-2` |
| Float | Bilangan dengan bagian desimal | `5.0`, `10.5` |
| String | Teks yang ditulis di antara tanda kutip | `"Buku"`, `"Satu"`, `'5'` |

Script `51.setter_validation.php` menggunakan `is_int()` untuk menerima stok yang bertipe integer:

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

| Operasi | Hasil pemeriksaan | Nilai stok setelah operasi |
| --- | --- | --- |
| Membuat objek | Nilai awal | `0` |
| `setStok(10.5)` | Ditolak: float | `0` |
| `setStok("Satu")` | Ditolak: string | `0` |
| `setStok(10)` | Diterima: integer | `10` |

`is_int()` memeriksa tipe data, sehingga `5` diterima, tetapi `'5'` dan `5.0` ditolak. Pada versi ini, `0` dan bilangan negatif masih diterima karena belum ada pemeriksaan rentang nilai. Aturan stok positif baru ditambahkan pada script 56.

Saat input ditolak, pesan ditampilkan menggunakan `echo` dan property tidak diubah. Program tetap berjalan, sehingga getter sesudahnya masih dapat membaca nilai sebelumnya.

## 5.5. Getter: Membaca Data dan Mengatur Tampilannya

Misalnya, nama barang disimpan sebagai `Buku Tulis`, tetapi ingin ditampilkan sebagai `BUKU TULIS`. Getter dapat mengembalikan versi huruf kapital tanpa mengganti data aslinya.

Script `52.getter_processing.php` melakukan hal serupa untuk merek. `is_string()` memeriksa apakah input berupa teks, sedangkan `strtoupper()` mengubah teks menjadi huruf kapital. Potongan berikut ditulis di dalam class `Perangkat`:

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

Data di dalam property tetap `BorneoSistem`. Getter hanya mengembalikan hasil berupa `BORNEOSISTEM` untuk ditampilkan.

**Catatan script:** komentar `// ACER` pada baris terakhir script 52 tidak sesuai dengan input. Keluaran yang sesuai kode adalah `BORNEOSISTEM`. Penulisan `echo $perangkat01->setMerek(9)` juga tidak diperlukan: setter tidak memiliki perintah `return` untuk memberikan hasil, dan pesan kesalahannya sudah dicetak dari dalam setter.

`is_string()` hanya memeriksa tipe. String kosong masih diterima; aturan merek tidak boleh kosong memerlukan pemeriksaan tambahan.

## 5.6. Constructor: Mengisi Data Saat Objek Dibuat

**Constructor** adalah method khusus bernama `__construct()` yang otomatis dijalankan saat objek dibuat dengan `new`. Kita dapat menggunakannya untuk mengisi data awal.

Contohnya, saat menambahkan barang ke aplikasi toko, nama dan stok langsung diisi bersama-sama. Pada script `53.setter_getter_constructor.php`, data awalnya adalah merek dan stok. Constructor memanggil setter private untuk memeriksa kedua data tersebut:

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

Urutan saat objek dibuat:

1. `new Perangkat(...)` memanggil `__construct()`.
2. Constructor memanggil `setMerek()` untuk memeriksa dan menyimpan merek.
3. Jika pemeriksaan merek lolos, constructor memanggil `setStok()`.
4. Jika seluruh pemeriksaan lolos, kode berikutnya dapat membaca data melalui getter.

Constructor boleh memanggil method private karena berada dalam class yang sama. Pemanggil dari luar tidak dapat menggunakan `$perangkat01->setStok(20)` pada versi ini. Pada contoh ini, data diisi ketika objek dibuat dan setelah itu hanya bisa dibaca dari luar melalui getter.

### Apa yang Terjadi Jika Data Awal Salah?

| Script | Input constructor | Hasil |
| --- | --- | --- |
| 53 | `("BorneoSistem", 10)` | Berhasil; menampilkan `Stok produk BORNEOSISTEM: 10` |
| 54 | `("BorneoSistem", '5')` | Merek lolos, stok ditolak karena string |
| 55 | `(0, '5')` | Merek ditolak; pemeriksaan stok belum dijalankan |

Script 54 dan 55 memberi nilai awal `""` pada merek dan `0` pada stok. Nilai awal tersebut tidak membuat input constructor yang salah menjadi valid.

Berbeda dengan `echo` pada script 51–52, `die()` menampilkan pesan sekaligus **menghentikan program saat itu juga**. Pada script 54–55, baris pencetakan stok sesudah `new Perangkat(...)` tidak dijalankan. Penggunaan `die()` mengikuti contoh praktikum ini; penanganan kegagalan menggunakan exception dipelajari pada Minggu 5.

## 5.7. Studi Kasus: Validasi Kode Produk dan Stok

Bayangkan setiap barang di toko diberi kode agar mudah dibedakan. Misalnya, `BUK001` untuk buku tulis dan `PEN002` untuk pulpen. Kode ini memiliki tiga huruf kapital diikuti tiga angka.

Script `56.setter_getter_exercise.php` menggunakan aturan serupa untuk perangkat:

- Kode produk mengikuti pola tiga huruf kapital diikuti tiga angka, misalnya `ACR014`.
- Stok harus bertipe integer dan lebih besar dari nol.

Property `$kodeProduk` dan `$stok` bersifat private. Constructor memanggil setter private, sedangkan `getKodeProduk()` dan `getStok()` menjadi akses baca public.

Potongan berikut ditulis di dalam class `Perangkat` untuk memeriksa kode produk dan stok:

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

`preg_match()` adalah fungsi untuk memeriksa apakah teks cocok dengan suatu pola. Polanya disebut *regular expression* atau regex. Untuk contoh ini, cukup pahami bagian berikut:

| Bagian pola | Fungsi |
| --- | --- |
| `/.../` | Pembatas pola |
| `^` | Awal string |
| `[A-Z]{3}` | Tiga huruf kapital A–Z |
| `[0-9]{3}` | Tiga angka 0–9 |
| `$` | Batas akhir teks; lihat catatan tambahan di bawah |

Pesan script menyebut “6 digit”. Maksudnya adalah **6 karakter: 3 huruf kapital dan 3 angka**. Contohnya, `BUK001` sesuai format, sedangkan `BU001` terlalu pendek dan `buk001` menggunakan huruf kecil.

Catatan tambahan untuk latihan: tanda `$` pada pola asli masih mengizinkan karakter pindah baris di akhir teks. Jika ingin menolak semua karakter tambahan, gunakan pola `/\A[A-Z]{3}[0-9]{3}\z/`. `\A` menandai awal teks dan `\z` menandai akhir teks yang sesungguhnya.

Tanda `&&` berarti “dan”: stok harus bilangan bulat **dan** lebih besar dari nol. Karena itu, `-5` ditolak karena negatif, sedangkan `'9'` ditolak karena berupa teks meskipun terlihat seperti angka.

| Input kode dan stok | Hasil jika diuji sendiri |
| --- | --- |
| `('ACR014', 9)` | `Stok produk ACR014: 9 buah` |
| `('LNV023', 100)` | `Stok produk LNV023: 100 buah` |
| `('2NV050', 67)` | Ditolak: bagian awal bukan tiga huruf kapital |
| `('HP002', 10)` | Ditolak: hanya dua huruf dan total lima karakter |
| `('DEL099', -5)` | Ditolak: stok tidak positif |

**Saat file asli dijalankan**, dua objek pertama berhasil, kemudian program berhenti saat kode `2NV050` ditolak. Percobaan `HP002` dan stok `-5` belum dijalankan. Untuk mengamatinya, jalankan setiap kasus secara terpisah atau nonaktifkan kasus gagal sebelumnya pada salinan script.

# 6. PRAKTIKUM DAN LATIHAN

## 6.1. Panduan Menjalankan Script

Script tersedia dalam [folder Week 03](<../Script/Week 03/>). Jalankan setiap file secara terpisah karena beberapa file mendeklarasikan class bernama sama, yaitu `Perangkat`.

Buka terminal pada folder utama proyek, lalu jalankan file yang ingin dicoba. Contoh perintahnya:

```bash
php "Script/Week 03/01-access-modifier/43.visibility_public.php"
php "Script/Week 03/02-getter-setter/51.setter_validation.php"
php "Script/Week 03/02-getter-setter/56.setter_getter_exercise.php"
```

PHP harus tersedia untuk menjalankan perintah tersebut. Jika dijalankan melalui browser dengan server PHP, `<br>` menjadi pergantian baris; di terminal, tag tersebut tercetak sebagai teks. File demonstrasi error memang ditujukan untuk memperlihatkan pembatasan akses atau penolakan input.

## 6.2. Peta Script dan Aktivitas Pengamatan

| Script | Fokus | Aktivitas mahasiswa |
| --- | --- | --- |
| [43.visibility_public.php](<../Script/Week 03/01-access-modifier/43.visibility_public.php>) | Akses public | Ubah merek dari luar class dan amati hasilnya |
| [44.visibility_private_error.php](<../Script/Week 03/01-access-modifier/44.visibility_private_error.php>) | Akses private | Uji penulisan, pembacaan, dan pemanggilan method secara terpisah |
| [45.visibility_private.php](<../Script/Week 03/01-access-modifier/45.visibility_private.php>) | Method public untuk property private | Jelaskan mengapa getter dan setter dapat mengakses merek |
| [46.visibility_protected.php](<../Script/Week 03/01-access-modifier/46.visibility_protected.php>) | Akses protected dari luar | Amati kesalahan pertama dan uji operasi lainnya secara terpisah |
| [47.visibility_inheritance_protected.php](<../Script/Week 03/01-access-modifier/47.visibility_inheritance_protected.php>) | Protected pada turunan | Telusuri akses dari `helloLaptop()` ke anggota induk |
| [48.visibility_inheritance_private.php](<../Script/Week 03/01-access-modifier/48.visibility_inheritance_private.php>) | Private pada induk | Bandingkan dengan script 47 dan jelaskan error |
| [49.tanpa_getter_dan_setter.php](<../Script/Week 03/02-getter-setter/49.tanpa_getter_dan_setter.php>) | Akses data langsung | Coba isi stok dengan string pada salinan script |
| [50.getter_and_setter.php](<../Script/Week 03/02-getter-setter/50.getter_and_setter.php>) | Getter dan setter | Identifikasi bagian yang masih belum memvalidasi input |
| [51.setter_validation.php](<../Script/Week 03/02-getter-setter/51.setter_validation.php>) | Validasi integer | Catat nilai stok setelah setiap input ditolak atau diterima |
| [52.getter_processing.php](<../Script/Week 03/02-getter-setter/52.getter_processing.php>) | Validasi string dan pemrosesan getter | Bandingkan nilai tersimpan dengan keluaran huruf kapital |
| [53.setter_getter_constructor.php](<../Script/Week 03/02-getter-setter/53.setter_getter_constructor.php>) | Constructor dan setter private | Telusuri urutan validasi merek dan stok |
| [54.setter_getter_constructor_error.php](<../Script/Week 03/02-getter-setter/54.setter_getter_constructor_error.php>) | String numerik sebagai stok | Bandingkan `'5'` dengan `5` |
| [55.setter_getter_constructor_error_2.php](<../Script/Week 03/02-getter-setter/55.setter_getter_constructor_error_2.php>) | Urutan kegagalan validasi | Jelaskan mengapa pesan stok tidak muncul |
| [56.setter_getter_exercise.php](<../Script/Week 03/02-getter-setter/56.setter_getter_exercise.php>) | Kode produk dan stok positif | Uji setiap kasus secara terpisah dan catat alasannya |

## 6.3. Alokasi Kegiatan Pertemuan

| Kegiatan | Durasi |
| --- | --- |
| Pengantar encapsulation melalui contoh stok buku | 15 menit |
| Demonstrasi access modifier, script 43–48 | 30 menit |
| Praktik getter, setter, dan validasi, script 49–52 | 35 menit |
| Praktik constructor dan kode produk, script 53–56 | 35 menit |
| Latihan mandiri dan pembahasan | 25 menit |
| Refleksi dan rangkuman | 10 menit |
| **Total** | **150 menit** |

## 6.4. Latihan Terarah: Mencatat Barang Toko

Bayangkan Anda membuat pencatatan barang untuk toko alat tulis. Gunakan salinan script 56 sebagai awal, lalu ubah nama class menjadi `Barang`. Gunakan kode seperti `BUK001` untuk buku dan `PEN002` untuk pulpen. Ketentuannya:

1. Pertahankan property private dan getter public.
2. Pertahankan pengisian kode produk melalui constructor dan setter private.
3. Pastikan kode produk tepat tiga huruf kapital dan tiga angka, tanpa karakter tambahan.
4. Pertahankan aturan stok integer positif.
5. Uji kode `ABC123`, `abc123`, `AB123`, dan `123ABC` secara terpisah.
6. Dengan kode valid, uji stok `1`, `0`, `-1`, `'5'`, dan `5.5` secara terpisah.
7. Catat hasil yang muncul dan alasan penerimaan atau penolakan setiap input.

## 6.5. Latihan Mandiri: Mahasiswa

Bayangkan aplikasi kampus menyimpan data seorang mahasiswa, misalnya NIM `"2026001"`, nama `"Siti"`, dan IPK `3.75`. NIM tetap, sedangkan nama dan IPK dapat diperbarui.

Buat class `Mahasiswa` dengan property `nim`, `nama`, dan `ipk`:

- Semua property bersifat private.
- Constructor menerima NIM, nama, dan IPK awal, lalu melakukan validasi melalui setter.
- NIM berupa string tidak kosong, diisi melalui setter private, dan dapat dibaca melalui getter public.
- Nama berupa string tidak kosong dan dapat diubah melalui setter public.
- IPK bertipe integer atau float dalam rentang **0–4**, termasuk kedua batasnya, dan dapat diubah melalui setter public.
- Input nama atau IPK yang tidak sesuai aturan saat data diubah setelah objek dibuat harus ditolak tanpa mengubah nilai sebelumnya. Tampilkan pesan kesalahan dan lanjutkan eksekusi.
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

- Encapsulation membantu menjaga data dengan menyediakan cara membaca dan mengubahnya melalui method.
- `public` dapat diakses dari luar class, `protected` juga tersedia bagi class turunan tetapi tidak bagi pemanggil luar, dan `private` hanya dapat diakses langsung dalam class yang mendeklarasikannya.
- Getter membaca data, sedangkan setter mengisi atau mengubah data. Setter dapat memeriksa input sebelum menyimpannya.
- Memeriksa jenis data saja belum cukup. Angka `-5` adalah integer, tetapi tidak cocok untuk stok yang harus positif.
- Constructor dapat menggunakan setter private untuk memvalidasi data awal. Setter tidak harus dibuka untuk pemanggil luar.
- `echo` menampilkan pesan dan program tetap berjalan. `die()` menampilkan pesan lalu menghentikan program.
- Studi kasus kode produk dan stok menunjukkan bahwa input harus memenuhi format, tipe, dan rentang yang ditentukan sebelum disimpan.
