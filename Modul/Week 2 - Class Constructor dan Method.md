# MODUL PERKULIAHAN

## Mata Kuliah: Pemrograman Lanjut

### Minggu Ke-2: Penerapan Class, Constructor, dan Method

---

# 1. IDENTITAS MATA KULIAH

| Komponen       | Keterangan                                         |
| -------------- | -------------------------------------------------- |
| Mata Kuliah    | Pemrograman Lanjut                                 |
| Minggu         | 2                                                  |
| Topik          | Penerapan Class, Constructor, dan Method           |
| Dosen Pengampu | **Arif Wicaksono Septyanto, S.Kom., M.Kom.** |
| Bobot          | Menyesuaikan RPS                                   |
| Durasi         | 1 Pertemuan (3 × 50 menit)                        |

---

# 2. CAPAIAN PEMBELAJARAN LULUSAN (CPL)

Mahasiswa mampu menjelaskan dasar-dasar sistem informasi dan membangun sistem informasi untuk mencapai tujuan organisasi dengan menggunakan berbagai metodologi pengembangan sistem, alat pemodelan sistem, dan analisis kebutuhan pengguna.

---

# 3. CAPAIAN PEMBELAJARAN MATA KULIAH (CPMK)

Mahasiswa mampu merancang dan mengembangkan aplikasi PHP berbasis pemrograman berorientasi objek dengan menerapkan *encapsulation*, *inheritance*, *polymorphism*, akses database, penanganan exception, dan validasi class untuk menyelesaikan permasalahan aplikasi (C5).

---

# 4. KOMPONEN PENILAIAN MATA KULIAH

Penilaian mata kuliah Pemrograman Lanjut terdiri atas beberapa komponen yang digunakan untuk mengukur ketercapaian CPMK mahasiswa selama satu semester.

| Komponen Penilaian                                  |     Persentase |
| --------------------------------------------------- | -------------: |
| Tugas                                               |            20% |
| Review                                              |            10% |
| Ujian Tengah Semester (UTS)                         |            20% |
| Ujian Akhir Semester (UAS) – Proyek*Case Method* |            20% |
| Praktikum                                           |            20% |
| Kuis                                                |            10% |
| **Total**                                     | **100%** |

---

# 5. SUB-CPMK

Setelah mengikuti perkuliahan minggu kedua, mahasiswa mampu:

> **Mahasiswa mampu mengaplikasikan konsep class, constructor, dan method (C3, A1).**

---

# 6. BAHAN KAJIAN

Bahan kajian pada pertemuan minggu kedua meliputi:

* Pengertian dan penggunaan *constructor*
* Penggunaan *destructor*
* *Static property* dan *static method*
* *Class constant*
* Penggunaan keyword `self`, `parent`, dan `$this`
* *Method chaining*
* Interaksi antar objek (object sebagai parameter dan return value)
* *Type hinting*, interface, dan operator `instanceof`
* Penerapan constructor dengan parameter default dan validasi

---

# 7. INDIKATOR PENILAIAN

Indikator penilaian pada pertemuan minggu kedua adalah:

> **Ketepatan dalam mengaplikasikan konsep class, constructor, dan method.**

Indikator tersebut dijabarkan ke dalam kemampuan sebagai berikut:

1. Menjelaskan bahwa *constructor* dijalankan secara otomatis ketika sebuah objek dibuat.
2. Membuat *constructor* untuk memberikan nilai awal pada properti objek.
3. Mendefinisikan dan mengakses *static property* serta *static method*.
4. Membuat *class constant* dan menggunakannya di dalam class.
5. Membedakan penggunaan keyword `self` dan `$this`.
6. Menerapkan *method chaining* untuk merangkai pemanggilan method.
7. Menggunakan objek sebagai parameter dan nilai kembalian (*return value*) method.
8. Merancang *constructor* dengan validasi tipe data input.
9. Menjelaskan penggunaan *destructor* dan member static pada pewarisan class.
10. Menerapkan *type hinting* dan `instanceof` untuk memeriksa tipe objek.

