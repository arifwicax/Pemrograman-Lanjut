### 🧩 **Database Query Builder**

1. **OOP butuh perencanaan**

   * Tujuannya agar kode bisa dikembangkan (scalable) dan mudah dikelola.
   * Tanpa perencanaan, menambah fitur bisa membuat seluruh kode harus diubah.

2. **Contoh kasus**

   * Aplikasi Sistem Informasi Sekolah awalnya untuk SD, SMP, SMA.
   * Saat ingin menambah PAUD, akan mudah jika sistem sudah dirancang modular sejak awal.

3. **Tiga prinsip utama OOP**

   * **Inheritance**: pewarisan sifat dari kelas induk.
   * **Polymorphism**: satu fungsi dapat digunakan dalam berbagai bentuk.
   * **Encapsulation**: memisahkan kode menjadi modul-modul mandiri.

4. **Manfaat encapsulation**

   * Kode dibagi menjadi modul (misalnya: database, form, tampilan).
   * Modul dapat digunakan ulang di aplikasi lain.
   * Contoh: modul validasi form yang bisa dipakai di banyak halaman.

5. **Library, plugin, dan add-on**

   * Merupakan kumpulan kode tambahan (modul siap pakai).
   * Membuat library sendiri butuh waktu, tapi hasilnya fleksibel dan bisa dikembangkan.

6. **Dua pilihan dalam pengembangan**

   * Membuat library sendiri.
   * Menggunakan library yang sudah ada (banyak tersedia gratis di PHP).

7. **Library berbasis OOP**

   * Karena OOP memisahkan kode, sebagian besar library dibuat dengan konsep objek.

8. **Framework = kumpulan library siap pakai**

   * Contoh: CodeIgniter, laravel, simpony
   * Mempermudah pekerjaan, misalnya cukup 1 baris untuk query database:

     ```php
     $query = $this->db->get('barang');
     ```

9. **Tujuan bab ini**

   * Tidak hanya memakai library yang sudah jadi.
   * Tapi **belajar membuat library sendiri** sebagai latihan penerapan konsep OOP.

---

## 🧩 **11.1. MySQL Query Builder (Versi Sederhana dengan Contoh Baru)**

### 📘 **Inti Konsep**

* **Query Builder** adalah cara membuat **library PHP** agar kita bisa mengakses database **tanpa menulis query SQL secara manual**.
* Framework seperti **Laravel** dan **CodeIgniter** sudah punya fitur ini.
* Tujuannya: agar kode jadi **lebih rapi, mudah dibaca, dan aman** dari kesalahan query.

---

### ⚙️ **Cara Kerjanya**

1. Buat file `DB.php` yang berisi class `DB` untuk menangani semua query database.
2. Panggil class tersebut dengan `DB::getInstance()` agar langsung terhubung ke database.
3. Gunakan method seperti `get()`, `insert()`, `update()`, dan `delete()` untuk melakukan operasi data.

---

### 💡 **Contoh Implementasi**

#### **1️⃣ Menampilkan Data dari Tabel `pelanggan`**

```php
require 'DB.php';
$DB = DB::getInstance();
$dataPelanggan = $DB->get('pelanggan');
```

➡️ Method `get('pelanggan')` otomatis membentuk query:

```sql
SELECT * FROM pelanggan;
```

📦 Hasilnya: `$dataPelanggan` berisi seluruh isi tabel `pelanggan` dalam bentuk array.

---

#### **2️⃣ Menambahkan Data ke Tabel `pelanggan`**

```php
$DB->insert('pelanggan', [
  'nama_pelanggan' => 'Rina Wahyuni',
  'email' => 'rina@example.com',
  'kota' => 'Balikpapan'
]);
```

➡️ Kode di atas akan dikonversi otomatis menjadi query:

```sql
INSERT INTO pelanggan (nama_pelanggan, email, kota)
VALUES ('Rina Wahyuni', 'rina@example.com', 'Balikpapan');
```

---

#### **3️⃣ Mengubah Data**

```php
$DB->update('pelanggan', 
  ['kota' => 'Samarinda'], 
  ['id_pelanggan', '=', 3]
);
```

➡️ Otomatis diubah menjadi:

