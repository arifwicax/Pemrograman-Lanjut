# MODUL PERKULIAHAN

## Mata Kuliah: Pemrograman Lanjut

### Minggu Ke-5: Exception Handling dan Pengantar MySQLi Object

# 1. IDENTITAS MATA KULIAH

| Komponen       | Keterangan                                         |
| -------------- | -------------------------------------------------- |
| Mata Kuliah    | Pemrograman Lanjut                                 |
| Minggu         | 5                                                  |
| Topik          | Exception Handling dan Pengantar MySQLi Object     |
| Dosen Pengampu | **Arif Wicaksono Septyanto, S.Kom., M.Kom.** |
| Durasi         | 1 Pertemuan (3 × 50 menit)                        |

# 2. SUB-CPMK

> **Mahasiswa mampu mengaplikasikan exception handling, Mysqli Object (C3, A4, P2).**

# 3. POSISI DALAM RANGKAIAN MINGGU 5–7

Minggu 5 berfokus pada exception handling. Minggu 6 menerapkannya pada akses database dengan MySQLi Object, sedangkan Minggu 7 mengintegrasikannya ke aplikasi CRUD.

# 4. BAHAN KAJIAN

- Perbedaan penanganan error tanpa exception (`@`, `if-else`, `die()`) dengan exception handling.
- `throw`, `try`, `catch`, dan `finally`.
- Method bawaan object exception: `getMessage()`, `getCode()`, `getFile()`, `getLine()`, `getTrace()`, `getTraceAsString()`.
- Penanganan banyak blok `try-catch` dan banyak tipe exception sekaligus (multi-catch).
- Custom exception dengan `extends Exception`.
- `set_exception_handler()` untuk menangani exception yang tidak tertangkap.
- Trace pemanggilan function berlapis di dalam exception.
- Pengantar koneksi database dengan MySQLi Object serta penanganan kegagalan koneksi.

# 5. INDIKATOR PENILAIAN

Mahasiswa mampu:

1. Menjelaskan perbedaan penanganan error menggunakan `@`, `if-else`, atau `die()` dengan penanganan menggunakan exception.
2. Melempar exception dengan `throw` dan menangkapnya dengan blok `try-catch`.
3. Membaca informasi exception melalui `getMessage()`, `getCode()`, `getFile()`, `getLine()`, dan `getTrace()`/`getTraceAsString()`.
4. Menangani lebih dari satu jenis exception dalam satu blok `try-catch` menggunakan banyak blok `catch`.
5. Membuat custom exception dengan cara meng-extend class `Exception`.
6. Menggunakan `set_exception_handler()` untuk menangani exception secara terpusat.
7. Menelusuri urutan pemanggilan function (call stack) melalui `getTrace()` pada function yang saling memanggil.
8. Menggunakan blok `finally` untuk menjalankan kode yang harus tetap dieksekusi baik terjadi exception maupun tidak.
9. Membuat koneksi database dengan MySQLi Object serta menangani kegagalan koneksi tanpa menampilkan informasi sensitif kepada pengguna.

**Bukti ketercapaian Sub-CPMK:** mahasiswa menulis dan menjalankan program yang melempar serta menangkap exception, membuat custom exception, dan menangani kegagalan koneksi database. Latihan di bagian akhir menjadi sarana untuk menunjukkan penerapan tersebut.

# 6. MATERI PERKULIAHAN

Setiap blok kode pada modul ini adalah contoh terpisah. Jalankan satu contoh utuh dalam satu file PHP. Seluruh contoh dapat ditemukan pada folder [Script/Week 05](<../Script/Week%2005>) agar mahasiswa bisa langsung mempraktikkannya.

## 6.1 Masalah Penanganan Error Tanpa Exception

Sebelum mengenal exception, perhatikan dahulu function sederhana berikut yang menghitung kebalikan (1 dibagi bilangan).

```php
<?php
function hitungKebalikan($bilangan){
  return 1/$bilangan;
}

echo hitungKebalikan(2);      echo "<br>";
echo hitungKebalikan(100);    echo "<br>";
echo hitungKebalikan(0);      echo "<br>";
echo hitungKebalikan(-20);    echo "<br>";
```

Ketika `$bilangan` diisi `0`, PHP akan menampilkan **warning** `Division by zero` karena secara matematis pembagian dengan nol tidak terdefinisi. Program tetap berjalan, tetapi pesan warning tersebut tampil apa adanya di layar pengguna — sesuatu yang sebaiknya dihindari pada aplikasi nyata.

