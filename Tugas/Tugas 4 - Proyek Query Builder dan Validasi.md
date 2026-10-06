# TUGAS 4 — PROYEK QUERY BUILDER DAN VALIDASI CLASS

## Identitas

| Komponen | Keterangan |
| --- | --- |
| Pelaksanaan | Individual, sesudah UTS |
| Cakupan | Modul Minggu 11–15 |
| Bentuk | Library mini dan aplikasi integrasi |
| Bobot | 5% nilai akhir |

## Tujuan

Mahasiswa mampu merancang query builder berbasis PDO, membuat class validasi yang dapat digunakan ulang, dan mengintegrasikan keduanya dalam aplikasi yang menjaga keamanan serta konsistensi data.

## Studi Kasus

Pilih satu domain berbeda dari Tugas 2, misalnya pendaftaran kegiatan, reservasi fasilitas, pencatatan servis, katalog karya, atau pengajuan surat. Setiap mahasiswa menentukan sendiri nama tabel, field, dan aturan bisnis.

## Bagian A — Query Builder

Query builder wajib:

1. Menerima object PDO melalui constructor.
2. Menyediakan `table()`, `select()`, `where()`, `orderBy()`, `limit()`, `get()`, dan `first()`.
3. Menyediakan operasi `insert()`, `update()`, dan `delete()`.
4. Menggunakan prepared statement untuk seluruh nilai dinamis.
5. Memeriksa tabel, kolom, operator, dan arah pengurutan melalui allowlist.
6. Mendukung method chaining.
7. Mereset state setelah query dijalankan.
8. Melempar exception dan tidak menghentikan program dengan `die()`.

## Bagian B — Validasi Class

Validator wajib:

1. Memisahkan pembacaan input dari pemeriksaan aturan.
2. Mendukung minimal aturan `required`, `min`, `max`, `integer`, `email`, `between`, `same`, dan `in`.
3. Menyimpan pesan kesalahan per field.
4. Mempertahankan input sebelumnya secara aman saat validasi gagal.
5. Membuat object domain hanya setelah seluruh data valid.
6. Mengirim hanya object yang valid ke repository.

## Bagian C — Integrasi dan Pengujian

1. Buat satu form tambah dan satu form ubah yang menggunakan validator.
2. Simpan dan baca data melalui query builder buatan sendiri.
3. Gunakan `htmlspecialchars()` saat menampilkan data.
4. Buat minimal delapan pengujian yang mencakup data valid, field kosong, nilai batas, email salah, identifier ditolak, state reset, hasil kosong, dan transaksi/query gagal.
5. Jangan menggunakan query builder atau validator dari framework/library eksternal.

## Berkas yang Dikumpulkan

- Source code lengkap dan file SQL.
- `README.md` berisi instalasi, rancangan API, aturan validasi, serta cara menjalankan pengujian.
- Diagram class dan diagram alur validasi hingga penyimpanan.
- Laporan hasil delapan pengujian dalam PDF maksimal lima halaman.
- Nama arsip: `NIM_Nama_Tugas4.zip`.

## Interview dan Demo Individual

Durasi 10–12 menit. Dosen memilih beberapa kegiatan secara acak:

1. Menelusuri SQL dan parameter yang dihasilkan oleh satu method chain.
2. Menjelaskan cara allowlist mencegah identifier berbahaya.
3. Membuktikan state builder sudah direset.
4. Menambahkan satu aturan validasi atau operator secara langsung.
5. Menjelaskan pemisahan tanggung jawab `Input`, validator, object domain, repository, dan query builder.
6. Menjalankan satu pengujian normal dan satu pengujian gagal.
7. Menjelaskan keputusan desain yang dibuat sendiri.

Jika mahasiswa tidak mampu menunjukkan hubungan antara source code dan hasil aplikasi, nilai komponen interview diberikan berdasarkan penguasaan yang benar-benar dapat dibuktikan.

## Rubrik

| Aspek | Bobot |
| --- | ---: |
| Kelengkapan dan keamanan query builder | 20% |
| Kelengkapan serta ketepatan validator | 15% |
| Integrasi, pemisahan tanggung jawab, dan object domain | 15% |
| Pengujian dan penanganan kegagalan | 10% |
| Dokumentasi dan diagram | 10% |
| Interview, demo, dan perubahan langsung | 30% |
| **Total** | **100%** |

## Ketentuan Keaslian

Mahasiswa boleh membaca dokumentasi resmi dan materi kuliah dengan mencantumkan sumber. Penggunaan AI untuk menghasilkan keseluruhan desain atau source code siap kumpul tidak diperbolehkan. Riwayat pengerjaan dapat diminta, dan seluruh bagian proyek harus dapat dijelaskan serta dimodifikasi saat interview.