---

# 8. REFERENSI UTAMA

1. Gamma, E., Helm, R., Johnson, R. E., & Vlissides, J. (2016). *Design Patterns: Elements of Reusable Object-Oriented Software*. Addison-Wesley.
2. MacIntyre, P., & Tatroe, K. (2016). *Programming PHP*. O'Reilly Media.

---

# 9. MATERI PERKULIAHAN

## 9.1. Constructor

**Constructor adalah method khusus yang otomatis dijalankan ketika sebuah objek dibuat.** Dalam PHP, constructor ditulis menggunakan method `__construct()` (dua garis bawah di awal). Constructor biasanya digunakan untuk memberikan nilai awal pada properti agar objek langsung siap digunakan.

```php
<?php
class Mahasiswa {
    public $nama;
    public $nim;

    public function __construct($nama, $nim) {
        $this->nama = $nama;
        $this->nim  = $nim;

        echo "Objek Mahasiswa berhasil dibuat.<br>";
    }

    public function tampilkanData() {
        return "Nama: {$this->nama} | NIM: {$this->nim}";
    }
}

// Saat keyword new dijalankan, __construct() otomatis dipanggil.
$mahasiswa = new Mahasiswa("Budi", "12345678");

echo $mahasiswa->tampilkanData();
// Nama: Budi | NIM: 12345678
```

Alur pembuatan objek pada contoh tersebut adalah:

1. Program menjalankan `new Mahasiswa("Budi", "12345678")`.
2. PHP membuat sebuah objek dari class `Mahasiswa`.
3. PHP otomatis menjalankan method `__construct()`.
4. Nilai parameter disimpan ke properti objek melalui `$this`.
5. Objek yang sudah memiliki nilai awal disimpan dalam variabel `$mahasiswa`.

Keyword `$this` merujuk pada **objek yang sedang digunakan**. Karena itu, `$this->nama` berarti properti `nama` milik objek tersebut.

### Constructor Tanpa Parameter

Constructor tidak harus memiliki parameter. Constructor tanpa parameter dapat digunakan untuk menetapkan nilai awal yang sama pada setiap objek.

```php
<?php
class Lampu {
    public $status;

    public function __construct() {
        $this->status = "mati";
    }
}

$lampuKelas = new Lampu();
echo $lampuKelas->status; // mati
```

### Perbedaan Constructor dan Method Biasa

| Aspek            | Constructor                                | Method biasa                             |
| ---------------- | ------------------------------------------ | ---------------------------------------- |
| Nama method      | `__construct()`                          | Bebas sesuai kebutuhan                   |
| Waktu dijalankan | Otomatis ketika objek dibuat dengan`new` | Ketika dipanggil secara eksplisit        |
| Tujuan umum      | Memberikan nilai atau kondisi awal objek   | Menjalankan perilaku tertentu dari objek |
| Cara menjalankan | `new NamaClass(...)`                     | `$objek->namaMethod()`                 |

> **Catatan:** Setiap kali objek baru dibuat, constructor akan dijalankan kembali untuk objek tersebut. Argumen pada `new NamaClass(...)` harus sesuai dengan parameter yang didefinisikan dalam `__construct()`.

---

## 9.2. Static Property dan Static Method

Pada pertemuan sebelumnya, semua properti dan method diakses melalui objek. PHP juga menyediakan mekanisme lain di mana properti dan method **melekat langsung pada class**, bukan pada objek. Ini disebut *static property* dan *static method*.

Untuk mendefinisikan static, tambahkan keyword `static` setelah *access modifier*. Untuk mengaksesnya, gunakan nama class diikuti operator `::` (bukan `->` seperti objek biasa).