**Percobaan 1 — Menyembunyikan warning dengan `@`**

```php
<?php
function hitungKebalikan($bilangan){
  return 1/$bilangan;
}

echo hitungKebalikan(2);      echo "<br>";
echo hitungKebalikan(100);    echo "<br>";
echo @hitungKebalikan(0);     echo "<br>";
echo hitungKebalikan(-20);    echo "<br>";
```

Operator `@` menyembunyikan pesan warning. Namun, cara ini bukan solusi yang baik karena kesalahan tetap terjadi secara diam-diam (silent error) dan sulit dilacak.

**Percobaan 2 — Validasi manual dengan `if-else`**

```php
<?php
function hitungKebalikan($bilangan){
  if ($bilangan === 0){
    echo "Error: Argument \$bilangan tidak bisa diisi angka 0";
  }
  else {
    return 1/$bilangan;
  }
}
```

Cara ini lebih baik karena pesan menjadi jelas, tetapi validasi harus ditulis manual di setiap function serta pesan error bercampur dengan output normal program. Jika kondisi kesalahan bertambah, jumlah percabangan `if-else` juga bertambah:

```php
<?php
function hitungKebalikan($bilangan){
  if ($bilangan === 0){
    echo "Argument \$bilangan tidak bisa diisi angka 0";
  }
  else if ($bilangan < 0){
    echo "Argument \$bilangan tidak bisa diisi angka negatif";
  }
  else {
    return 1/$bilangan;
  }
}
```

**Percobaan 3 — Menghentikan program dengan `die()`**

```php
<?php
function hitungKebalikan($bilangan){
  if ($bilangan === 0){
    die("Argument \$bilangan tidak bisa diisi angka 0");
  }
  else if ($bilangan < 0){
    die("Argument \$bilangan tidak bisa diisi angka negatif");
  }
  else {
    return 1/$bilangan;
  }
}
```

`die()` menghentikan seluruh eksekusi script begitu kesalahan ditemukan. Masalahnya, baris kode setelahnya —termasuk pemanggilan function lain yang valid seperti `hitungKebalikan(-20)`— tidak akan pernah dijalankan.

Ketiga pendekatan di atas memiliki kelemahan yang sama: penanganan kesalahan tercampur dengan alur logika utama, sulit dipusatkan, dan sulit dibedakan jenis kesalahannya. Exception handling hadir untuk mengatasi masalah tersebut.

## 6.2 Melempar Exception dengan `throw`

Exception adalah object yang mewakili kondisi kesalahan. Exception dilempar menggunakan `throw` dan dibuat dari class bawaan PHP bernama `Exception`.

```php
<?php
function hitungKebalikan($bilangan){
  if ($bilangan === 0){
    throw new Exception("Argument \$bilangan tidak bisa diisi angka 0");
  }
  else {
    return 1/$bilangan;
  }
}

echo hitungKebalikan(2)    ."<br>";
echo hitungKebalikan(100)  ."<br>";
echo hitungKebalikan(0)    ."<br>";
echo hitungKebalikan(-20)  ."<br>";
```

Jika exception yang dilempar tidak ditangkap, PHP akan menghentikan program dengan **fatal error** `Uncaught Exception`. Supaya program tidak berhenti secara kasar, exception harus ditangkap menggunakan blok `try-catch`.

## 6.3 Blok `try-catch`

```php
<?php
function hitungKebalikan($bilangan){
  if ($bilangan === 0){
    throw new Exception("Argument \$bilangan tidak bisa diisi angka 0");
  }
  else {
    return 1/$bilangan;
  }
}

try {
  echo hitungKebalikan(0);
}
catch (Exception $e) {
  echo $e->getMessage();
}
```

Penjelasan alur:

- Kode yang berpotensi melempar exception ditempatkan di dalam blok `try`.
- Saat `throw` dieksekusi, PHP langsung melompat ke blok `catch` yang sesuai dan menghentikan sisa kode di dalam `try`.
- Blok `catch (Exception $e)` menangkap object exception ke dalam variabel `$e`, lalu isinya bisa diakses melalui method-method bawaan.
- Program tidak berhenti; baris kode setelah blok `try-catch` tetap berjalan.

## 6.4 Membaca Informasi Exception

