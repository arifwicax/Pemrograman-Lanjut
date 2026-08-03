# TUGAS 3 — CATATAN TANGAN PDO

## Identitas

| Komponen | Keterangan |
| --- | --- |
| Pelaksanaan | Individual, sesudah UTS |
| Cakupan | Modul Minggu 9–10 |
| Bentuk | Ringkasan, tabel perbandingan, dan studi kasus tulisan tangan |
| Bobot | 5% nilai akhir |

## Tujuan

Mahasiswa mampu menjelaskan cara kerja PDO, memilih operasi yang tepat, serta menganalisis keamanan dan konsistensi transaksi database.

## Instruksi

Buat catatan dengan tulisan tangan tanpa batas minimum maupun maksimum halaman. Mahasiswa menentukan sendiri panjang dan kedalaman catatan berdasarkan pemahamannya terhadap materi. Inisiatif dinilai dari kelengkapan gagasan penting, kualitas analisis, hubungan antarkonsep, dan kegunaan catatan sebagai bahan belajar kembali—bukan dari jumlah halaman semata. Catatan wajib berisi:

1. Komponen DSN, proses koneksi, charset, dan konfigurasi error mode.
2. Tabel perbandingan `exec()`, `query()`, `prepare()`, `fetch()`, dan `fetchAll()`.
3. Perbedaan positional parameter dan named parameter disertai contoh sendiri.
4. Penjelasan `bindValue()`, `bindParam()`, serta kapan masing-masing digunakan.
5. Diagram alur transaksi: `beginTransaction()`, `commit()`, dan `rollBack()`.
6. Analisis satu skenario kegagalan transaksi yang memiliki sedikitnya dua operasi database.
7. Tiga contoh kode pendek buatan sendiri: koneksi, SELECT aman, dan transaksi.
8. Daftar lima kesalahan umum PDO beserta perbaikannya.
9. Refleksi 150–250 kata mengenai perbedaan MySQLi Object dan PDO.

## Pengumpulan

- Serahkan catatan fisik dan unggah hasil pindai sebagai satu PDF.
- Nama berkas: `NIM_Nama_Tugas3.pdf`.
- NIM dan paraf wajib terdapat pada setiap halaman.

## Interview Individual

Durasi 5–7 menit. Pertanyaan dipilih berdasarkan catatan mahasiswa dan dapat meliputi:

1. Menentukan apakah sebuah kasus lebih tepat memakai `exec()`, `query()`, atau `prepare()`.
2. Menjelaskan nilai yang dikembalikan oleh `fetch()` atau `fetchAll()`.
3. Menunjukkan bagian kode yang mencegah SQL injection.
4. Memprediksi hasil jika salah satu operasi transaksi gagal.
5. Memperbaiki potongan kode PDO yang memiliki satu kesalahan.

## Rubrik

| Aspek | Bobot |
| --- | ---: |
| Ketepatan konsep PDO | 25% |
| Perbandingan API dan pemilihan penggunaannya | 15% |
| Analisis prepared statement dan transaksi | 15% |
| Contoh kode dan analisis kesalahan | 10% |
| Kerapian dan penggunaan kalimat sendiri | 5% |
| Interview individual | 30% |
| **Total** | **100%** |

## Ketentuan Keaslian

Catatan harus menunjukkan proses berpikir mahasiswa, bukan hasil salin-tempel atau transkripsi keluaran AI. Referensi tambahan harus ditulis pada halaman terakhir dan mahasiswa harus mampu menjelaskan seluruh bagian yang dikumpulkan.