```php
<?php
class Perpustakaan {
    public static $totalBuku = 0;

    public static function tambahBuku() {
        self::$totalBuku++;
    }

    public static function cekTotal() {
        return "Total buku: " . self::$totalBuku;
    }
}

Perpustakaan::tambahBuku();
Perpustakaan::tambahBuku();
Perpustakaan::tambahBuku();

echo Perpustakaan::cekTotal(); // Total buku: 3
echo "<br>";
echo Perpustakaan::$totalBuku; // 3
```

Karena `$totalBuku` melekat pada class (bukan objek), nilainya **dibagi oleh semua objek** yang dibuat dari class tersebut.

### Perbedaan `self` dan `$this`

| Keyword   | Merujuk ke     | Digunakan untuk                      |
| --------- | -------------- | ------------------------------------ |
| `$this` | Objek saat ini | Mengakses properti/method non-static |
| `self`  | Class saat ini | Mengakses properti/method static     |

```php
<?php
class Buku {
    private $judul;
    public static $jumlahDibuat = 0;

    public function __construct($judul) {
        $this->judul = $judul;          // $this untuk non-static
        self::$jumlahDibuat++;          // self untuk static
    }

    public function getJudul() {
        return $this->judul;
    }

    public static function getJumlah() {
        return "Objek dibuat: " . self::$jumlahDibuat;
    }
}

$b1 = new Buku("Pemrograman PHP");
$b2 = new Buku("Design Patterns");
$b3 = new Buku("Clean Code");

echo Buku::getJumlah(); // Objek dibuat: 3
```

---

## 9.3. Class Constant

*Class constant* adalah nilai tetap yang didefinisikan di dalam class menggunakan keyword `const`. Berbeda dengan properti biasa, nilainya tidak dapat diubah sepanjang program berjalan.

```php
<?php
class Konversi {
    const KM_PER_MILE  = 1.60934;
    const METER_PER_KM = 1000;

    public static function milKeKm($mil) {
        return $mil * self::KM_PER_MILE;
    }

    public static function kmKeMeter($km) {
        return $km * self::METER_PER_KM;
    }
}

echo Konversi::milKeKm(10) . " km<br>";    // 16.0934 km
echo Konversi::kmKeMeter(5) . " meter<br>"; // 5000 meter
echo Konversi::KM_PER_MILE;                // 1.60934
```

> **Catatan:** Konstanta class diakses menggunakan `NamaClass::NAMA_KONSTANTA` atau `self::NAMA_KONSTANTA` dari dalam class. Nama konstanta ditulis dengan huruf kapital semua sebagai konvensi.

---

## 9.4. Method Chaining

*Method chaining* adalah teknik memanggil beberapa method secara berurutan dalam satu baris kode. Caranya, setiap method mengembalikan `$this` agar method berikutnya bisa langsung dipanggil.

**Tanpa method chaining:**

```php
<?php
class QueryBuilder {
    private $table  = '';
    private $where  = '';
    private $limit  = '';

    public function from($table) {
        $this->table = $table;
    }

    public function where($kondisi) {
        $this->where = " WHERE $kondisi";
    }

    public function limit($n) {
        $this->limit = " LIMIT $n";
    }

    public function build() {
        return "SELECT * FROM {$this->table}{$this->where}{$this->limit}";
    }
}

$qb = new QueryBuilder();
$qb->from('mahasiswa');
$qb->where('ipk > 3.5');
$qb->limit(10);
echo $qb->build();
// SELECT * FROM mahasiswa WHERE ipk > 3.5 LIMIT 10
```

**Dengan method chaining** (setiap method return `$this`):

