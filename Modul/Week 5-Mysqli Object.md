
# 📌 Penjelasan Script PHP dengan Komentar Detail

```php
<?php
// Mengatur agar MySQLi melaporkan error sebagai Exception
// Jadi kalau ada error SQL atau koneksi, akan dilempar ke blok try-catch
mysqli_report(MYSQLI_REPORT_STRICT);

try {
  // Membuat koneksi ke MySQL
  // Format: new mysqli(host, username, password, database?)
  $mysqli = new mysqli("localhost", "root", "root");
```

---

```php
  // Buat database "ilkoom" jika belum ada
  $query = "CREATE DATABASE IF NOT EXISTS ilkoom";
  $mysqli->query($query);

  // Jika ada error saat query → lempar Exception
  if ($mysqli->error){
    throw new Exception($mysqli->error, $mysqli->errno);
  }
  else {
    echo "Database 'ilkoom' berhasil di buat / sudah tersedia <br>";
  };
```

👉 Bagian ini membuat database `ilkoom` bila belum ada. Kalau sudah ada, tidak error karena pakai `IF NOT EXISTS`.

---

```php
  // Pilih database "ilkoom" untuk digunakan
  $mysqli->select_db("ilkoom");

  if ($mysqli->error){
    throw new Exception($mysqli->error, $mysqli->errno);
  }
  else {
    echo "Database 'ilkoom' berhasil di pilih <br>";
  };
```

👉 Setelah database dibuat/ada, baris ini memastikan PHP menggunakan database `ilkoom`.

---

```php
  // Hapus tabel "barang" jika sudah ada sebelumnya
  $query = "DROP TABLE IF EXISTS barang";
  $mysqli->query($query);

  if ($mysqli->error){
    throw new Exception($mysqli->error, $mysqli->errno);
  }
```

👉 Berguna agar tabel lama dibuang, supaya bisa dibuat ulang dari awal (menghindari error `table already exists`).

---

```php
  // Buat tabel baru bernama "barang"
  $query = "CREATE TABLE barang (
           id_barang INT PRIMARY KEY AUTO_INCREMENT,   -- ID unik untuk setiap barang
           nama_barang VARCHAR(50),                    -- Nama barang (string max 50 karakter)
           jumlah_barang INT,                          -- Jumlah stok barang
           harga_barang DEC,                           -- Harga barang (decimal)
           tanggal_update TIMESTAMP                    -- Waktu terakhir data diupdate
           )";
  $mysqli->query($query);

  if ($mysqli->error){
    throw new Exception($mysqli->error, $mysqli->errno);
  }
  else {
    echo "Tabel 'barang' berhasil di buat <br>";
  };
```

👉 Membuat tabel `barang` dengan struktur kolom sederhana untuk inventaris.

---

```php
  // Membuat timestamp sekarang dengan zona waktu Asia/Jakarta
  $sekarang = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
  $timestamp = $sekarang->format("Y-m-d H:i:s");
```

👉 Mengambil waktu saat ini sesuai timezone Indonesia (Jakarta), lalu diformat untuk disimpan di database.

---

```php
  // Isi tabel "barang" dengan beberapa data contoh (insert multi-row)
  $query = "INSERT INTO barang
    (nama_barang, jumlah_barang, harga_barang, tanggal_update) VALUES
      ('TV Samsung 43NU7090 4K',5,5399000,'$timestamp'),
      ('Kulkas LG GC-A432HLHU',10,7600000,'$timestamp'),
      ('Laptop ASUS ROG GL503GE',7,16200000,'$timestamp'),
      ('Printer Epson L220',14,2099000,'$timestamp'),
      ('Smartphone Xiaomi Pocophone F1',25,4750000,'$timestamp')
    ;";
  $mysqli->query($query);

  if ($mysqli->error){
    throw new Exception($mysqli->error, $mysqli->errno);
  }
  else {
    echo "Tabel 'barang' berhasil di isi ".$mysqli->affected_rows."
         baris data <br>";
  };
```

👉 Mengisi tabel `barang` dengan 5 data contoh.
`$mysqli->affected_rows` menunjukkan berapa baris data berhasil masuk.

---

```php
}
// Jika ada error koneksi atau query di dalam try {}
catch (Exception $e) {
  echo "Koneksi / Query bermasalah: ".$e->getMessage(). " (".$e->getCode().")";
}

// Bagian ini dijalankan apapun hasilnya (sukses atau gagal)
finally {
  if (isset($mysqli)) {
    $mysqli->close(); // Tutup koneksi ke database
  }
}
```

👉 `catch` menangani error, `finally` menutup koneksi agar tidak menggantung.

---

# ✨ Ringkasan Fungsi Script

1. **Koneksi ke MySQL** dengan user `root`.
2. **Membuat database** `ilkoom` (jika belum ada).
3. **Memilih database** `ilkoom`.
4. **Menghapus tabel `barang`** jika sudah ada.
5. **Membuat tabel `barang`** dengan struktur kolom sederhana.
6. **Mengisi tabel `barang`** dengan beberapa data contoh.
7. **Menangani error dengan Exception**, agar lebih rapi.
8. **Menutup koneksi** setelah selesai.

