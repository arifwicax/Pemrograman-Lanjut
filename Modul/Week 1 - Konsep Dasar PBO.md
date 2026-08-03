# MODUL PERKULIAHAN

## Mata Kuliah: Pemrograman Lanjut

### Minggu Ke-1: Pengenalan Pemrograman Berorientasi Objek (*Object-Oriented Programming*)

---

# 1. IDENTITAS MATA KULIAH

| Komponen       | Keterangan                                                         |
| -------------- | ------------------------------------------------------------------ |
| Mata Kuliah    | Pemrograman Lanjut                                                 |
| Minggu         | 1                                                                  |
| Topik          | Pengenalan Pemrograman Berorientasi Objek (OOP)                    |
| Dosen Pengampu | **Arif Wicaksono Septyanto, S.Kom., M.Kom.**                       |
| Bobot          | Menyesuaikan RPS                                                   |
| Durasi         | 1 Pertemuan (3 × 50 menit)                                         |

---

# 2. CAPAIAN PEMBELAJARAN LULUSAN (CPL)

Mahasiswa mampu menjelaskan dasar-dasar sistem informasi dan membangun sistem informasi untuk mencapai tujuan organisasi dengan menggunakan berbagai metodologi pengembangan sistem, alat pemodelan sistem, dan analisis kebutuhan pengguna.

---

# 3. CAPAIAN PEMBELAJARAN MATA KULIAH (CPMK)

Mahasiswa mampu merancang dan mengembangkan aplikasi PHP berbasis pemrograman berorientasi objek dengan menerapkan *encapsulation*, *inheritance*, *polymorphism*, akses database, penanganan exception, dan validasi class untuk menyelesaikan permasalahan aplikasi (C5).

---

# 4. KOMPONEN PENILAIAN MATA KULIAH

Penilaian mata kuliah Pemrograman Lanjut terdiri atas beberapa komponen yang digunakan untuk mengukur ketercapaian CPMK mahasiswa selama satu semester.

| Komponen Penilaian                                | Persentase |
| ------------------------------------------------- | ---------: |
| Tugas                                             |        20% |
| Review                                            |        10% |
| Ujian Tengah Semester (UTS)                       |        20% |
| Ujian Akhir Semester (UAS) – Proyek *Case Method* |        20% |
| Praktikum                                         |        20% |
| Kuis                                              |        10% |
| **Total**                                         |   **100%** |

---

# 5. SUB-CPMK

Setelah mengikuti perkuliahan minggu pertama, mahasiswa mampu:

> **Mahasiswa mampu menjelaskan konsep dasar pemrograman berorientasi objek (PBO) seperti objek, kelas, atribut dan metode (C2).**

---

# 6. BAHAN KAJIAN

Bahan kajian pada pertemuan minggu pertama meliputi:

* Pengantar Pemrograman Berorientasi Objek (*Object-Oriented Programming*)
* Konsep objek (*Object*)
* Konsep kelas (*Class*)
* Atribut (*Attribute*)
* Metode (*Method*)
* Perbedaan pemrograman prosedural dan pemrograman berorientasi objek
* Penerapan OOP dalam pengembangan perangkat lunak

---

# 7. INDIKATOR PENILAIAN

Indikator penilaian pada pertemuan minggu pertama adalah:

> **Ketepatan dalam menjelaskan konsep dasar Pemrograman Berorientasi Objek (PBO), seperti objek, kelas, atribut, dan metode.**

Indikator tersebut dijabarkan ke dalam kemampuan sebagai berikut:

1. Menjelaskan pengertian Pemrograman Berorientasi Objek (OOP).
2. Menjelaskan konsep objek (*object*) dan kelas (*class*).
3. Membedakan konsep objek dan kelas.
4. Menjelaskan konsep atribut (*attribute*) dan metode (*method*).
5. Mengidentifikasi objek, kelas, atribut, dan metode pada suatu studi kasus sederhana.
6. Memberikan contoh penerapan konsep OOP dalam kehidupan sehari-hari maupun pengembangan perangkat lunak.
7. Menjelaskan perbedaan antara paradigma pemrograman prosedural dan pemrograman berorientasi objek.

---

# 8. REFERENSI UTAMA

1. Gamma, E., Helm, R., Johnson, R. E., & Vlissides, J. (2016). *Design Patterns: Elements of Reusable Object-Oriented Software*. Addison-Wesley.
2. MacIntyre, P., & Tatroe, K. (2016). *Programming PHP*. O'Reilly Media.

---

# 9. MATERI PERKULIAHAN

## 9.1. Pengertian Pemrograman Berorientasi Objek