Object exception menyimpan banyak informasi yang berguna untuk keperluan debugging, di antaranya kode, pesan, lokasi file, baris, hingga jejak pemanggilan (trace).

```php
<?php
function hitungKebalikan($bilangan){
  if ($bilangan === 0){
    throw new Exception("Argument \$bilangan tidak bisa diisi angka 0", 99);
  }
  else {
    return 1/$bilangan;
  }
}

try {
  echo hitungKebalikan(0);
}
catch (Exception $e) {
  echo $e->getMessage()       ."<br>";
  echo $e->getCode()          ."<br>";
  echo $e->getFile()          ."<br>";
  echo $e->getLine()          ."<br>";
  echo $e->getTraceAsString() ."<br>";

  echo "<pre>";
  print_r( $e->getTrace() );
  echo "</pre>";
}
```

| Method                 | Kegunaan                                                                                           |
| ---------------------- | -------------------------------------------------------------------------------------------------- |
| `getMessage()`       | Mengambil pesan yang dikirim saat`throw new Exception('pesan')`.                                 |
| `getCode()`          | Mengambil kode exception (parameter kedua saat`throw`), berguna sebagai penanda jenis kesalahan. |
| `getFile()`          | Mengambil path file tempat exception dilempar.                                                     |
| `getLine()`          | Mengambil nomor baris tempat exception dilempar.                                                   |
| `getTrace()`         | Mengambil array informasi pemanggilan function (call stack) sebelum exception terjadi.             |
| `getTraceAsString()` | Versi teks dari`getTrace()`.                                                                     |

`getTrace()` mengembalikan array, sehingga elemen di dalamnya bisa diakses dengan index, misalnya `$e->getTrace()[0]["line"]` untuk mengambil baris pemanggilan pertama:

```php
<?php
try {
  echo hitungKebalikan(0);
}
catch (Exception $e) {
  echo "Terjadi error dalam file <b>".$e->getTrace()[0]["file"]."</b>,
       di baris ke-".$e->getTrace()[0]["line"]." dengan keterangan <b>".
       $e->getMessage()."</b>.";
}
```

Informasi tersebut dapat dirangkai menjadi tampilan pesan error yang lebih informatif dan rapi, misalnya dalam bentuk HTML:

```php
<?php
try {
  echo hitungKebalikan(0);
}
catch (Exception $e) {
  echo "<h1 style='text-align:center'>=== Error ===</h1>";
  echo "<hr>";
  echo "<h2 style='text-align:center'>".$e->getMessage()."</h2>";
  echo "<p style='text-align:center'> Baris ke-".$e->getTrace()[0]["line"].
       ", di dalam ".$e->getTrace()[0]["file"]."</p>";
}
```

Object exception juga dapat langsung di-`echo`. PHP akan otomatis memanggil method `__toString()` bawaan `Exception` yang menampilkan pesan, file, baris, dan trace sekaligus:

```php
<?php
try {
  echo hitungKebalikan(0);
}
catch (Exception $e) {
  echo $e;
}
```

Cara ini praktis untuk debugging, tetapi kurang cocok ditampilkan ke pengguna akhir karena terlalu teknis dan bisa membocorkan struktur kode.

## 6.5 Beberapa Blok `try-catch` yang Berurutan

Jika ada beberapa pemanggilan function yang masing-masing berpotensi melempar exception, satu exception yang tidak tertangani akan menghentikan sisa blok `try` yang sama.

```php
<?php
try {
  echo hitungKebalikan(2)    ."<br>";
  echo hitungKebalikan(100)  ."<br>";
  echo hitungKebalikan(0)    ."<br>";
  echo hitungKebalikan(-20)  ."<br>"; // tidak pernah dijalankan
}
catch (Exception $e) {
  echo "Terjadi error di baris ke-".$e->getTrace()[0]["line"].
  " dengan keterangan <b>".$e->getMessage()."</b><br>";
}

echo "Selesai";
```

Karena `hitungKebalikan(0)` melempar exception, baris `hitungKebalikan(-20)` tidak sempat dijalankan meskipun secara logika argumennya valid.

Agar setiap pemanggilan tetap diproses secara independen, pisahkan masing-masing pemanggilan ke dalam blok `try-catch` sendiri-sendiri:

```php
<?php
try {
  echo hitungKebalikan(2)    ."<br>";
}
catch (Exception $e) {
  echo "Terjadi error di baris ke-".$e->getTrace()[0]["line"].
  " dengan keterangan <b>".$e->getMessage()."</b><br>";
}

try {
  echo hitungKebalikan(0)    ."<br>";
}
catch (Exception $e) {
  echo "Terjadi error di baris ke-".$e->getTrace()[0]["line"].
  " dengan keterangan <b>".$e->getMessage()."</b><br>";
}

try {
  echo hitungKebalikan(-20)  ."<br>";
}
catch (Exception $e) {
  echo "Terjadi error di baris ke-".$e->getTrace()[0]["line"].
  " dengan keterangan <b>".$e->getMessage()."</b><br>";
}
```

Supaya kode blok `catch` yang berulang tidak ditulis berkali-kali, pesan error dapat dipindahkan ke dalam function tersendiri:

```php
<?php
function tampilkanException($e){
  echo "Terjadi error di baris ke-".$e->getTrace()[0]["line"].
  " dengan keterangan <b>".$e->getMessage()."</b><br>";
}

try {
  echo hitungKebalikan(0)    ."<br>";
}
catch (Exception $e) {
  tampilkanException($e);
}
```

## 6.6 Menangkap Beberapa Jenis Exception (Multi-catch)

Satu blok `try` boleh diikuti lebih dari satu blok `catch` apabila kesalahan yang mungkin terjadi berjumlah lebih dari satu jenis. PHP akan mencocokkan exception yang dilempar dengan tipe pada blok `catch` secara berurutan dari atas ke bawah.

```php
<?php
function hitungKebalikan($bilangan){
  if ($bilangan === 0){
    throw new Exception("Argument \$bilangan tidak bisa diisi angka 0");
  }
  else if ($bilangan < 0){
    throw new Exception("Argument \$bilangan tidak bisa diisi angka negatif");
  }
  else {
    return 1/$bilangan;
  }
}

try {
  echo hitungKebalikan(-20);
}
catch (Exception $e) {
  echo "Terjadi error di baris ke-".$e->getTrace()[0]["line"].
  " dengan keterangan <b>".$e->getMessage()."</b><br>";
}
```

Contoh di atas masih menggunakan satu tipe exception (`Exception`) untuk dua kondisi kesalahan berbeda, sehingga pesan yang membedakan keduanya hanya berasal dari teks pesan. Agar setiap jenis kesalahan bisa dibedakan secara tipe datanya, gunakan **custom exception** (dibahas pada bagian 6.7).

## 6.7 Custom Exception

Custom exception dibuat dengan meng-extend class bawaan `Exception`. Dengan begitu, jenis kesalahan dapat dibedakan berdasarkan tipe class-nya, bukan hanya berdasarkan teks pesan.

```php
<?php
class NolException extends Exception{}
class NegatifException extends Exception{}

function hitungKebalikan($bilangan){
  if ($bilangan === 0){
    throw new NolException();
  }
  else if ($bilangan < 0){
    throw new NegatifException();
  }
  else {
    return 1/$bilangan;
  }
}

try {
  echo hitungKebalikan(0);
}
catch (NolException $e) {
  echo "Argument tidak bisa diisi angka 0 <br>";
}
catch (NegatifException $e) {
  echo "Argument tidak bisa diisi angka negatif <br>";
}
```

Karena `NolException` dan `NegatifException` sama-sama merupakan turunan `Exception` (relasi **is-a**), PHP akan mencocokkan blok `catch` sesuai tipe object yang dilempar.

Custom exception juga boleh memiliki method sendiri, misalnya untuk menyusun pesan yang lebih deskriptif:

```php
<?php
class NolException extends Exception{
  public function pesanKesalahan(){
    return "Argument tidak bisa diisi angka 0, di baris "
            .$this->getTrace()[0]["line"] ." <br>";
  }
}

class NegatifException extends Exception{
  public function pesanKesalahan(){
    return "Argument tidak bisa diisi angka negatif, di baris "
           .$this->getTrace()[0]["line"] ." <br>";
  }
}

try {
  echo hitungKebalikan(0);
}
catch (NolException $e) {
  echo $e->pesanKesalahan();
}
catch (NegatifException $e) {
  echo $e->pesanKesalahan();
}
```

Blok `catch (Exception $e)` yang generik tetap bisa ditambahkan sebagai penampung kesalahan lain di luar custom exception yang sudah didefinisikan, misalnya untuk memvalidasi tipe data argumen:

