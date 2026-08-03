# MODUL PERKULIAHAN

## Mata Kuliah: Pemrograman Lanjut

### Minggu Ke-11, 12, dan 13: Database Query Builder

# 1. SUB-CPMK

> **Mahasiswa mampu mengaplikasikan dan membuat query builder (C3, A4, P2).**

# 2. POLA PEMBELAJARAN

Query builder dikembangkan secara evolusioner seperti bahan acuan: mulai dari pembungkus PDO, dilanjutkan SELECT dengan method chaining, kemudian operasi perubahan data. Contoh memakai agenda kegiatan dan API baru, bukan class `DB` serta tabel barang dari acuan.

# 3. PEMBAGIAN MATERI

| Minggu | Fokus | Hasil praktik |
| ---: | --- | --- |
| 11 | Class koneksi dan method eksekusi parameter | `Database` yang dapat digunakan ulang |
| 12 | SELECT builder, `where()`, `orderBy()`, method chaining | Builder SELECT yang aman |
| 13 | INSERT, UPDATE, DELETE, reset state, dan pengujian | Query builder lengkap |

# 4. PRINSIP DESAIN

1. Koneksi PDO diterima melalui constructor (*dependency injection*).
2. Nilai selalu memakai prepared statement.
3. Identifier diperiksa melalui allowlist.
4. Method builder mengembalikan `self` untuk chaining.
5. State builder direset setelah query dijalankan.
6. Library melempar exception dan tidak menggunakan `die()`.

# 5. ALUR IMPLEMENTASI

```php
$kegiatan = $builder
    ->table('kegiatan')
    ->select(['kode', 'nama', 'tanggal'])
    ->where('status', '=', 'terjadwal')
    ->orderBy('tanggal', 'ASC')
    ->get();
```

Parameter `terjadwal` dikirim ke PDO. Tabel, kolom, operator, dan arah urut hanya diterima bila terdapat dalam allowlist.

# 6. INDIKATOR

Mahasiswa mampu merancang API builder, menerapkan method chaining, menghasilkan SQL dan parameter yang tepat, melakukan CRUD, menolak identifier tidak valid, serta membuktikan bahwa state tidak bocor ke query berikutnya.

# 7. LATIHAN

Tambahkan method `limit()` dan `first()` pada builder. Buat pengujian untuk limit valid, limit negatif, hasil ditemukan, dan hasil kosong.