```php
<?php
class QueryBuilder {
    private $table  = '';
    private $where  = '';
    private $limit  = '';

    public function from($table) {
        $this->table = $table;
        return $this; // kembalikan objek agar bisa di-chain
    }

    public function where($kondisi) {
        $this->where = " WHERE $kondisi";
        return $this;
    }

    public function limit($n) {
        $this->limit = " LIMIT $n";
        return $this;
    }

    public function build() {
        return "SELECT * FROM {$this->table}{$this->where}{$this->limit}";
    }
}

$qb = new QueryBuilder();
$query = $qb->from('mahasiswa')
            ->where('ipk > 3.5')
            ->limit(10)
            ->build();

echo $query;
// SELECT * FROM mahasiswa WHERE ipk > 3.5 LIMIT 10
```

Method chaining membuat kode lebih ringkas dan mudah dibaca.

---

## 9.5. Objek sebagai Parameter dan Return Value

Method dapat menerima objek sebagai parameter maupun mengembalikan objek sebagai nilai kembalian. Ini memungkinkan class-class berbeda saling berinteraksi.

### Objek sebagai Parameter

```php
<?php
class Mahasiswa {
    public $nama;
    public $ipk;

    public function __construct($nama, $ipk) {
        $this->nama = $nama;
        $this->ipk  = $ipk;
    }
}

class Beasiswa {
    private $kuota;

    public function __construct($kuota) {
        $this->kuota = $kuota;
    }

    public function cekEligible(Mahasiswa $mhs) {
        if ($mhs->ipk >= 3.5) {
            return "{$mhs->nama} layak mendapat beasiswa.";
        }
        return "{$mhs->nama} belum memenuhi syarat IPK.";
    }
}

$mhs1 = new Mahasiswa("Budi", 3.7);
$mhs2 = new Mahasiswa("Ani", 3.2);

$beasiswa = new Beasiswa(10);
echo $beasiswa->cekEligible($mhs1) . "<br>"; // Budi layak mendapat beasiswa.
echo $beasiswa->cekEligible($mhs2) . "<br>"; // Ani belum memenuhi syarat IPK.
```

### Objek sebagai Return Value

```php
<?php
class Mahasiswa {
    public $nama;
    public $ipk;

    public function __construct($nama, $ipk) {
        $this->nama = $nama;
        $this->ipk  = $ipk;
    }
}

class Database {
    private $data = [];

    public function tambah(Mahasiswa $mhs) {
        $this->data[] = $mhs;
        return $this; // method chaining
    }

    public function cariTerbaik() {
        $terbaik = null;
        foreach ($this->data as $mhs) {
            if ($terbaik === null || $mhs->ipk > $terbaik->ipk) {
                $terbaik = $mhs;
            }
        }
        return $terbaik; // mengembalikan objek Mahasiswa
    }
}

$db = new Database();
$db->tambah(new Mahasiswa("Budi", 3.7))
   ->tambah(new Mahasiswa("Ani", 3.9))
   ->tambah(new Mahasiswa("Cici", 3.5));

$terbaik = $db->cariTerbaik();
echo "Mahasiswa terbaik: {$terbaik->nama} (IPK: {$terbaik->ipk})";
// Mahasiswa terbaik: Ani (IPK: 3.9)
```

---

## 9.6. Constructor dengan Validasi

Constructor yang baik tidak hanya mengisi properti, tetapi juga memvalidasi data yang masuk. Ini mencegah objek terbuat dalam keadaan tidak valid.