```php
<?php
function hitungKebalikan($bilangan){
  if ($bilangan === 0){
    throw new NolException();
  }
  else if ($bilangan < 0){
    throw new NegatifException();
  }
  else if (!is_numeric($bilangan)){
    throw new Exception('Argument yang diinput bukan angka');
  }
  else {
    return 1/$bilangan;
  }
}

try {
  echo hitungKebalikan('a');
}
catch (NolException $e) {
  echo $e->pesanKesalahan();
}
catch (NegatifException $e) {
  echo $e->pesanKesalahan();
}
```

> Pada contoh terakhir, `Exception` umum yang dilempar oleh `is_numeric()` tidak memiliki blok `catch (Exception $e)` sehingga tetap menjadi *uncaught exception*. Tambahkan blok `catch (Exception $e)` di baris terakhir apabila seluruh kemungkinan kesalahan ingin ditangani.

## 6.8 `set_exception_handler()`

Jika exception mungkin muncul di banyak tempat, menuliskan blok `try-catch` di setiap pemanggilan bisa jadi berulang. `set_exception_handler()` mendaftarkan satu function yang otomatis dipanggil setiap kali ada exception yang tidak tertangkap oleh `catch` mana pun.

```php
<?php
class NolException extends Exception{}
class NegatifException extends Exception{}

set_exception_handler(function($e){
  echo "Terjadi error di baris ke-".$e->getTrace()[0]["line"].
  " dengan keterangan <b>".$e->getMessage()."</b><br>";
});

function hitungKebalikan($bilangan){
  if ($bilangan === 0){
    throw new NolException("Argument tidak bisa diisi angka 0");
  }
  else if ($bilangan < 0){
    throw new NegatifException("Argument tidak bisa diisi angka negatif");
  }
  else if (!is_numeric($bilangan)){
    throw new Exception('Argument yang diinput bukan angka');
  }
  else {
    return 1/$bilangan;
  }
}

echo hitungKebalikan('X');
```

Function penangan juga boleh dituliskan terpisah, lalu namanya (dalam bentuk string) didaftarkan ke `set_exception_handler()`:

```php
<?php
set_exception_handler('tampilkanError');

function tampilkanError($e) {
  echo "Terjadi error di baris ke-".$e->getTrace()[0]["line"].
       " dengan keterangan <b>".$e->getMessage()."</b><br>";
}
```

`set_exception_handler()` cocok digunakan sebagai jaring pengaman terakhir, bukan pengganti blok `try-catch` yang memang dibutuhkan untuk mengatur alur program secara spesifik.

## 6.9 Trace pada Function yang Saling Memanggil

`getTrace()` sangat berguna ketika exception dilempar dari dalam function yang dipanggil oleh function lain (pemanggilan berlapis), karena menunjukkan urutan pemanggilan sebelum exception terjadi.

```php
<?php
function hitungKebalikan($bilangan){
  if ($bilangan === 0){
    throw new Exception('Argument tidak bisa diisi angka 0');
  }
  else {
    return 1/$bilangan;
  }
}

function bar($pembagi){
  return hitungKebalikan($pembagi);
}

try {
  echo bar(0);
}
catch (Exception $e) {
  echo "Terjadi error di baris ke-".$e->getTrace()[0]["line"].
  " dengan keterangan <b>".$e->getMessage()."</b><br>";

  echo "<pre>";
  print_r( $e->getTrace() );
  echo "</pre>";
}
```

Array yang dihasilkan `getTrace()` bisa ditelusuri menggunakan `foreach` untuk menampilkan setiap tingkat pemanggilan (function, baris, dan argumen yang dikirim):

```php
<?php
function bar($pembagi){
  return hitungKebalikan($pembagi);
}

try {
  echo bar(-10);
}
catch (Exception $e) {
  echo "Error: <b>".$e->getMessage()."</b><br>";

  echo "<br>Trace error: <br>";

  foreach ($e->getTrace() as $nilai) {
    echo "Baris ke-".$nilai["line"];
    echo ", error di function ".$nilai["function"];
    echo ", dengan argument ".$nilai["args"][0]."<br>";
  }
}
```

Semakin dalam pemanggilan function, semakin banyak pula elemen trace yang tercatat:

```php
<?php
function bar($pembagi){
  return hitungKebalikan($pembagi);
}

function baz($pembagi){
  return bar($pembagi);
}

try {
  echo baz(-10);
}
catch (Exception $e) {
  echo "Error: <b>".$e->getMessage()."</b><br>";

  echo "<br>Trace error: <br>";

  foreach ($e->getTrace() as $nilai) {
    echo "Baris ke-".$nilai["line"];
    echo ", error di function ".$nilai["function"];
    echo ", dengan argument ".$nilai["args"][0]."<br>";
  }
}
```

Jika exception yang dilempar dari pemanggilan berlapis tidak ditangkap sama sekali (tidak ada `try-catch`), PHP akan menampilkan fatal error beserta stack trace bawaan, lalu menghentikan program:

```php
<?php
function bar($pembagi){
  return hitungKebalikan($pembagi);
}

function baz($pembagi){
  return bar($pembagi);
}

echo baz(-10); // Fatal error: Uncaught Exception
```

## 6.10 Blok `finally`

Blok `finally` berisi kode yang **selalu dijalankan**, baik exception terjadi maupun tidak, dan baik exception tersebut tertangkap maupun tidak. Blok ini cocok untuk kode "pembersihan" seperti menutup koneksi atau file.

```php
<?php
function hitungKebalikan($bilangan){
  if ($bilangan === 0){
    throw new Exception('Argument tidak bisa diisi angka 0');
  }
  else if ($bilangan < 0){
    throw new Exception("Argument \$bilangan tidak bisa diisi angka negatif");
  }
  else {
    return 1/$bilangan;
  }
}

echo "Sebelum try... <br>";

try {
  echo hitungKebalikan(-10)."<br>";
}
catch (Exception $e) {
  echo "Terjadi error di baris ke-".$e->getTrace()[0]["line"].
  " dengan keterangan <b>".$e->getMessage()."</b><br>";
}
finally {
  echo "Di dalam finally... <br>";
}

echo "Setelah try... <br>";
```

Urutan eksekusi pada contoh di atas: `try` dijalankan → exception ditangkap oleh `catch` → `finally` tetap dijalankan → baris kode setelah blok `try-catch-finally` dilanjutkan.

## 6.11 Pengantar Koneksi MySQLi Object

MySQLi Object adalah salah satu cara PHP terhubung ke database MySQL secara berorientasi object. Koneksi dibuat dengan membentuk object baru dari class `mysqli`.

```php
<?php
$databaseMysqli = new mysqli("localhost", "root", "root");

echo "<pre>";
print_r($databaseMysqli);
echo "</pre>";
```

Parameter yang dikirim ke constructor `mysqli` secara berurutan adalah **host**, **username**, dan **password**. Object `$databaseMysqli` yang terbentuk memiliki banyak property, di antaranya:

| Property          | Keterangan                                         |
| ----------------- | -------------------------------------------------- |
| `affected_rows` | Jumlah baris yang terpengaruh oleh query terakhir. |
| `client_info`   | Versi client MySQL yang digunakan.                 |
| `connect_errno` | Kode error koneksi (`0` apabila berhasil).       |
| `connect_error` | Pesan error koneksi.                               |
| `server_info`   | Versi server MySQL yang terhubung.                 |

```php
<?php
$databaseMysqli = new mysqli("localhost", "root", "root");

echo $databaseMysqli->affected_rows;  echo "<br>";
echo $databaseMysqli->client_info;    echo "<br>";
echo $databaseMysqli->connect_errno;  echo "<br>";
echo $databaseMysqli->server_info;    echo "<br>";
```

## 6.12 Menangani Kegagalan Koneksi

Koneksi database dapat gagal, misalnya karena password salah. Properti `connect_error` dan `connect_errno` bernilai kosong/`0` jika koneksi berhasil, dan berisi keterangan kesalahan jika koneksi gagal.

```php
<?php
$databaseMysqli = new mysqli("localhost", "root", "x");
echo $databaseMysqli->connect_errno," - ", $databaseMysqli->connect_error;
```

**Percobaan 1 — Menghentikan program dengan `die()`**

```php
<?php
$databaseMysqli = new mysqli("localhost", "root", "x");

if ($databaseMysqli->connect_error) {
  die('Koneksi bermasalah (' . $databaseMysqli->connect_errno . ') '
          . $databaseMysqli->connect_error);
}

echo "Jalankan query MySQL...";
```

Cara ini bekerja, tetapi sama seperti pembahasan pada bagian 6.1: program berhenti secara kasar dan sulit dipadukan dengan alur exception handling yang sudah dipelajari.