```sql
UPDATE pelanggan SET kota = 'Samarinda' WHERE id_pelanggan = 3;
```

---

#### **4️⃣ Menghapus Data**

```php
$DB->delete('pelanggan', ['id_pelanggan', '=', 2]);
```

➡️ Dikonversi menjadi:

```sql
DELETE FROM pelanggan WHERE id_pelanggan = 2;
```

---

### 🔍 **Keuntungan Menggunakan Query Builder**

* ✨ **Kode singkat & bersih** — tidak perlu menulis SQL manual.
* 🧱 **Lebih mudah dipelihara** — struktur program lebih rapi.
* 🔒 **Lebih aman** — karena memakai *prepared statement* (menghindari SQL Injection).
* 🔁 **Bisa digunakan ulang** — class `DB` bisa dipakai di berbagai proyek.

---

### 💡 **Poin-Poin Utama: Pembuatan Class DB (Database Connection Library)**

1. **Tujuan Class DB**

   * Untuk mengelola koneksi database secara terstruktur menggunakan OOP (Object-Oriented Programming).
   * Disimpan dalam file `DB.php`, dan diakses melalui `index.php`.

2. **Struktur Awal File**

   * File `DB.php` berisi class kosong.
   * File `index.php` meng-*import* `DB.php`, membuat objek `DB`, dan menampilkan hasil dengan `var_dump()`.

   **Contoh singkat:**

   ```php
   // DB.php
   <?php
   class DB {}
   ```

   ```php
   // index.php
   <?php
   require 'DB.php';
   $db = new DB();
   var_dump($db);
   ```

---

3. **Property Private**

   * Informasi koneksi disimpan sebagai **property private** agar tidak bisa diakses dari luar class.
   * Contohnya: `_host`, `_dbname`, `_username`, `_password`, `_pdo`.

   **Contoh:**

   ```php
   private $_host = 'localhost';
   private $_dbname = 'tokoonline';
   private $_username = 'root';
   private $_password = '';
   private $_pdo;
   ```

---

4. **Constructor (`__construct`)**

   * Dipakai untuk **membuka koneksi database otomatis saat objek dibuat**.
   * Menggunakan `try...catch` untuk menangkap error koneksi.
   * Menyimpan objek PDO ke dalam property `$_pdo`.

   **Contoh:**

   ```php
   public function __construct() {
       try {
           $this->_pdo = new PDO(
               "mysql:host={$this->_host};dbname={$this->_dbname}",
               $this->_username,
               $this->_password
           );
           $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       } catch (PDOException $e) {
           die("Gagal koneksi: " . $e->getMessage());
       }
   }
   ```

---

5. **Uji Coba Koneksi**

   * Buat objek `$db = new DB();`
   * Jika berhasil → akan menampilkan objek dengan properti `_pdo`.
   * Jika gagal (contoh: password salah) → muncul pesan error dari `die()`.

---

### 🔧 **Contoh Berbeda: Implementasi Class DB untuk PostgreSQL**

Misalnya kamu ingin koneksi ke PostgreSQL, bukan MySQL:

```php
<?php
class DB {
    private $_host = 'localhost';
    private $_dbname = 'inventori';
    private $_username = 'admin';
    private $_password = '12345';
    private $_pdo;

    public function __construct() {
        try {
            $this->_pdo = new PDO(
                "pgsql:host={$this->_host};dbname={$this->_dbname}",
                $this->_username,
                $this->_password
            );
            $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Koneksi gagal: " . $e->getMessage());
        }
    }
}
```

```php
// index.php
require 'DB.php';
$db = new DB();
echo "Koneksi berhasil!";
```

---

### 🔍 **Kesimpulan Ringkas**

| Aspek                | Fungsi                                                   |
| -------------------- | -------------------------------------------------------- |
| **File DB.php**      | Menyimpan class `DB` yang menangani koneksi database     |
| **File index.php**   | Menguji koneksi dengan membuat objek `DB`                |
| **Property Private** | Menyimpan data sensitif seperti host, username, password |
| **Constructor**      | Membuka koneksi otomatis menggunakan PDO                 |
| **Error Handling**   | Menggunakan `try...catch` untuk menampilkan pesan error  |

---