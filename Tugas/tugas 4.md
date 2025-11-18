## **Judul Tugas**

**Tugas: Membuat Aplikasi CRUD Sederhana Menggunakan PDO — Data Koleksi Tanaman Hias**

---

## **Deskripsi Tugas**

Mahasiswa diminta membuat **aplikasi CRUD (Create, Read, Update, Delete)** menggunakan **PHP dengan PDO (PHP Data Object)**.
Kasus yang digunakan adalah **pengelolaan data tanaman hias** yang dimiliki oleh sebuah toko atau kolektor tanaman.

Aplikasi ini bertujuan untuk melatih pemahaman mahasiswa terhadap:

* Penggunaan **PDO untuk koneksi database**
* Penggunaan **prepared statement (execute/bindValue/bindParam)**
* Implementasi operasi dasar: tambah, tampil, ubah, dan hapus data

---

## **Spesifikasi Database**

Buat database dengan nama:

```sql
CREATE DATABASE db_tanaman;
```

### Tabel: `tanaman`

```sql
CREATE TABLE tanaman (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_tanaman VARCHAR(100) NOT NULL,
    jenis VARCHAR(50) NOT NULL,
    harga DECIMAL(10,2) NOT NULL,
    stok INT NOT NULL
);
```

---

## **Struktur Folder Project**

```
crud_tanaman/
├── index.php
├── tambah.php
├── edit.php
├── hapus.php
└── config.php
```

---


## **Kriteria Penilaian**

| Aspek                                          | Bobot |
| ---------------------------------------------- | ----- |
| Koneksi database menggunakan PDO               | 25%   |
| Fitur CRUD berjalan sempurna                   | 40%   |
| Struktur file dan kerapian kode                | 20%   |
| Validasi sederhana & keamanan dasar (opsional) | 10%   |
| Desain tampilan (bonus)                        | 5%    |

---

## **Tugas Pengayaan (Opsional)**

1. Tambahkan kolom **tanggal ditambahkan** otomatis (`timestamp`).
2. Tambahkan fitur **pencarian tanaman berdasarkan nama atau jenis**.
3. Buat tampilan sederhana dengan CSS agar lebih menarik.

