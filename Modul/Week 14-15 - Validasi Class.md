# MODUL PERKULIAHAN

## Mata Kuliah: Pemrograman Lanjut

### Minggu Ke-14 dan 15: Validasi Class

# 1. SUB-CPMK

> **Mahasiswa mampu menerapkan validasi class (C3, A4).**

# 2. POLA PEMBELAJARAN

Materi mengikuti progres bahan acuan: membaca input, mendefinisikan aturan, mengumpulkan pesan kesalahan, menampilkan kembali nilai, lalu mengintegrasikan data yang valid. Contoh menggunakan pendaftaran lokakarya, bukan registrasi pengguna pada acuan.

# 3. PEMBAGIAN MATERI

| Minggu | Fokus | Hasil praktik |
| ---: | --- | --- |
| 14 | Class `Input`, aturan `required`, `min`, `email`, dan pengumpulan error | Validator yang dapat digunakan ulang |
| 15 | Validasi lintas-field, repopulasi form, object peserta, dan integrasi repository | Alur input tervalidasi |

# 4. PEMISAHAN TANGGUNG JAWAB

- `Input` membaca nilai dan menormalkan teks.
- `Validator` memeriksa aturan tanpa menulis ke database.
- Object domain hanya dibuat setelah data valid.
- Repository hanya menerima object yang valid.

Sanitasi output dengan `htmlspecialchars()` berbeda dari validasi input. Prepared statement tetap diperlukan walaupun data telah divalidasi.

# 5. CONTOH ATURAN

```php
$validator->validate($input, [
    'nama' => ['required', 'min:3'],
    'email' => ['required', 'email'],
    'jumlah_kursi' => ['required', 'integer', 'between:1,4'],
]);
```

# 6. INDIKATOR

Mahasiswa mampu merancang class input dan validator, menerapkan beberapa aturan, mengakses error per field, mempertahankan input sebelumnya secara aman, serta mencegah data tidak valid mencapai lapisan database.

# 7. LATIHAN

Tambahkan aturan `same:konfirmasi_email` dan `in:dasar,menengah,lanjut`. Uji data valid, field kosong, format email salah, nilai batas, dan nilai di luar pilihan.
