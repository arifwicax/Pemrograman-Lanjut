# Pemrograman Lanjut

Repositori materi dan praktikum mata kuliah **Pemrograman Lanjut**. Materi berfokus pada Pemrograman Berorientasi Objek (PBO) menggunakan PHP, akses database dengan MySQLi dan PDO, query builder, serta validasi class.

## Cakupan pembelajaran

| Minggu | Topik |
| ---: | --- |
| 1–4 | Konsep dasar PBO, class, constructor, encapsulation, inheritance, polymorphism, abstraksi, dan interface |
| 5–7 | Exception handling, MySQLi Object, prepared statement, transaksi, dan CRUD |
| 8 | Ujian Tengah Semester (UTS) |
| 9–10 | PDO, query, fetch, prepared statement, binding, transaksi, dan CRUD |
| 11–13 | Perancangan dan implementasi query builder |
| 14–15 | Form, sanitasi input, validasi class, integrasi database, dan pengujian |
| 16 | Ujian Akhir Semester (UAS) |

Pemetaan lengkap materi dan Sub-CPMK tersedia di [Modul/Peta Materi dan Sub-CPMK.md](Modul/Peta%20Materi%20dan%20Sub-CPMK.md).

## Struktur repositori

```text
.
├── Kuis/       # Kuis perkuliahan
├── Modul/      # Kontrak, peta materi, dan modul Minggu 1–16
├── Script/     # Contoh program dan script praktikum per minggu
├── Tugas/      # Deskripsi tugas perkuliahan
└── UTS/        # Materi atau instruksi UTS
```

Dokumentasi tambahan untuk script praktikum tersedia di [Script/README.md](Script/README.md), sedangkan daftar tugas tersedia di [Tugas/README.md](Tugas/README.md).

## Prasyarat

- PHP 8.x atau versi yang kompatibel dengan contoh program.
- MySQL atau MariaDB untuk materi database.
- Web server lokal, misalnya Apache, Nginx, XAMPP, Laragon, atau PHP built-in server.
- Editor kode yang mendukung PHP dan Markdown.

Pastikan ekstensi PHP `mysqli` dan `pdo_mysql` aktif sebelum menjalankan contoh database.

## Cara menggunakan

1. Baca materi pada folder `Modul/` sesuai minggu perkuliahan.
2. Buka folder yang sama di `Script/` untuk melihat contoh program.
3. Jalankan file PHP melalui terminal atau web server lokal.
4. Untuk contoh yang menggunakan database, buat database sesuai instruksi pada script dan sesuaikan konfigurasi koneksinya.

Contoh menjalankan file PHP dari terminal:

```bash
php "Script/Week 01/01-class-dan-object/01.class.php"
```

Nama file dapat berbeda pada setiap topik; gunakan file yang tersedia di folder minggu terkait.

## Rangkaian materi praktikum

- `Script/Week 01`–`Script/Week 04`: dasar-dasar PBO.
- `Script/Week 05`–`Script/Week 07`: exception handling dan CRUD MySQLi Object.
- `Script/Week 09`–`Script/Week 10`: PDO dan operasi database yang aman.
- `Script/Week 11`–`Script/Week 13`: query builder.
- `Script/Week 14`–`Script/Week 15`: validasi class dan integrasi database.

Folder Minggu 8 dan 16 digunakan untuk evaluasi sehingga tidak berisi rangkaian script praktikum baru.

## Penilaian

Komponen penilaian mengikuti [Kontrak Kuliah](Modul/Kontrak%20Kuliah.md):

| Komponen | Bobot |
| --- | ---: |
| Tugas | 20% |
| Review | 10% |
| UTS | 20% |
| UAS – Proyek Case Method | 20% |
| Praktikum | 20% |
| Kuis | 10% |

## Catatan akademik

Tugas harus dikerjakan secara mandiri dan mencantumkan referensi yang digunakan. Penggunaan alat bantu, termasuk AI generatif, mengikuti ketentuan pada [Tugas/README.md](Tugas/README.md) dan arahan dosen.

## Pengampu

**Arif Wicaksono Septyanto, S.Kom., M.Kom.**

