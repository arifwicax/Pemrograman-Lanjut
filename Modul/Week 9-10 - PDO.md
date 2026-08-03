# MODUL PERKULIAHAN

## Mata Kuliah: Pemrograman Lanjut

### Minggu Ke-9 dan 10: PDO

# 1. SUB-CPMK

> **Mahasiswa mampu mengaplikasikan PDO (C3, A4, P2).**

# 2. POLA PEMBELAJARAN

Materi mengikuti pola bertahap: mengamati masalah, mencoba fitur dasar, memperbaiki keamanan, lalu mengintegrasikan operasi. Contoh menggunakan sistem perpustakaan, berbeda dari contoh barang pada bahan acuan.

# 3. PEMBAGIAN MATERI

| Minggu | Fokus | Hasil praktik |
| ---: | --- | --- |
| 9 | Driver, DSN, koneksi, error mode, `exec()`, `query()`, `fetch()` dan `fetchAll()` | Mahasiswa mampu membuat koneksi dan membaca data |
| 10 | Prepared statement, positional/named parameter, CRUD, binding, dan transaksi | Mahasiswa mampu melakukan CRUD PDO secara aman |

# 4. INDIKATOR

Mahasiswa mampu membuat DSN, menangani `PDOException`, membedakan `exec()` dan `query()`, membaca hasil sebagai array asosiatif, menggunakan prepared statement, dan menerapkan transaksi.

# 5. MATERI INTI

## 5.1. Koneksi dan Konfigurasi

```php
$pdo = new PDO(
    'mysql:host=127.0.0.1;dbname=pemrograman_lanjut;charset=utf8mb4',
    'root',
    '',
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ],
);
```

DSN menentukan driver, host, database, dan charset. Detail exception dicatat pada log; pengguna menerima pesan umum.

## 5.2. `exec()`, `query()`, dan Fetch

- `exec()` digunakan untuk perintah yang tidak menghasilkan result set dan mengembalikan jumlah baris terdampak.
- `query()` cocok untuk SQL tetap tanpa input pengguna.
- `fetch()` mengambil satu baris; `fetchAll()` mengambil seluruh baris.

## 5.3. Prepared Statement

```php
$statement = $pdo->prepare(
    'SELECT kode, judul FROM koleksi_buku WHERE judul LIKE :kata'
);
$statement->execute(['kata' => '%algoritma%']);
$buku = $statement->fetchAll();
```

Nilai dinamis harus dikirim sebagai parameter. Nama tabel dan kolom tidak boleh berasal langsung dari input pengguna.

## 5.4. Transaksi

Gunakan `beginTransaction()`, `commit()`, dan `rollBack()` untuk beberapa perubahan yang harus berhasil atau gagal sebagai satu kesatuan.

# 6. URUTAN PRAKTIKUM

Jalankan script `01`–`05` pada Minggu 9 dan `06`–`09` pada Minggu 10. Script `00.setup_database.php` hanya untuk menyiapkan ulang database latihan.

# 7. LATIHAN

Buat proses peminjaman buku yang mengurangi stok dan mencatat transaksi peminjaman dalam satu transaksi PDO. Lakukan rollback jika stok tidak tersedia.