```php
<?php
class NilaiMahasiswa {
    private $nim;
    private $mataKuliah;
    private $nilai;

    public function __construct($nim, $mataKuliah, $nilai) {
        if (!preg_match('/^[0-9]{8}$/', $nim)) {
            throw new InvalidArgumentException("NIM harus 8 digit angka.");
        }
        if (empty(trim($mataKuliah))) {
            throw new InvalidArgumentException("Nama mata kuliah tidak boleh kosong.");
        }
        if (!is_numeric($nilai) || $nilai < 0 || $nilai > 100) {
            throw new InvalidArgumentException("Nilai harus antara 0 dan 100.");
        }

        $this->nim        = $nim;
        $this->mataKuliah = trim($mataKuliah);
        $this->nilai      = (float) $nilai;
    }

    public function getGrade() {
        if ($this->nilai >= 85) return 'A';
        if ($this->nilai >= 75) return 'B';
        if ($this->nilai >= 60) return 'C';
        if ($this->nilai >= 50) return 'D';
        return 'E';
    }

    public function tampilkan() {
        return "NIM: {$this->nim} | MK: {$this->mataKuliah} | Nilai: {$this->nilai} ({$this->getGrade()})";
    }
}

try {
    $n1 = new NilaiMahasiswa("12345678", "Pemrograman Lanjut", 88);
    echo $n1->tampilkan() . "<br>";
    // NIM: 12345678 | MK: Pemrograman Lanjut | Nilai: 88 (A)

    $n2 = new NilaiMahasiswa("99999999", "Basis Data", 72);
    echo $n2->tampilkan() . "<br>";
    // NIM: 99999999 | MK: Basis Data | Nilai: 72 (C)

    $n3 = new NilaiMahasiswa("123", "Jaringan", 50); // NIM salah
} catch (InvalidArgumentException $e) {
    echo "Error: " . $e->getMessage();
    // Error: NIM harus 8 digit angka.
}
```

> **Catatan:** Melempar exception (`throw`) dari constructor adalah cara yang tepat untuk menangani data tidak valid. Ini lebih baik daripada membiarkan objek terbuat dengan data kosong atau salah.

---

## 9.7. Destructor

**Destructor** adalah method khusus `__destruct()` yang dijalankan ketika objek akan dihancurkan, biasanya ketika program selesai. Destructor dapat digunakan untuk pekerjaan pembersihan, misalnya menutup file atau koneksi database.

```php
<?php
class Perangkat {
    public function __construct() {
        echo "Constructor dijalankan.<br>";
    }

    public function __destruct() {
        echo "Destructor dijalankan.<br>";
    }
}

$perangkat01 = new Perangkat();
$perangkat02 = new Perangkat();
```

> **Catatan:** Constructor berjalan saat `new` digunakan. Destructor tidak dipanggil secara manual dalam penggunaan normal; PHP menjalankannya saat objek tidak lagi digunakan atau eksekusi program berakhir.

## 9.8. Constructor dengan Parameter Default dan Validasi Setter

Parameter constructor dapat memiliki nilai default. Dengan demikian, pemanggil boleh tidak mengisi parameter tersebut.

```php
<?php
class Perangkat {
    public $jenis;
    public $merek;
    public $stok;

    public function __construct($jenis, $merek, $stok = 10) {
        $this->jenis = $jenis;
        $this->merek = $merek;
        $this->stok = $stok;
    }
}

$monitor = new Perangkat("Monitor", "NusaTech", 20);
$mesinCuci = new Perangkat("Mesin cuci", "LenteraTech");
// Stok $mesinCuci bernilai 10.
```

Validasi juga dapat dipisahkan ke method setter privat. Constructor cukup memanggil setter tersebut sehingga aturan validasi tetap berada dalam class dan dapat digunakan kembali.

```php
<?php
class Perangkat {
    private $merek;
    private $stok;

    private function setMerek($merek) {
        if (!is_string($merek)) {
            throw new InvalidArgumentException("Merek harus berupa string.");
        }
        $this->merek = $merek;
    }

    private function setStok($stok) {
        if (!is_int($stok) || $stok < 0) {
            throw new InvalidArgumentException("Stok harus bilangan bulat positif.");
        }
        $this->stok = $stok;
    }

    public function __construct($merek, $stok) {
        $this->setMerek($merek);
        $this->setStok($stok);
    }
}
```

## 9.9. Static Member pada Pewarisan

Class turunan mewarisi static property dan static method milik parent. Dari dalam class turunan, `self::` merujuk pada class tempat kode ditulis, sedangkan `parent::` secara eksplisit merujuk pada parent class. Nama parent class juga dapat digunakan langsung.