**Percobaan 2 — Melempar exception secara manual**

```php
<?php
try {
  $databaseMysqli = new mysqli("localhost", "root", "root");

  if ($databaseMysqli->connect_error) {
    throw new Exception('Koneksi bermasalah (' . $databaseMysqli->connect_errno . ') '
            . $databaseMysqli->connect_error);
  }
  echo "Jalankan query MySQL...";
}
catch (Exception $e) {
  echo $e->getMessage();
}
```

Dengan cara ini, kegagalan koneksi menjadi bagian dari alur `try-catch` yang konsisten dengan materi sebelumnya.

**Percobaan 3 — `mysqli_report()` dan `mysqli_sql_exception`**

MySQLi Object menyediakan mode pelaporan error bawaan yang otomatis melempar exception bertipe `mysqli_sql_exception` ketika terjadi kesalahan, tanpa perlu menulis `throw` secara manual. Mode ini diaktifkan dengan `mysqli_report()`.

```php
<?php
mysqli_report(MYSQLI_REPORT_STRICT);

try {
  $databaseMysqli = new mysqli("localhost", "root", "x");
  echo "Jalankan query MySQL...";
}
catch (mysqli_sql_exception $e) {
  echo "Koneksi bermasalah: ".$e->getMessage(). " (".$e->getCode().")";
}
```

Ketika koneksi berhasil, blok `try` berjalan seperti biasa tanpa exception:

```php
<?php
mysqli_report(MYSQLI_REPORT_STRICT);

try {
  $databaseMysqli = new mysqli("localhost", "root", "");
  echo "Jalankan query MySQL...";
}
catch (mysqli_sql_exception $e) {
  echo "Koneksi bermasalah: ".$e->getMessage(). " (".$e->getCode().")";
}
```

> Pesan pada `catch (Exception $e)` di atas sengaja ditampilkan sederhana untuk keperluan pembelajaran. Pada aplikasi produksi, pesan detail sebaiknya dicatat melalui `error_log()`, sedangkan pesan yang ditampilkan ke pengguna cukup bersifat umum (misalnya "Koneksi database gagal.") agar tidak membocorkan informasi sensitif seperti host atau username database.

## 6.13 Menutup Koneksi dengan `close()` dan `finally`

Setelah seluruh proses query selesai, koneksi database sebaiknya ditutup menggunakan method `close()`.

```php
<?php
$databaseMysqli = new mysqli("localhost", "root", "");

// Perintah query MySQL
// Perintah query MySQL
// Perintah query MySQL

$databaseMysqli->close();
```

Agar koneksi tetap ditutup meskipun terjadi exception di tengah proses, gunakan blok `finally`. Variabel koneksi diperiksa lebih dahulu dengan `isset()` karena jika koneksi gagal dibuat, variabel `$databaseMysqli` bisa jadi belum pernah terbentuk.

```php
<?php
mysqli_report(MYSQLI_REPORT_STRICT);

try {
  $databaseMysqli = new mysqli("localhost", "root", "");
}
catch (mysqli_sql_exception $e) {
  echo "Koneksi bermasalah: ".$e->getMessage(). " (".$e->getCode().")";
}
finally {
  if (isset($databaseMysqli)) {
    $databaseMysqli->close();
  }
}
```

Pola `try-catch-finally` inilah yang akan menjadi dasar penanganan koneksi dan query database pada Minggu 6 dan Minggu 7.

# 7. LATIHAN

1. Buat function `hitungKebalikan()` seperti pada bagian 6.1, lalu ubah menjadi versi yang melempar exception (bagian 6.2) dan tangkap dengan `try-catch`.
2. Tambahkan custom exception `NolException` dan `NegatifException` seperti pada bagian 6.7, lalu tangani keduanya dengan blok `catch` yang terpisah.
3. Buat function penarikan saldo (`tarikSaldo($saldo, $nominal)`) yang melempar exception jika nominal tidak positif atau melebihi saldo. Tangani setiap kegagalan dengan pesan yang sesuai, lalu tampilkan `getTrace()` dari exception yang terjadi.
4. Buat koneksi ke database menggunakan MySQLi Object dengan `mysqli_report(MYSQLI_REPORT_STRICT)`, lalu tangani kegagalan koneksi menggunakan `try-catch-finally` sehingga koneksi selalu ditutup dengan `close()` apa pun hasilnya.
