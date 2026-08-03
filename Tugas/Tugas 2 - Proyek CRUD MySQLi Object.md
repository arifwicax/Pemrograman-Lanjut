# TUGAS 2 — PROYEK CRUD MYSQLI OBJECT

## Identitas

| Komponen | Keterangan |
| --- | --- |
| Pelaksanaan | Individual, sebelum UTS |
| Cakupan | Modul Minggu 5–7 |
| Bentuk | Proyek PHP dan MySQL/MariaDB |
| Bobot | 5% nilai akhir |

## Tujuan

Mahasiswa mampu menerapkan exception handling, MySQLi Object, prepared statement, result set, dan CRUD dalam aplikasi kecil yang terstruktur.

## Studi Kasus

Buat aplikasi CRUD untuk satu topik yang dipilih sendiri, misalnya peminjaman alat, koleksi tanaman, jadwal ruang, data hewan, atau menu kantin. Topik dan kombinasi field tidak boleh sama persis dengan mahasiswa lain.

## Persyaratan Proyek

1. Memiliki sedikitnya satu tabel utama dengan minimal lima kolom selain primary key.
2. Menyediakan operasi daftar, tambah, detail, ubah, dan hapus.
3. Menggunakan API MySQLi Object, bukan API prosedural.
4. Semua input dinamis pada SQL menggunakan prepared statement dan binding parameter.
5. Akses database dipisahkan dari halaman tampilan melalui class repository/service.
6. Kegagalan koneksi dan query ditangani dengan exception tanpa menampilkan detail sensitif kepada pengguna.
7. Input diperiksa secara sederhana dan output HTML menggunakan `htmlspecialchars()`.
8. Terdapat minimal satu pencarian atau filter dengan prepared statement.
9. Antarmuka boleh sederhana; penilaian utama berada pada logika program.
10. Sertakan sedikitnya enam data uji buatan sendiri.

## Berkas yang Dikumpulkan

- Source code lengkap.
- Berkas `.sql` untuk membuat tabel dan data awal.
- `README.md` berisi cara instalasi, struktur folder, skema tabel, dan daftar fitur.
- PDF singkat maksimal tiga halaman berisi diagram class, tangkapan layar, serta penjelasan alur satu operasi CRUD.
- Nama arsip: `NIM_Nama_Tugas2.zip`.

Folder `vendor`, cache, dan kredensial pribadi tidak boleh disertakan.

## Interview dan Demo Individual

Durasi 8–10 menit menggunakan proyek yang dikumpulkan. Dosen dapat memilih kegiatan berikut secara acak:

1. Mendemonstrasikan satu operasi CRUD.
2. Menjelaskan alur data dari form sampai database.
3. Menunjukkan letak prepared statement dan alasan tipe binding yang digunakan.
4. Mengubah satu field, aturan, atau query sederhana secara langsung.
5. Menjelaskan apa yang terjadi ketika koneksi atau query gagal.
6. Menjawab satu kasus SQL injection atau output escaping.

Proyek harus dapat dijalankan saat interview. Gangguan teknis dapat diberi waktu perbaikan sesuai keputusan dosen, tetapi mahasiswa tetap harus mampu menjelaskan source code.

## Rubrik

| Aspek | Bobot |
| --- | ---: |
| Kelengkapan dan kebenaran CRUD | 20% |
| MySQLi Object dan prepared statement | 20% |
| Struktur class dan pemisahan tanggung jawab | 15% |
| Exception, validasi dasar, dan keamanan output | 10% |
| Dokumentasi dan data uji | 5% |
| Interview serta perubahan langsung | 30% |
| **Total** | **100%** |

## Ketentuan Keaslian

Template visual boleh menggunakan pustaka dengan atribusi, tetapi logika aplikasi harus dikerjakan sendiri. Source code yang tidak dapat dijelaskan atau dimodifikasi oleh mahasiswa akan diverifikasi lebih lanjut dan dinilai sesuai bukti penguasaan yang ditunjukkan.