```php
<?php
class Perangkat {
    private static $jumlahPerangkat = 100;

    public static function cekProduk() {
        return "Total perangkat ada " . self::$jumlahPerangkat;
    }
}

class Blender extends Perangkat {
    public function cekBlender() {
        return self::cekProduk() . ", termasuk 3 jenis blender";
    }
}

class HairDryer extends Perangkat {
    public function cekHairDryer() {
        return parent::cekProduk() . ", termasuk 5 jenis hair dryer";
    }
}
```

Static property atau constant juga dapat dibuat `private` agar hanya method di dalam class yang dapat mengaksesnya. Pola ini menjaga data level class tetap terenkapsulasi.

## 9.10. Static Method sebagai Helper

Class helper mengelompokkan fungsi yang tidak membutuhkan data objek. Semua method dipanggil melalui nama class sehingga objek helper tidak perlu dibuat.

```php
<?php
class ProdukHelper {
    public static function cekValidKodeProduk($kodeProduk) {
        return preg_match('/^[A-Z]{3}[0-9]{3}$/', $kodeProduk) === 1;
    }

    public static function cekValidMerek($merek) {
        $merekTersedia = ["NusaTech", "LenteraTech", "CakraDigital"];
        return in_array($merek, $merekTersedia, true);
    }
}

echo ProdukHelper::cekValidKodeProduk("AAA545"); // 1
```

## 9.11. Type Hinting, Interface, dan `instanceof`

Type hinting memastikan parameter menerima objek dari class, class turunan, atau interface yang sesuai. Jika parameter diberi type hint parent class, objek dari class turunannya juga dapat digunakan. Jika diberi type hint interface, semua class yang mengimplementasikan interface tersebut dapat diterima.

```php
<?php
interface SmartElectronic {
    public function cekOS();
}

class Monitor implements SmartElectronic {
    public function cekOS() {
        return "Android 9.0";
    }
}

function tampilkanOS(SmartElectronic $perangkat) {
    return $perangkat->cekOS();
}

$monitor = new Monitor();
echo tampilkanOS($monitor);
echo $monitor instanceof SmartElectronic; // 1
```

Operator `instanceof` memeriksa tipe objek saat program berjalan. Operator ini dapat memeriksa hubungan objek dengan class parent, class itu sendiri, maupun interface; hasilnya berupa `true` atau `false`.

## 9.12. Rangkuman

| Konsep                  | Cara Akses                                        | Keterangan                                  |
| ----------------------- | ------------------------------------------------- | ------------------------------------------- |
| *Constructor*         | `public function __construct(...)`              | Otomatis dijalankan ketika objek dibuat     |
| *Static property*     | `NamaClass::$prop` atau `self::$prop`         | Dibagi semua objek, tidak perlu instansiasi |
| *Static method*       | `NamaClass::method()` atau `self::method()`   | Dapat dipanggil tanpa membuat objek         |
| *Class constant*      | `NamaClass::KONSTANTA` atau `self::KONSTANTA` | Nilai tetap, tidak bisa diubah              |
| *Method chaining*     | `$obj->m1()->m2()->m3()`                        | Setiap method`return $this`               |
| Objek sebagai parameter | Type hint:`function f(NamaClass $obj)`          | Memastikan tipe yang diterima               |
| Validasi di constructor | `throw new Exception(...)`                      | Mencegah objek dengan data tidak valid      |
| *Destructor*          | `public function __destruct()`                   | Pembersihan saat objek dihancurkan          |
| Parameter default     | `__construct($stok = 10)`                       | Nilai digunakan jika argumen tidak diisi    |
| Helper static         | `NamaHelper::method()`                           | Fungsi utilitas tanpa membuat objek         |
| `instanceof`          | `$objek instanceof NamaClass`                   | Memeriksa tipe objek saat runtime           |
