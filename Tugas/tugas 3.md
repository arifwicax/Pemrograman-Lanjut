## **Judul Tugas**

**Tugas: Membuat Aplikasi CRUD Sederhana Menggunakan MySQL Object (OOP PHP) — Data Buku Perpustakaan**

---

## **Deskripsi Tugas**

Mahasiswa diminta membuat **aplikasi CRUD (Create, Read, Update, Delete)** sederhana untuk mengelola **data buku** di perpustakaan menggunakan **PHP berbasis OOP** dengan **MySQLi Object-Oriented**.

Aplikasi ini bertujuan untuk memahami cara melakukan operasi dasar database tanpa framework atau konsep MVC.

Aplikasi harus bisa:

* Menampilkan daftar buku
* Menambah data buku baru
* Mengubah data buku
* Menghapus data buku

---

## 🗃️ **Spesifikasi Database**

Buat database dengan nama:

```sql
CREATE DATABASE db_perpustakaan;
```

### Tabel: `buku`

```sql
CREATE TABLE buku (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(100) NOT NULL,
    penulis VARCHAR(100) NOT NULL,
    penerbit VARCHAR(100) NOT NULL,
    tahun_terbit YEAR NOT NULL
);
```

---

## ⚙️ **Struktur Folder Project**

```
crud_buku/
├── index.php
├── tambah.php
├── edit.php
├── hapus.php
└── config.php
```

## 📋 **Kriteria Penilaian**

| Aspek                                | Bobot |
| ------------------------------------ | ----- |
| Koneksi database dengan MySQL Object | 25%   |
| Fungsi CRUD berjalan dengan baik     | 40%   |
| Struktur file dan kerapian kode      | 20%   |
| Validasi form sederhana (opsional)   | 10%   |
| Desain tampilan (opsional)           | 5%    |

---