Pemrograman Berorientasi Objek (*Object-Oriented Programming* / OOP) adalah paradigma penulisan kode program yang memanfaatkan **objek** sebagai unit utama untuk memecahkan masalah. Setiap objek dapat berfungsi secara mandiri, memiliki data (disebut **atribut** atau *property*), dan perilaku (disebut **metode** atau *method*).

Secara formal, definisi OOP menurut Wikipedia adalah:

> *"Object-oriented programming (OOP) is a programming paradigm based on the concept of "objects", which may contain data, in the form of fields, often known as attributes; and code, in the form of procedures, often known as methods."*

Tiga prinsip dasar OOP yang menjadi fondasi paradigma ini adalah:

| Prinsip | Penjelasan Singkat |
| --- | --- |
| *Encapsulation* | Pembungkusan data dan method dalam satu unit (class), dengan pengaturan hak akses |
| *Inheritance* | Kemampuan sebuah class mewarisi properti dan method dari class lain |
| *Polymorphism* | Kemampuan objek berbeda merespons perintah yang sama dengan cara yang berbeda |

---

## 9.2. Kenapa Harus OOP?

Selain OOP, terdapat paradigma lain yang umum digunakan, yaitu **pemrograman prosedural**. Pada pemrograman prosedural, kode ditulis secara berurutan dari atas ke bawah dan dipecah ke dalam *function-function* sederhana.

Pemrograman prosedural cocok untuk aplikasi kecil, namun memiliki keterbatasan seiring bertambahnya kompleksitas sistem:

1. **Tidak ada pengelompokan function** — seluruh function dapat diakses dari mana saja dan berpotensi konflik nama, terutama dalam pengerjaan tim.
2. **Alur linear** — perubahan di satu titik mudah berdampak pada bagian lain yang tidak terduga.
3. **Kode terlalu spesifik** — sulit digunakan kembali (*reuse*) untuk kasus yang berbeda.

OOP hadir untuk mengatasi keterbatasan tersebut. Dengan OOP:
- Setiap bagian program dikelola sebagai objek yang **terpisah dan mandiri**, sehingga perubahan pada satu objek tidak langsung memengaruhi objek lain.
- Pembagian tugas dalam tim menjadi lebih jelas karena setiap programmer mengerjakan objek yang berbeda.
- Kode lebih mudah dikembangkan dan dipelihara dalam jangka panjang.

---

## 9.3. Kekurangan OOP

OOP tidak selalu menjadi pilihan terbaik. Berikut beberapa kelemahannya:

1. **Membutuhkan perencanaan awal** — perlu merancang struktur objek (biasanya menggunakan *Class Diagram* atau UML) sebelum mulai membuat kode.
2. **Perubahan pola pikir (*mindset*)** — menerapkan OOP secara konsisten membutuhkan pengalaman dan pemahaman mendalam tentang prinsip-prinsipnya.
3. **Kode lebih panjang untuk aplikasi sederhana** — dibandingkan prosedural, implementasi OOP memerlukan lebih banyak baris kode untuk masalah yang sederhana.

---

## 9.4. OOP vs Prosedural: Mana yang Dipilih?

Keduanya memiliki peruntukannya masing-masing:

- Gunakan **prosedural** untuk aplikasi sederhana, tugas perkuliahan, atau proyek yang kemungkinan tidak akan direvisi secara signifikan.
- Gunakan **OOP** untuk aplikasi yang kompleks, membutuhkan fleksibilitas tinggi, atau dikerjakan dalam tim.

Dalam praktik nyata, keduanya sering dikombinasikan. Kode utama tetap prosedural, namun beberapa bagian memanfaatkan objek atau *library* berbasis OOP.

---

## 9.5. OOP di PHP

PHP adalah bahasa pemrograman **multi-paradigma** yang mendukung baik pemrograman prosedural maupun OOP. Dukungan OOP di PHP mulai diperkenalkan pada versi 4 dan disempurnakan pada versi 5 serta 7.

Memahami OOP di PHP menjadi keharusan bagi pengembang web modern, karena:
- Framework populer seperti **Laravel** dan **CodeIgniter** dibangun di atas prinsip OOP.
- Mayoritas lowongan kerja PHP mensyaratkan penguasaan OOP.

Konsep OOP di PHP juga berlaku di bahasa pemrograman lain seperti Java, Python, C++, dan JavaScript.

---

## 9.6. Class dan Object

**Class** adalah *blueprint* (cetakan/kerangka) yang mendefinisikan struktur dan perilaku sebuah objek. **Object** adalah implementasi konkret dari class tersebut.

> **Analogi:** Class adalah gambar desain rumah dari arsitek. Dari satu desain yang sama, bisa dibangun banyak rumah. Setiap rumah yang dibangun adalah objek.

