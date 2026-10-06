# MODUL PERKULIAHAN

## Mata Kuliah: Pemrograman Lanjut
### Minggu Ke-6: MySQLi Object dan Prepared Statement

## 1. Identitas dan Sub-CPMK

| Komponen | Keterangan |
| --- | --- |
| Mata Kuliah | Pemrograman Lanjut |
| Minggu | 6 |
| Topik | MySQLi Object, result set, validasi input, prepared statement, dan transaksi |
| Dosen Pengampu | **Arif Wicaksono Septyanto, S.Kom., M.Kom.** |
| Durasi | 1 pertemuan (3 × 50 menit) |

Setelah mengikuti materi ini, mahasiswa mampu menjelaskan konsep koneksi database menggunakan MySQLi Object, memahami proses menjalankan query dan mengolah result set, menjelaskan fungsi validasi input dan prepared statement, serta memahami penanganan kesalahan dan transaksi database.

## 2. Prasyarat dan Cakupan Materi

Materi ini memerlukan pemahaman dasar PHP, class dan object, SQL dasar, serta struktur `try-catch-finally` yang telah dipelajari pada Minggu 5.

Database latihan yang digunakan dalam praktik adalah `kampus_lanjut` dengan tabel `inventaris`. Contoh implementasi untuk setiap konsep tersedia pada folder [Script/Week 06](../Script/Week%2006/), tetapi bagian teori ini berfokus pada pengertian dan prinsip kerja.

Urutan konsep yang dipelajari adalah:

**Koneksi → database dan tabel → query serta result set → validasi input → prepared statement → transaksi**

## 3. MySQLi Object

MySQLi adalah ekstensi PHP yang digunakan untuk berkomunikasi dengan database MySQL. MySQLi mendukung gaya prosedural dan object-oriented. Pada materi ini digunakan gaya object-oriented, sehingga koneksi, query, result set, dan statement direpresentasikan sebagai object serta diakses melalui property dan method.

Object koneksi menyimpan informasi tentang hubungan antara aplikasi PHP dan server MySQL. Informasi yang diperlukan untuk membuat koneksi biasanya terdiri atas host, username, password, dan nama database.

Exception MySQLi dapat diaktifkan agar kegagalan koneksi atau query dilaporkan sebagai exception. Dengan cara ini, kesalahan dapat ditangani menggunakan `try-catch`, sedangkan pembersihan resource dapat dilakukan pada `finally`.

Pengaturan charset koneksi penting agar data teks dapat dikirim dan diterima dengan benar. Setelah selesai digunakan, koneksi perlu ditutup untuk membebaskan resource. Detail kesalahan teknis sebaiknya dicatat pada log, bukan ditampilkan langsung kepada pengguna.

## 4. Database dan Tabel

Database merupakan kumpulan data yang dikelola secara terstruktur. Tabel menyimpan data dalam bentuk baris dan kolom. Setiap tabel biasanya memiliki primary key sebagai identitas unik setiap baris.

Pada tabel `inventaris`, kolom dapat menyimpan identitas inventaris, nama barang, jumlah, biaya, dan waktu pembaruan. Tipe data kolom harus dipilih sesuai karakteristik data, misalnya bilangan bulat untuk jumlah, desimal untuk biaya, dan tipe waktu untuk tanggal atau waktu.

Operasi pembuatan database dan tabel termasuk operasi definisi struktur data. `DROP TABLE` menghapus struktur sekaligus data, sedangkan `DELETE` menghapus baris data. Operasi tersebut harus dilakukan hati-hati dan tidak dijalankan pada database penting tanpa pemeriksaan.

## 5. Query dan Result Set

Query adalah perintah SQL yang dikirimkan aplikasi kepada database. Query dapat digunakan untuk membaca, menambahkan, mengubah, atau menghapus data.

Query `SELECT` menghasilkan result set, yaitu object yang berisi kumpulan baris dan informasi kolom dari hasil pembacaan database. Informasi penting pada result set meliputi jumlah baris dan jumlah kolom.

Baris result set dapat dibaca dengan beberapa bentuk:

| Method | Bentuk hasil |
| --- | --- |
| `fetch_row()` | Array dengan index numerik |
| `fetch_assoc()` | Array dengan nama kolom sebagai key |
| `fetch_array()` | Array numerik, associative, atau keduanya sesuai mode |
| `fetch_object()` | Object dengan property dari nama kolom |
| `fetch_all()` | Seluruh baris dalam bentuk array |

Method yang mengambil satu baris menggeser posisi pembacaan ke baris berikutnya. Ketika seluruh baris telah dibaca, tidak ada data lagi. Setelah result set tidak diperlukan, resource-nya sebaiknya dibebaskan. Untuk query yang mengubah data, jumlah baris yang terpengaruh dapat digunakan untuk mengetahui apakah perubahan terjadi.

## 6. Menampilkan Data dan Output Escaping

Data dari database yang ditampilkan ke halaman HTML harus diperlakukan sebagai data, bukan sebagai kode HTML. Karakter khusus perlu diubah menggunakan mekanisme escaping, misalnya `htmlspecialchars()`.

Output escaping mencegah data yang mengandung HTML atau JavaScript dijalankan oleh browser. Proses ini berbeda dari validasi input dan prepared statement: validasi memeriksa kelayakan data, prepared statement melindungi struktur query, sedangkan escaping melindungi konteks output HTML.

## 7. Validasi Input dan SQL Injection

