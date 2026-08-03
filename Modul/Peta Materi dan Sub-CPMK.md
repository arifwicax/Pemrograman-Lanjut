# PETA MATERI DAN SUB-CPMK

## Mata Kuliah: Pemrograman Lanjut

Dokumen ini menjadi acuan pembagian materi agar setiap pertemuan mendukung Sub-CPMK dan tidak mengulang pembahasan utama pada minggu lain.

| Minggu | Sub-CPMK/Kegiatan | Fokus materi | Luaran pembelajaran |
| ---: | --- | --- | --- |
| 1 | Menjelaskan konsep dasar PBO seperti objek, kelas, atribut, dan metode (C2) | Paradigma PBO; class; object; property/atribut; method | Penjelasan dan identifikasi unsur PBO |
| 2 | Mengaplikasikan konsep class, constructor, dan method (C3, A1) | Constructor; parameter; return value; static member; class constant | Class yang dapat diinstansiasi dan digunakan |
| 3 | Mengaplikasikan encapsulation dan access modifier (C3, A4, P2) | `public`, `protected`, `private`; getter/setter; validasi state | Class yang menjaga integritas data |
| 4 | Mengaplikasikan inheritance, polymorphism, abstraksi, dan interface (C3, A4, P2) | `extends`; overriding; abstract class; interface; polymorphism | Hierarki class dan pemanggilan polymorphic |
| 5 | Mengaplikasikan exception handling dan MySQLi Object (C3, A4, P2) | Exception, custom exception, dan pengantar koneksi MySQLi Object | Penanganan kegagalan yang terkontrol |
| 6 | Sub-CPMK Minggu 5–7 (tahap 2) | Koneksi MySQLi Object; prepared statement; result set; transaksi/error | Akses database berorientasi objek yang aman |
| 7 | Sub-CPMK Minggu 5–7 (tahap 3) | Integrasi CRUD berbasis class dengan MySQLi Object | Aplikasi CRUD sederhana |
| 8 | UTS | Evaluasi materi Minggu 1–7 | Hasil UTS |
| 9 | Mengaplikasikan PDO (C3, A4, P2) | DSN; koneksi; konfigurasi error; `exec()` dan `query()` | Koneksi dan query PDO |
| 10 | Sub-CPMK Minggu 9–10 (tahap 2) | Prepared statement; binding; `fetch()`/`fetchAll()`; transaksi; CRUD | CRUD PDO yang aman |
| 11 | Mengaplikasikan dan membuat query builder (C3, A4, P2) | Analisis kebutuhan dan rancangan API query builder | Rancangan class dan API |
| 12 | Sub-CPMK Minggu 11–13 (tahap 2) | Implementasi SELECT/INSERT dan method chaining | Query builder tahap awal |
| 13 | Sub-CPMK Minggu 11–13 (tahap 3) | UPDATE/DELETE, parameter binding, exception, pengujian | Query builder lengkap |
| 14 | Menerapkan validasi class (C3, A4) | Invariant, validasi constructor dan setter, exception validasi | Class domain yang valid |
| 15 | Sub-CPMK Minggu 14–15 (tahap 2) | Integrasi validasi class dengan PDO/query builder dan pengujian | Aplikasi tervalidasi |
| 16 | UAS | Evaluasi/proyek akhir | Hasil UAS |

## Aturan Antiduplikasi

1. Materi utama dijelaskan pada minggu pertama kali muncul dalam tabel.
2. Konsep yang dipakai kembali cukup dirujuk sebagai prasyarat dan diterapkan pada studi kasus baru.
3. Minggu gabungan memiliki satu Sub-CPMK, tetapi indikator dan luaran dibedakan per tahap.
4. CRUD pada Minggu 7 menggunakan pengetahuan query Minggu 6; teori operasi query tidak dijelaskan ulang.
5. Method chaining pada query builder merupakan penerapan konsep method, bukan pengulangan teori dasar method.