### Membuat Class dan Object di PHP

Sebagai contoh, kita akan membuat class `Buku` untuk sistem perpustakaan:

```php
<?php
class Buku {
    // isi class
}

// Membuat tiga object dari class Buku
$buku01    = new Buku();
$buku02    = new Buku();
$buku03    = new Buku();
```

Proses pembuatan objek dari sebuah class disebut **instansiasi objek** (*object instantiation*), dilakukan menggunakan keyword `new`.

---

## 9.7. Properti dan Method

**Properti** adalah variabel yang berada di dalam class, sedangkan **method** adalah function yang berada di dalam class. Keduanya ditulis dengan tambahan *access modifier* di bagian awal.

*Access modifier* `public` berarti properti atau method dapat diakses dari mana saja, termasuk dari luar class.

```php
<?php
class Buku {
    public $judul     = "Pemrograman PHP";
    public $pengarang = "Peter MacIntyre";
    public $tahun     = 2016;

    public function tampilInfo() {
        return "Informasi buku berhasil dimuat.";
    }
}

$buku01 = new Buku();
```

---

## 9.8. Cara Mengakses Properti dan Method

Properti dan method diakses melalui **objek** (bukan class secara langsung) menggunakan operator panah `->`.

```php
<?php
$buku01 = new Buku();

echo $buku01->judul;       // Pemrograman PHP
echo $buku01->pengarang;   // Peter MacIntyre
echo $buku01->tahun;       // 2016
echo $buku01->tampilInfo(); // Informasi buku berhasil dimuat.
```

Nilai properti juga dapat diubah dari luar class:

```php
<?php
$buku02            = new Buku();
$buku02->judul     = "Design Patterns";
$buku02->pengarang = "Erich Gamma";
$buku02->tahun     = 2016;
```

> **Catatan:** Penulisan yang benar adalah `$objek->properti` (tanpa tanda `$` pada nama properti setelah `->`)

---

## 9.9. Pseudo-variable `$this`

Di dalam sebuah class, untuk merujuk ke properti atau method **milik objek itu sendiri**, digunakan variabel khusus `$this`.

**Permasalahan tanpa `$this`:**

```php
<?php
class Buku {
    public $judul = "";

    public function tampilInfo() {
        return $judul . " tersedia di perpustakaan."; // ERROR: $judul tidak dikenali
    }
}
```

**Solusi menggunakan `$this`:**

```php
<?php
class Buku {
    public $judul;
    public $pengarang;

    public function tampilInfo() {
        return $this->judul . " oleh " . $this->pengarang . " tersedia di perpustakaan.";
    }
}

$buku01            = new Buku();
$buku01->judul     = "Pemrograman PHP";
$buku01->pengarang = "Peter MacIntyre";

$buku02            = new Buku();
$buku02->judul     = "Design Patterns";
$buku02->pengarang = "Erich Gamma";

echo $buku01->tampilInfo(); // Pemrograman PHP oleh Peter MacIntyre tersedia di perpustakaan.
echo $buku02->tampilInfo(); // Design Patterns oleh Erich Gamma tersedia di perpustakaan.
```

`$this` secara otomatis merujuk ke objek yang sedang memanggil method tersebut, sehingga `$this->judul` pada `$buku01` akan berbeda nilainya dengan `$this->judul` pada `$buku02`.

---

## 9.10. Argument pada Method

Method dapat menerima *argument* (nilai masukan) layaknya function biasa. Nilai yang dikirim saat pemanggilan disebut **argument**, sedangkan variabel penampungnya di dalam definisi method disebut **parameter**.

```php
<?php
class Buku {
    public $stok;

    public function pinjamBuku($jumlah) {
        $this->stok = $this->stok - $jumlah;
    }

    public function cekStok() {
        return "Sisa stok: " . $this->stok . "<br>";
    }
}

$buku01       = new Buku();
$buku01->stok = 20;

$buku01->pinjamBuku(3);
echo $buku01->cekStok(); // Sisa stok: 17

$buku01->pinjamBuku(5);
echo $buku01->cekStok(); // Sisa stok: 12
```

Method juga mendukung **default parameter**, yaitu nilai yang digunakan secara otomatis apabila method dipanggil tanpa argument:

```php
<?php
public function pinjamBuku($jumlah = 1) {
    $this->stok = $this->stok - $jumlah;
}
```

---

## 9.11. Batas Materi Minggu Pertama

Minggu pertama berakhir pada kemampuan menjelaskan dan mengidentifikasi class, object, property/atribut, dan method. Constructor serta penerapan method dibahas pada Minggu 2 agar tidak terjadi duplikasi materi.