Validasi input adalah proses memeriksa apakah data yang diterima aplikasi sesuai aturan, seperti tipe, format, panjang, nilai minimum, dan nilai maksimum. Validasi sebaiknya dilakukan sebelum data diproses atau dikirim ke database.

SQL injection adalah serangan ketika input pengguna memengaruhi struktur perintah SQL. Hal ini dapat terjadi jika input digabungkan langsung ke dalam string query. Validasi, casting, dan `real_escape_string()` dapat membantu pada kondisi tertentu, tetapi bukan pengganti prepared statement. Prepared statement merupakan pilihan utama ketika query menggunakan nilai dari pengguna.

## 8. Prepared Statement

Prepared statement memisahkan struktur SQL dari nilai data. Struktur query disiapkan menggunakan placeholder, biasanya tanda tanya. Nilai input kemudian dikirim sebagai parameter, bukan digabungkan ke dalam teks SQL.

Tahap prepared statement adalah:

1. **Prepare**, menyiapkan struktur SQL dan placeholder.
2. **Bind**, menghubungkan nilai PHP dengan placeholder serta menentukan tipe data.
3. **Execute**, menjalankan query dengan nilai parameter.
4. **Mengambil hasil**, membaca result set jika query menghasilkan data.

Kode tipe parameter terdiri atas `i` untuk integer, `d` untuk double atau desimal, `s` untuk string, dan `b` untuk data biner. Jumlah kode tipe harus sama dengan jumlah parameter yang diikat dan urutannya harus sesuai.

Prepared statement dapat digunakan untuk `SELECT`, `INSERT`, `UPDATE`, dan `DELETE`. Statement yang sama dapat digunakan kembali dengan nilai parameter berbeda.

## 9. Pengambilan Hasil Prepared Statement

Hasil query `SELECT` dari prepared statement dapat diambil menggunakan `get_result()` apabila dukungan driver tersedia. Hasil tersebut dapat dibaca dengan method seperti `fetch_assoc()` atau `fetch_object()`.

Alternatifnya adalah `bind_result()`. Dengan cara ini, kolom hasil dihubungkan ke variabel PHP dan nilainya diisi setiap kali statement melakukan proses fetch. Pendekatan ini berguna pada lingkungan yang tidak menyediakan `get_result()`.

Pada pencarian menggunakan `LIKE`, wildcard seperti persen merupakan bagian dari nilai parameter. Nilai pencarian perlu disiapkan sebagai parameter sebelum statement dijalankan, sehingga struktur query tetap terpisah dari kata kunci pengguna.

## 10. Transaksi dan Rollback

Transaksi adalah sekumpulan operasi database yang diperlakukan sebagai satu kesatuan. Tujuannya menjaga konsistensi data ketika beberapa operasi saling bergantung.

Alur transaksi meliputi memulai transaksi, menjalankan operasi, melakukan `commit` jika seluruh operasi berhasil, dan melakukan `rollback` jika terjadi kegagalan. `Commit` membuat perubahan permanen, sedangkan `rollback` membatalkan perubahan sejak transaksi dimulai. Transaksi hanya berlaku untuk operasi pada koneksi yang sama.

Operasi di dalam transaksi sebaiknya tetap menggunakan prepared statement apabila melibatkan input. Transaksi sesuai untuk proses yang tidak boleh meninggalkan database dalam keadaan setengah berubah.

## 11. Penanganan Resource dan Error

Program database perlu mengelola koneksi, statement, dan result set. Resource tersebut sebaiknya ditutup atau dibebaskan setelah selesai digunakan.

Struktur `try-catch-finally` memisahkan tanggung jawab: `try` menjalankan operasi, `catch` menangani exception, dan `finally` melakukan pembersihan resource. Pemeriksaan keberadaan object sebelum memanggil method penutup penting karena koneksi atau statement mungkin belum berhasil dibuat ketika error terjadi.

## 12. Pola Program yang Disarankan

Pola umum program database yang aman adalah:

**Aktifkan exception → buat koneksi dan atur charset → validasi input → siapkan statement → ikat parameter → jalankan query → ambil result set → escape output → bebaskan resource → tutup koneksi.**

Hal yang perlu diperiksa:

- Exception MySQLi telah diaktifkan.
- Charset koneksi telah diatur.
- Input telah divalidasi.
- Input tidak digabungkan langsung ke string SQL.
- Tipe dan jumlah parameter sesuai dengan query.
- Data HTML telah di-escape.
- Result set, statement, dan koneksi ditutup.
- Detail error teknis tidak ditampilkan kepada pengguna.
- Operasi yang saling bergantung dijalankan dalam transaksi.

## 13. Ringkasan

MySQLi Object menyediakan cara object-oriented untuk menghubungkan PHP dengan MySQL. Object koneksi digunakan untuk menjalankan query, sedangkan result set digunakan untuk membaca hasil `SELECT`.

Validasi input memastikan data sesuai aturan aplikasi. Prepared statement memisahkan struktur SQL dari nilai input sehingga membantu mencegah SQL injection. Output escaping melindungi halaman HTML dari data yang dianggap sebagai kode. Exception handling dan pengelolaan resource membuat program lebih terkontrol. Transaksi menggunakan `commit` dan `rollback` untuk menjaga konsistensi ketika beberapa operasi harus berhasil atau gagal sebagai satu kesatuan.

Implementasi setiap konsep dapat dibuat secara bertahap berdasarkan teori ini, mulai dari koneksi sederhana hingga prepared statement dan transaksi.
