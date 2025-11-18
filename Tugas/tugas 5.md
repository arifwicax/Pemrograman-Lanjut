## **Tugas 5: Query Builder Sederhana dengan PHP OOP**

---

### 🧩 **Tujuan Pembelajaran**

Mahasiswa mampu:

1. Membuat **class database (DB)** sederhana dengan konsep **OOP (Object-Oriented Programming)**.
2. Mengimplementasikan operasi dasar **CRUD (Create, Read, Update, Delete)** dengan **Query Builder**.
3. Menguji semua fungsi CRUD menggunakan **file `index.php`**.
4. Memahami penerapan OOP dalam pembuatan library database.

---

## 📚 **Studi Kasus: Tabel `produk`**

Sebuah toko elektronik online ingin membuat sistem sederhana untuk mengelola **data produk**.
Tabel ini menyimpan informasi seperti nama produk, kategori, stok, dan harga.

---

### 📋 Struktur Tabel

```sql
CREATE DATABASE tokoelektronik;
USE tokoelektronik;

CREATE TABLE produk (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama_produk VARCHAR(100) NOT NULL,
    kategori VARCHAR(50),
    stok INT DEFAULT 0,
    harga DECIMAL(10,2)
);
```

---

### 📂 **Struktur Folder Proyek**

```
querybuilder_produk/
│
├── DB.php
└── index.php
```


### 💻 **2️⃣ File: index.php**

Gunakan file ini untuk menguji semua fungsi CRUD pada tabel `produk`.

```php
<?php
require 'DB.php';
$db = new DB();

// 1️⃣ Tambah Data Produk
$db->insert('produk', [
    'nama_produk' => 'Laptop ASUS Vivobook 14',
    'kategori' => 'Laptop',
    'stok' => 10,
    'harga' => 8500000
]);
$db->insert('produk', [
    'nama_produk' => 'Smartphone Samsung A55',
    'kategori' => 'Handphone',
    'stok' => 25,
    'harga' => 6500000
]);
$db->insert('produk', [
    'nama_produk' => 'Headphone Sony WH-CH520',
    'kategori' => 'Aksesoris',
    'stok' => 15,
    'harga' => 750000
]);
```
---

### 🧩 **Tugas Mahasiswa**

1. Buat database **tokoelektronik** dan tabel **produk** seperti struktur di atas.
2. Implementasikan class `DB` dan uji dengan `index.php`.
3. Lakukan operasi CRUD berikut:

   * Tambahkan **3 data produk baru**.
   * Tampilkan seluruh data produk.
   * Ubah salah satu data (misalnya stok dan harga).
   * Tampilkan satu produk berdasarkan `id`.
   * Hapus satu data produk.
4. Tambahkan komentar di setiap bagian kode penting untuk menjelaskan fungsinya.
5. Lampirkan **screenshot hasil output tiap tahap (Insert, Read, Update, Delete)**.

---

### 🧠 **Nilai Tambah (Bonus Challenge)**

* Tambahkan validasi agar **stok tidak bisa bernilai negatif**.
* Buat method baru `search($table, $keyword)` untuk mencari produk berdasarkan nama.
* Buat tampilan HTML sederhana yang menampilkan daftar produk dalam bentuk tabel.