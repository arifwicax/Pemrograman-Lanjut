# 🧩 Materi Dasar PDO (PHP Data Object)

## 1. Pengertian PDO

**PDO (PHP Data Object)** adalah **interface universal** di PHP untuk mengakses berbagai **jenis database** (MySQL, PostgreSQL, SQLite, Oracle, dan lainnya).
Dengan PDO, kode PHP Anda bisa lebih fleksibel karena cukup menggunakan **satu cara standar** untuk berkomunikasi dengan database apa pun.

🧠 **Analogi:**
Jika `mysqli` hanya bisa berbicara dengan **MySQL**, maka `PDO` seperti **penerjemah bahasa universal** yang bisa berbicara dengan banyak jenis database.

---

## 2. Struktur Umum PDO

PDO bekerja dengan 3 lapisan:

```
PHP → PDO → Database Driver → Database Server
```

Artinya, PHP tidak langsung berbicara ke database, melainkan melalui **PDO** yang menerjemahkan perintah SQL sesuai dengan database yang digunakan.

---

## 3. Keunggulan PDO

✅ Bisa digunakan untuk **berbagai jenis database** (MySQL, PostgreSQL, SQLite, Oracle, dsb).
✅ Mendukung **prepared statement** → lebih aman dari SQL Injection.
✅ Memiliki **error handling (try...catch)** yang baik.
✅ Penulisan kode lebih **rapi dan konsisten**.

---

# 💾 Membuat Objek PDO

PDO digunakan untuk membuat **koneksi antara PHP dan database**.
Cara kerjanya mirip seperti `mysqli` versi objek, di mana kita membuat sebuah **objek PDO** sebagai penghubung (sering disebut *database handler*), lalu menjalankan berbagai perintah melalui objek tersebut.

---

## 🧱 1. Format Dasar Pembuatan Objek PDO

Bentuk umum untuk membuat objek PDO adalah seperti ini:

```php
PDO::__construct(string $dsn [, string $username [, string $password [, array $options]]])
```

Ada **empat bagian utama** (argumen) yang bisa digunakan:

1. **$dsn (Data Source Name)** → berisi informasi database yang akan dihubungkan.
2. **$username** → nama pengguna database (contohnya: `root`).
3. **$password** → password pengguna database.
4. **$options** → pengaturan tambahan (opsional).

> Catatan:
> Tidak semua database memerlukan semua argumen ini.
> Misalnya, **SQLite** hanya butuh alamat file database, tanpa username atau password.

---

## 🧩 2. Apa Itu DSN (Data Source Name)?

DSN adalah **string** yang berisi informasi koneksi database.
Format umumnya seperti ini:

```
nama_driver:pengaturan_driver
```

Contohnya:

* Untuk MySQL → `mysql:host=localhost;dbname=kampus;charset=utf8mb4`
* Untuk PostgreSQL → `pgsql:host=localhost;dbname=kampus`
* Untuk SQLite → `sqlite:path/ke/database.db`

Jadi untuk MySQL, DSN-nya bisa berisi:

* `host` → alamat server database (biasanya `localhost`)
* `port` → nomor port database (default: `3306`)
* `dbname` → nama database yang akan diakses
* `charset` → jenis karakter yang digunakan

Contoh DSN lengkap:

```
mysql:host=localhost;port=3306;dbname=ilkoom;charset=utf8mb4
```

Artinya:
Gunakan driver **MySQL**, terhubung ke `localhost` port `3306`, memakai database `ilkoom`, dan gunakan karakter `utf8mb4`.

---

## ⚙️ 3. Contoh Koneksi PDO ke Database MySQL

### a. Versi sederhana:

```php
<?php
$pdo = new PDO("mysql:host=localhost", "root", "");
var_dump($pdo); // untuk melihat apakah koneksi berhasil
?>
```

Kode di atas membuat koneksi ke **MySQL di localhost** dengan **user root** dan **tanpa password**.
`$pdo` menjadi objek koneksi ke database.

---

### b. Versi lengkap (pakai DSN penuh):

```php
<?php
$pdo = new PDO("mysql:host=localhost;port=3306;dbname=ilkoom;charset=utf8mb4", "root", "");
var_dump($pdo);
?>
```

Artinya:
Koneksi ke MySQL `localhost` port `3306`, menggunakan database `ilkoom` dengan charset `utf8mb4`.

---

### c. Versi lebih rapi (gunakan variabel):

```php
<?php
$host = "127.0.0.1";
$port = "3306";
$db = "ilkoom";
$charset = "utf8mb4";
$user = "root";
$pass = "";

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";

$pdo = new PDO($dsn, $user, $pass);
?>
```

Fungsinya sama, hanya ditulis lebih rapi dan mudah dibaca.

---

## 🧠 4. Contoh PDO untuk Database Lain

| Jenis Database       | Contoh Koneksi PDO                                              |
| -------------------- | --------------------------------------------------------------- |
| Microsoft SQL Server | `$pdo = new PDO("mssql:host=$host;dbname=$db", $user, $pass);`  |
| Sybase               | `$pdo = new PDO("sybase:host=$host;dbname=$db", $user, $pass);` |
| SQLite               | `$pdo = new PDO("sqlite:/path/database.db");`                   |

> Untuk **SQLite**, tidak perlu username atau password.
> Cukup tuliskan lokasi file databasenya.

---

## 🔚 5. Menutup Koneksi PDO

PDO **tidak memiliki fungsi khusus** seperti `mysqli::close()` untuk menutup koneksi.
Sebagai gantinya, cukup isi variabel koneksi dengan `NULL`.

```php
<?php
$pdo = new PDO("mysql:host=localhost", "root", "");
// ... proses query ...
$pdo = NULL; // koneksi ditutup
?>
```

---

## ✨ Kesimpulan Singkat

* **PDO** adalah cara standar untuk menghubungkan PHP dengan berbagai database.
* Gunakan **DSN** untuk mendefinisikan informasi koneksi.
* Penulisan bisa sederhana atau lengkap tergantung kebutuhan.
* Tutup koneksi dengan `NULL` setelah selesai digunakan.

---

# ⚠️ Menangani Error pada PDO (Error Handling)

Ketika kita membuat koneksi ke database menggunakan **PDO**, sangat penting untuk **menangani error dengan benar**.
Secara **default**, jika terjadi kesalahan saat koneksi, **PHP akan menampilkan pesan error lengkap** — termasuk **username dan password** database.
Tentu ini sangat **berbahaya**, karena informasi sensitif bisa terlihat oleh orang lain.

---

## 🚫 Contoh Kasus Error PDO

Misalnya kita menulis kode seperti ini:

```php
<?php
$pdo = new PDO("mysql:host=localhost;dbname=ilkoom", "root", "r4has!a");
?>
```

Jika ternyata password salah, PHP akan langsung menampilkan pesan error lengkap seperti:

```
Fatal error: Uncaught PDOException: SQLSTATE[HY000] [1045] Access denied for user 'root'@'localhost' (using password: YES)
```

Masalahnya — di pesan error tersebut, informasi seperti **nama user**, **password**, dan **detail database** bisa ikut muncul.
Itu sebabnya kita perlu cara yang **lebih aman** untuk menanganinya.

---

## 🛠️ Cara Aman Menangani Error

Ada dua cara umum untuk mencegah error sensitif muncul ke pengguna:

### 1. **Matikan Error Reporting**

Kita bisa menonaktifkan pesan error dengan:

```php
error_reporting(0);
```

Atau melalui pengaturan di file `php.ini`.

Namun, cara ini **tidak disarankan saat tahap pengembangan**, karena kita jadi sulit mengetahui letak kesalahan.
Lebih baik digunakan **setelah aplikasi selesai dan siap digunakan (production)**.

---

### 2. **Gunakan Try–Catch (Disarankan)**

Cara paling baik adalah menggunakan **blok `try–catch`**, karena PDO secara otomatis melemparkan *exception* (`PDOException`) jika terjadi error.

Contohnya:

```php
<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=ilkoom", "root", "r4has!a");
    echo "Koneksi berhasil!";
} 
catch (PDOException $e) {
    echo "Koneksi atau query bermasalah: " . $e->getMessage() . 
         " (Kode error: " . $e->getCode() . ")";
} 
finally {
    $pdo = NULL; // menutup koneksi
}
?>
```

🧩 **Penjelasan:**

* **`try`** → bagian kode yang mungkin menyebabkan error.
* **`catch (PDOException $e)`** → menangkap error yang terjadi dan menyimpannya ke variabel `$e`.
* **`$e->getMessage()`** → menampilkan pesan error singkat.
* **`$e->getCode()`** → menampilkan kode error dari database.
* **`finally`** → dijalankan setelah try/catch selesai, biasanya untuk menutup koneksi.

---

## 📘 Catatan Tambahan

* `PDOException` adalah **kelas khusus** untuk menangani error PDO.
* Awalan **`\`** pada `\PDOException` digunakan jika kita berada di dalam **namespace PHP**.
  Jika kita tidak memakai namespace (seperti pada contoh di atas), tanda `\` boleh dihilangkan.

---

## 💡 Kesimpulan

| Cara                 | Kelebihan                                      | Kekurangan                  |
| -------------------- | ---------------------------------------------- | --------------------------- |
| `error_reporting(0)` | Cepat dan mudah                                | Tidak cocok untuk debugging |
| `try–catch`          | Aman, fleksibel, bisa menampilkan pesan khusus | Perlu sedikit kode tambahan |

👉 Jadi, **gunakan `try–catch`** untuk menangani error PDO secara aman dan profesional.

---

# ⚙️ Menjalankan Query dengan `PDO::exec()`

Setelah kita berhasil membuat koneksi ke database menggunakan PDO, langkah selanjutnya adalah **menjalankan perintah SQL** seperti `INSERT`, `UPDATE`, atau `DELETE`.

Dalam PDO, terdapat **tiga cara utama** untuk menjalankan query:

1. `PDO::exec()`
   → digunakan untuk **query yang tidak menampilkan hasil**, seperti `INSERT`, `UPDATE`, dan `DELETE`.
2. `PDO::query()`
   → digunakan untuk **query yang menghasilkan data**, seperti `SELECT`, tetapi bisa juga untuk query lain.
3. `PDO::prepare()` dan `PDO::execute()`
   → digunakan untuk **prepared statement**, biasanya untuk keamanan tambahan (menghindari SQL Injection).

Nah, di bagian ini kita akan fokus dulu pada yang paling sederhana: **`PDO::exec()`**.

---

## 💡 Apa itu `PDO::exec()`

`PDO::exec()` hanya digunakan untuk query yang **tidak perlu menampilkan data**, misalnya:

* Menambah data (`INSERT`)
* Mengubah data (`UPDATE`)
* Menghapus data (`DELETE`)

Metode ini **tidak bisa digunakan untuk query `SELECT`**, karena tidak mengembalikan hasil tabel.

---

## 📘 Cara Kerja `PDO::exec()`

Fungsi `exec()` membutuhkan **1 argumen**, yaitu perintah SQL yang ingin dijalankan.
Setelah dijalankan, `exec()` akan mengembalikan **dua kemungkinan nilai**:

* `FALSE` → jika terjadi error
* Angka (integer) → jumlah baris yang terpengaruh oleh query (disebut *affected rows*)

---

## ✍️ Contoh: Query `UPDATE`

```php
<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=ilkoom", "root", "");
    $query = "UPDATE barang SET jumlah_barang = 100 WHERE id_barang = 3";
    $count = $pdo->exec($query);

    if ($count !== FALSE) {
        echo "Query berhasil, ada $count baris yang diubah.";
    }
}
catch (PDOException $e) {
    echo "Terjadi kesalahan: " . $e->getMessage() . " (Kode: " . $e->getCode() . ")";
}
finally {
    $pdo = NULL; // tutup koneksi
}
?>
```

🧠 **Penjelasan singkat:**

* Baris `new PDO(...)` → membuat koneksi ke database.
* `$query` → berisi perintah SQL untuk mengubah data barang dengan `id_barang = 3`.
* `$pdo->exec($query)` → menjalankan perintah SQL.
* `$count` → menyimpan jumlah baris yang berubah.
* Kondisi `if ($count !== FALSE)` → memastikan query berjalan tanpa error.
* `finally` → menutup koneksi.

Jika dijalankan dan data berhasil diubah, hasilnya:

```
Query berhasil, ada 1 baris yang diubah.
```

Namun jika tidak ada data yang berubah (misalnya nilainya sudah sama), hasilnya:

```
Query berhasil, ada 0 baris yang diubah.
```

---

## 🗑️ Contoh: Query `DELETE`

```php
<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=ilkoom", "root", "");
    $query = "DELETE FROM barang WHERE id_barang = 3";
    $count = $pdo->exec($query);

    if ($count !== FALSE) {
        echo "Query berhasil, ada $count baris yang dihapus.";
    }
}
catch (PDOException $e) {
    echo "Terjadi kesalahan: " . $e->getMessage() . " (Kode: " . $e->getCode() . ")";
}
finally {
    $pdo = NULL;
}
?>
```

Hasilnya:

```
Query berhasil, ada 1 baris yang dihapus.
```

---

## ⚠️ Catatan Penting

* Gunakan `PDO::exec()` **hanya untuk query yang tidak butuh hasil data (non-SELECT)**.
* Jika ingin menampilkan hasil data, gunakan `PDO::query()`.
* Selalu gunakan **blok `try–catch`** untuk menangani kemungkinan error.
* Variabel hasil dari `exec()` bisa bernilai **0** meskipun query berhasil dijalankan (misalnya saat tidak ada data yang diubah).

---

## ✨ Kesimpulan

| Fungsi                         | Digunakan untuk                                  | Mengembalikan                              |
| ------------------------------ | ------------------------------------------------ | ------------------------------------------ |
| `PDO::exec()`                  | Query tanpa hasil (`INSERT`, `UPDATE`, `DELETE`) | Jumlah baris yang terpengaruh atau `FALSE` |
| `PDO::query()`                 | Query yang menampilkan data (`SELECT`)           | Object hasil query                         |
| `PDO::prepare()` + `execute()` | Query dengan parameter (prepared statement)      | Fleksibel & aman dari SQL Injection        |

---

Berikut versi parafrase dengan bahasa yang lebih mudah dipahami 👇

---

### **10.6. Menangani Error pada Query (Error Handling Query)**

Sekarang mari kita lihat bagaimana **PDO menangani kesalahan (error)** ketika kita menjalankan query yang salah.
Sebagai contoh, ubah isi variabel `$query` dari kode sebelumnya menjadi seperti ini:

```php
$query = "DELET FROM barang WHERE id_barang = 3";
```

Perintah ini jelas salah karena seharusnya ditulis **DELETE**, bukan **DELET**.

---

#### 🧩 Hasilnya?

Tidak muncul pesan error apa pun!
Ini sama seperti yang terjadi pada *mysqli object* — artinya, ketika query salah, kita tidak tahu apa penyebabnya secara langsung.

Nah, di **PDO**, jika ada query yang gagal dijalankan, kita bisa melihat pesan error-nya melalui dua method penting:

* `PDO::errorCode()`
* `PDO::errorInfo()`

Berikut contohnya 👇

```php
<?php
try {
  $pdo = new PDO("mysql:host=localhost;dbname=ilkoom", "root", "");
  $query = "DELET FROM barang WHERE id_barang = 3";
  $count = $pdo->exec($query);

  echo "<pre>";
  var_dump($pdo->errorCode());
  var_dump($pdo->errorInfo());
  echo "</pre>";

  if ($count !== FALSE) {
    echo "Query Ok, ada $count baris yang dihapus";
  }
}
catch (\PDOException $e) {
  echo "Koneksi / Query bermasalah: ".$e->getMessage()." (".$e->getCode().")";
}
finally {
  $pdo = NULL;
}
```

---

#### 🔍 Hasil output-nya:

```text
string(5) "42000"
array(3) {
  [0] => string(5) "42000"
  [1] => int(1064)
  [2] => string(185) "You have an error in your SQL syntax; check the manual..."
}
```

Di sini, kita bisa lihat:

* `errorCode()` menghasilkan **kode SQLSTATE** (contoh: `"42000"`) — ini adalah kode standar untuk berbagai sistem database.
* `errorInfo()` menghasilkan **array berisi 3 elemen**:

  1. Kode SQLSTATE (sama dengan `errorCode()`),
  2. Kode error dari MySQL,
  3. Pesan error detail dari MySQL.

Biasanya, kita hanya perlu memperhatikan elemen ke-2 dan ke-3 karena di situlah ada **kode error MySQL** dan **pesan error-nya**.

---

### 🧠 Menampilkan Error dengan Lebih Baik

Daripada hanya menampilkan hasil `var_dump`, kita bisa ubah kode agar lebih informatif dengan menampilkan pesan error secara langsung.

```php
<?php
try {
  $pdo = new PDO("mysql:host=localhost;dbname=ilkoom", "root", "");
  $query = "DELET FROM barang WHERE id_barang = 3";
  $count = $pdo->exec($query);

  if ($count !== FALSE) {
    echo "Query Ok, ada $count baris yang dihapus";
  } else {
    die("Query Error: " . $pdo->errorInfo()[2] . " (" . $pdo->errorInfo()[1] . ")");
  }
}
catch (\PDOException $e) {
  echo "Koneksi / Query bermasalah: " . $e->getMessage() . " (" . $e->getCode() . ")";
}
finally {
  $pdo = NULL;
}
```

Kode di atas akan **berhenti (stop)** dan menampilkan pesan error saat query gagal.

---

### ⚙️ Menangani Error Menggunakan Exception

Daripada menghentikan program dengan `die()`, cara yang lebih baik adalah menggunakan **exception** agar error bisa ditangani dengan lebih rapi.

```php
<?php
try {
  $pdo = new PDO("mysql:host=localhost;dbname=ilkoom", "root", "");
  $query = "DELET FROM barang WHERE id_barang = 3";
  $count = $pdo->exec($query);

  if ($count !== FALSE) {
    echo "Query Ok, ada $count baris yang dihapus";
  } else {
    throw new Exception($pdo->errorInfo()[2], $pdo->errorInfo()[1]);
  }
}
catch (\Exception $e) {
  echo "Koneksi / Query bermasalah: " . $e->getMessage() . " (" . $e->getCode() . ")";
}
finally {
  $pdo = NULL;
}
```

---

💡 **Catatan penting:**

* Exception yang dibuat di sini **menangani kesalahan query (SQL)**.
* Sedangkan exception yang dibahas di awal bab sebelumnya **menangani kesalahan saat membuat koneksi PDO**.

Dengan begitu, kita bisa menangani kedua jenis error dengan baik — baik error koneksi maupun error query — tanpa membocorkan informasi sensitif seperti username dan password database.


### **10.7. Mengatur Perilaku PDO dengan `PDO::setAttribute()`**

Pada bagian sebelumnya, kita sudah belajar bagaimana cara membuat **PDO menampilkan error sebagai exception** — tapi sebelumnya kita melakukannya secara manual.
Nah, kabar baiknya: **PDO sebenarnya sudah menyediakan fitur bawaan untuk otomatis melempar exception** setiap kali terjadi error, jadi kita tidak perlu menulisnya sendiri.

---

### 🔧 Menggunakan `PDO::setAttribute()`

Untuk mengubah pengaturan di PDO, kita bisa menggunakan method:

```php
$pdo->setAttribute(nama_pengaturan, nilai_pengaturan);
```

Method ini membutuhkan **dua argumen**:

1. Jenis pengaturan yang ingin diubah.
2. Nilai baru untuk pengaturan tersebut.

Contohnya, agar setiap error pada query otomatis ditangani sebagai **exception**, kita bisa menulis:

```php
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
```

* `PDO::ATTR_ERRMODE` → menunjukkan bahwa kita ingin mengubah pengaturan **mode error**.
* `PDO::ERRMODE_EXCEPTION` → artinya, error akan dilempar sebagai **exception**.

---

### ⚙️ Pilihan Mode Error di PDO

Ada tiga mode error yang bisa digunakan di PDO:

1. **`PDO::ERRMODE_SILENT`**
   → *Mode default.*
   PDO akan diam saja jika terjadi error.
   Untuk melihat pesan error, kita harus memanggil `$pdo->errorCode()` atau `$pdo->errorInfo()` secara manual.

2. **`PDO::ERRMODE_WARNING`**
   → Menampilkan pesan error dalam bentuk **peringatan (warning)**, tapi program tetap berjalan.

3. **`PDO::ERRMODE_EXCEPTION`**
   → Melempar error sebagai **exception** sehingga bisa ditangani dengan `try-catch`.

Mode yang paling aman dan direkomendasikan adalah **`PDO::ERRMODE_EXCEPTION`**.

---

### 🧪 Contoh Penggunaan

```php
<?php
try {
  $pdo = new PDO("mysql:host=localhost;dbname=ilkoom", "root", "");
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $query = "DELET FROM barang WHERE id_barang = 3"; // Salah ketik: 'DELET'
  $count = $pdo->exec($query);

  if ($count !== FALSE) {
    echo "Query Ok, ada $count baris yang dihapus";
  }
}
catch (\PDOException $e) {
  echo "Koneksi / Query bermasalah: " . $e->getMessage() . " (" . $e->getCode() . ")";
}
finally {
  $pdo = NULL;
}
```

➡️ Pada baris `setAttribute()`, kita mengatur agar **semua error otomatis dilempar sebagai exception**.
Jadi, kalau query salah (misalnya salah ketik), PDO akan langsung memunculkan **`PDOException`**, tanpa perlu membuat exception secara manual seperti sebelumnya.

---

### 🧱 Alternatif: Atur Langsung Saat Membuat Objek PDO

Selain menggunakan `setAttribute()`, kita juga bisa menuliskan pengaturannya langsung **saat membuat objek PDO**, tepatnya di **argumen ke-4** dari constructor PDO:

```php
<?php
try {
  $pdo = new PDO(
    "mysql:host=localhost;dbname=ilkoom",
    "root",
    "",
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
  );
}
catch (\PDOException $e) {
  echo $e->getMessage();
}
```

Argumen ke-4 ini ditulis dalam bentuk **array asosiatif**, dengan format:

```
[nama_pengaturan => nilai_pengaturan]
```

Jika ingin menambahkan lebih dari satu pengaturan, pisahkan dengan koma:

```php
$pdo = new PDO(
  "mysql:host=localhost;dbname=ilkoom",
  "root",
  "",
  [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
  ]
);
```

> Nantinya, pengaturan `PDO::ATTR_DEFAULT_FETCH_MODE` akan dijelaskan lebih detail pada bagian berikutnya.
> Untuk saat ini, cukup pahami bahwa kita bisa mengatur perilaku PDO baik dengan **`setAttribute()`** maupun langsung melalui **parameter ke-4 saat membuat koneksi**.


Berikut versi **parafrase dengan bahasa yang lebih mudah dipahami** dari teks tersebut 👇

---

### **10.8. Menjalankan Query dengan `PDO::query()`**

Selain menggunakan `PDO::exec()`, kita juga bisa menjalankan query di PDO dengan method **`PDO::query()`**.
Perbedaannya adalah:

* `PDO::exec()` **tidak bisa digunakan untuk query SELECT** (karena tidak mengembalikan data),
* sedangkan `PDO::query()` **bisa menjalankan semua jenis query**, baik itu **SELECT, INSERT, UPDATE, maupun DELETE**.

Cara kerja `PDO::query()` mirip dengan `mysqli::query()`. Method ini memerlukan **argumen berupa perintah SQL**, lalu **mengembalikan sebuah objek** yang berisi hasil query.
Jika pada `mysqli` hasilnya berupa **`mysqli_result`**, maka di PDO hasilnya adalah **`PDOStatement`**.
Objek `PDOStatement` inilah yang menyimpan data hasil query dan bisa diolah lebih lanjut menggunakan berbagai method seperti `fetch()` atau `fetchAll()`.

Jika ada kesalahan pada query, maka `PDO::query()` akan mengembalikan **`FALSE`**, dan bila mode error `PDO::ERRMODE_EXCEPTION` aktif, maka akan otomatis menampilkan pesan error (exception).

---

### **Contoh Membuat Objek PDOStatement**

```php
<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=ilkoom", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "SELECT * FROM barang";
    $stmt = $pdo->query($query);
    var_dump($stmt);

    $stmt = NULL;
} catch (PDOException $e) {
    echo "Koneksi / Query bermasalah: " . $e->getMessage() . " (" . $e->getCode() . ")";
} finally {
    $pdo = NULL;
}
```

**Hasil output:**

```
object(PDOStatement)#2 (1) { ["queryString"]=> string(20) "SELECT * FROM barang" }
```

Penjelasan:

* Baris 6: variabel `$query` berisi perintah SQL `SELECT * FROM barang`.
* Baris 7: `$stmt = $pdo->query($query);` membuat objek `PDOStatement` yang menyimpan hasil query.
* Baris 8: `var_dump($stmt);` digunakan untuk menampilkan isi objek tersebut.
* Baris 9: `$stmt = NULL;` digunakan untuk menghapus objek `PDOStatement` (opsional, tidak wajib dilakukan).

Karena PDO tidak memiliki fungsi khusus seperti `free()` di MySQLi, maka jika objek sudah tidak diperlukan, kita bisa menghapusnya dengan cara memberi nilai `NULL`.

---

### **Mengetahui Jumlah Baris yang Berubah**

Jika `PDO::query()` digunakan untuk query yang **mengubah data** (seperti `INSERT`, `UPDATE`, atau `DELETE`), kita bisa mengetahui **berapa banyak baris yang terpengaruh** dengan method **`rowCount()`**.

Berikut contohnya 👇

```php
<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=ilkoom", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "UPDATE barang SET jumlah_barang = 99";
    $stmt = $pdo->query($query);

    if ($stmt !== FALSE) {
        echo "Query berhasil, ada " . $stmt->rowCount() . " baris yang diperbarui.";
    }

    $stmt = NULL;
} catch (PDOException $e) {
    echo "Koneksi / Query bermasalah: " . $e->getMessage() . " (" . $e->getCode() . ")";
} finally {
    $pdo = NULL;
}
```

**Hasil output:**

```
Query berhasil, ada 5 baris yang diperbarui.
```

Penjelasan:

* Baris 6: Query `UPDATE barang SET jumlah_barang = 99` akan mengubah seluruh nilai kolom `jumlah_barang` menjadi 99.
* Baris 8: Kondisi `if ($stmt !== FALSE)` digunakan untuk memastikan query berhasil dijalankan. Jika query gagal, maka `PDO::query()` akan mengembalikan `FALSE`.
* Baris 9: `rowCount()` digunakan untuk menampilkan jumlah baris yang berhasil diperbarui.

---

Selanjutnya, untuk **menampilkan data hasil SELECT**, kita dapat menggunakan method:

* `fetch()` → untuk mengambil **satu baris data**, atau
* `fetchAll()` → untuk mengambil **semua baris data**.

Sebelum melanjutkan, pastikan isi tabel `barang` dikembalikan ke kondisi awal dengan menjalankan file `bab09\20.mysqli_generate.php`.

---

## 🧩 **10.9. Menampilkan Hasil Query dengan `PDOStatement::fetch()`**

Method **`fetch()`** digunakan untuk mengambil data hasil query dari **PDOStatement object** — satu baris data setiap kali dipanggil.
Jadi, kalau ingin menampilkan semua baris dalam tabel, `fetch()` biasanya diletakkan di dalam **perulangan while**.

---

### ⚙️ **Cara Kerja Dasar**

```php
while ($row = $stmt->fetch()) {
    // proses setiap baris data di sini
}
```

---

### 🧠 **Jenis Cara Pengambilan Data (Fetch Mode)**

Kita bisa menentukan bagaimana data diambil menggunakan argumen pada `fetch()`.
Berikut beberapa mode yang paling sering digunakan:

| Mode                | Penjelasan Singkat                                                           |
| ------------------- | ---------------------------------------------------------------------------- |
| `PDO::FETCH_NUM`    | Data diambil sebagai **array numerik** (index berupa angka urutan kolom).    |
| `PDO::FETCH_ASSOC`  | Data diambil sebagai **array asosiatif** (index berupa nama kolom).          |
| `PDO::FETCH_BOTH`   | Gabungan numeric dan associative array (default jika tidak ditulis argumen). |
| `PDO::FETCH_OBJ`    | Data diambil sebagai **object**, kolom diakses sebagai properti.             |
| `PDO::FETCH_LAZY`   | Kombinasi dari ketiganya (numeric, associative, object sekaligus).           |
| `PDO::FETCH_COLUMN` | Mengambil **satu kolom saja** dari hasil query.                              |

> Selain itu masih ada beberapa mode lainnya, bisa dilihat di dokumentasi resmi PHP.

---

## 🔹 **Contoh Penggunaan `fetch()`**

### 1️⃣ **Mode `PDO::FETCH_NUM` (Array Angka)**

```php
$pdo = new PDO("mysql:host=localhost;dbname=ilkoom", "root", "");
$stmt = $pdo->query("SELECT * FROM barang");

while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
    echo $row[0] . " | " . $row[1] . " | " . $row[2] . " | " . $row[3] . " | " . $row[4] . "<br>";
}
```

📤 **Hasil:**

```
1 | TV Samsung 43NU7090 4K | 5 | 5399000 | 2019-01-17
2 | Kulkas LG GC-A432HLHU | 10 | 7600000 | 2019-01-17
...
```

👉 Mirip seperti `$result->fetch_row()` pada `mysqli`.

---

### 2️⃣ **Mode `PDO::FETCH_ASSOC` (Array Asosiatif)**

```php
$stmt = $pdo->query("SELECT * FROM barang");

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo $row['id_barang'] . " | " . $row['nama_barang'] . " | " . $row['jumlah_barang'] . " | " . $row['harga_barang'] . " | " . $row['tanggal_update'] . "<br>";
}
```

👉 Sama seperti `$result->fetch_assoc()` di `mysqli`, data diakses lewat nama kolom.

---

### 3️⃣ **Mode `PDO::FETCH_BOTH` (Gabungan)**

```php
$stmt = $pdo->query("SELECT * FROM barang");

while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {
    echo $row['id_barang'] . " | " . $row[1] . " | " . $row['jumlah_barang'] . " | " . $row[3] . " | " . $row['tanggal_update'] . "<br>";
}
```

👉 Data bisa diakses pakai nama kolom **atau** urutan angka.
Jika tidak menulis argumen di `fetch()`, mode ini akan dipakai secara **default**.

---

### 4️⃣ **Mode `PDO::FETCH_OBJ` (Sebagai Object)**

```php
$stmt = $pdo->query("SELECT * FROM barang");

while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
    echo $row->id_barang . " | " . $row->nama_barang . " | " . $row->jumlah_barang . " | " . $row->harga_barang . " | " . $row->tanggal_update . "<br>";
}
```

👉 Sama seperti `$result->fetch_object()` di `mysqli`.
Data diakses dengan cara `$row->nama_kolom`.

---

### 5️⃣ **Mode `PDO::FETCH_LAZY` (Gabungan Lengkap)**

```php
$stmt = $pdo->query("SELECT * FROM barang");

while ($row = $stmt->fetch(PDO::FETCH_LAZY)) {
    echo $row['id_barang'] . " | " . $row[1] . " | " . $row->jumlah_barang . "<br>";
}
```

👉 Data bisa diakses **dengan tiga cara sekaligus**:

* `$row[1]` (numeric array)
* `$row['nama_kolom']` (associative array)
* `$row->nama_kolom` (object)

---

### 6️⃣ **Mode `PDO::FETCH_COLUMN` (Satu Kolom)**

```php
$stmt = $pdo->query("SELECT nama_barang FROM barang");

while ($row = $stmt->fetch(PDO::FETCH_COLUMN)) {
    echo $row . " | ";
}
```

📤 **Hasil:**

```
TV Samsung 43NU7090 4K | Kulkas LG GC-A432HLHU | Laptop ASUS ROG GL503GE | ...
```

👉 Mode ini cocok kalau hanya ingin mengambil **satu kolom saja** tanpa perlu menulis nama kolom sebagai key array.

---

## ⚙️ **Mengubah Mode Default `fetch()`**

Secara bawaan, `fetch()` menggunakan `PDO::FETCH_BOTH`.
Namun, kita bisa mengubah mode default-nya menggunakan `setAttribute()`:

```php
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_LAZY);
```

Atau langsung saat membuat koneksi PDO:

```php
$pdo = new PDO(
    "mysql:host=localhost;dbname=ilkoom",
    "root",
    "",
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    ]
);
```

Dengan begitu, jika `fetch()` dipanggil tanpa argumen:

```php
while ($row = $stmt->fetch()) {
    echo $row->nama_barang;
}
```

Maka hasilnya otomatis mengikuti mode default yang sudah diatur.

---

### 🧩 **Kesimpulan**

| Mode           | Cara Akses                       | Keterangan              |
| -------------- | -------------------------------- | ----------------------- |
| `FETCH_NUM`    | `$row[0]`                        | Berdasarkan nomor kolom |
| `FETCH_ASSOC`  | `$row['nama_kolom']`             | Berdasarkan nama kolom  |
| `FETCH_BOTH`   | `$row[0]` / `$row['nama_kolom']` | Gabungan (default)      |
| `FETCH_OBJ`    | `$row->nama_kolom`               | Sebagai object          |
| `FETCH_LAZY`   | Campuran semua cara              | Fleksibel               |
| `FETCH_COLUMN` | `$row`                           | Hanya 1 kolom saja      |

---


## 🧩 **10.10. Menampilkan Hasil Query dengan `PDOStatement::fetchAll()`**

Method **`fetchAll()`** merupakan versi lanjutan dari **`fetch()`** yang sebelumnya sudah kita pelajari.
Kalau `fetch()` hanya mengambil **satu baris data setiap kali dijalankan**, maka `fetchAll()` langsung **mengambil semua baris hasil query SELECT sekaligus**.

Karena mengambil seluruh isi tabel, hasil dari `fetchAll()` akan berupa **array dua dimensi**, yaitu:

* Dimensi pertama berisi **baris** data.
* Dimensi kedua berisi **kolom** dari tabel.

Metode ini mirip dengan `mysqli_stmt::fetch_all()` pada pembahasan `mysqli object`.

---

### ⚙️ **Mode Pengambilan Data (`Fetch Mode`)**

Sama seperti `fetch()`, method `fetchAll()` juga membutuhkan satu argumen berupa konstanta untuk menentukan bentuk hasil data yang diambil.
Beberapa mode yang dapat digunakan:

| Mode                  | Keterangan Singkat                                                         |
| --------------------- | -------------------------------------------------------------------------- |
| `PDO::FETCH_NUM`      | Hasilnya berupa **array numerik** (index kolom berupa angka).              |
| `PDO::FETCH_ASSOC`    | Hasilnya berupa **array asosiatif** (index kolom berupa nama kolom).       |
| `PDO::FETCH_BOTH`     | Gabungan antara numerik dan asosiatif (default).                           |
| `PDO::FETCH_OBJ`      | Mengembalikan hasil sebagai **object**.                                    |
| `PDO::FETCH_CLASS`    | Hasil disimpan dalam **class tertentu** yang kita tentukan.                |
| `PDO::FETCH_COLUMN`   | Mengambil hanya **satu kolom** saja.                                       |
| `PDO::FETCH_KEY_PAIR` | Mengambil dua kolom dan menggabungkannya sebagai pasangan **key → value**. |

> Semua mode di atas sama seperti pada `fetch()`, kecuali `PDO::FETCH_LAZY` yang tidak bisa digunakan di `fetchAll()`.

---

## 🧠 **Contoh Penggunaan `fetchAll()`**

---

### 1️⃣ `PDO::FETCH_NUM` — Array Angka

```php
$pdo = new PDO("mysql:host=localhost;dbname=ilkoom", "root", "");
$stmt = $pdo->query("SELECT * FROM barang");
$arr = $stmt->fetchAll(PDO::FETCH_NUM);

echo "<pre>";
print_r($arr);
echo "</pre>";

echo "<br>" . $arr[2][1];
```

🧾 **Penjelasan:**

* `$arr` berisi array dua dimensi.
* `$arr[2][1]` berarti: ambil **baris ke-3**, **kolom ke-2** (nama_barang).
* Hasil `print_r()` akan menampilkan seluruh isi tabel dengan index angka.

---

### 2️⃣ `PDO::FETCH_ASSOC` — Array Nama Kolom

```php
$stmt = $pdo->query("SELECT * FROM barang");
$arr = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<pre>";
print_r($arr);
echo "</pre>";

echo "<br>" . $arr[2]["nama_barang"];
```

🧾 **Penjelasan:**

* Index pertama (baris) tetap angka.
* Index kedua (kolom) adalah **nama kolom** dari database.
* Contoh: `$arr[2]["nama_barang"]` → menampilkan nama barang dari baris ke-3.

---

### 3️⃣ `PDO::FETCH_OBJ` — Hasil Sebagai Object

```php
$stmt = $pdo->query("SELECT * FROM barang");
$arr = $stmt->fetchAll(PDO::FETCH_OBJ);

echo "<pre>";
print_r($arr);
echo "</pre>";

echo $arr[2]->nama_barang;
```

🧾 **Penjelasan:**

* Setiap baris hasil query disimpan sebagai object `stdClass`.
* Untuk mengakses kolom, gunakan tanda panah `->`.
  Contoh: `$arr[2]->nama_barang`.

---

### 4️⃣ `PDO::FETCH_CLASS` — Disimpan ke Dalam Class

```php
class MyClass {}

$stmt = $pdo->query("SELECT * FROM barang");
$arr = $stmt->fetchAll(PDO::FETCH_CLASS, "MyClass");
```

🧾 **Penjelasan:**

* Setiap baris data disimpan sebagai object dari class `MyClass`.
* Dengan cara ini, kita bisa menambahkan property atau method ke dalam class agar data lebih mudah diolah.

Contoh lanjutan:

```php
class IlkoomBarang {
    public $nama_toko = "Ilkoom Store";
    public function __set($name, $value) {
        $this->$name = strtoupper($value);
    }
}

$stmt = $pdo->query("SELECT * FROM barang");
$arr = $stmt->fetchAll(PDO::FETCH_CLASS, "IlkoomBarang");
```

🧩 **Hasil:**

* Setiap object berisi data dari tabel `barang` + properti tambahan `nama_toko`.
* Karena ada method `__set()`, semua teks otomatis diubah menjadi huruf besar.

---

### 5️⃣ `PDO::FETCH_COLUMN` — Mengambil Satu Kolom Saja

```php
$stmt = $pdo->query("SELECT harga_barang FROM barang");
$arr = $stmt->fetchAll(PDO::FETCH_COLUMN);

print_r($arr);
echo $arr[2];
```

🧾 **Penjelasan:**

* Hasil hanya berisi **satu dimensi array** (karena hanya satu kolom).
* `$arr[2]` menampilkan nilai dari baris ke-3.
* Jika query mengambil lebih dari satu kolom (`SELECT *`), maka hanya **kolom pertama** yang digunakan.

---

### 6️⃣ `PDO::FETCH_KEY_PAIR` — Data Sebagai Pasangan Key → Value

```php
$stmt = $pdo->query("SELECT id_barang, harga_barang FROM barang");
$arr = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

print_r($arr);
echo $arr[3];
```

🧾 **Penjelasan:**

* Kolom pertama (`id_barang`) menjadi **key**.
* Kolom kedua (`harga_barang`) menjadi **value**.
* Jadi `$arr[3]` akan menampilkan harga barang dengan `id_barang = 3`.

Contoh lain:

```php
$stmt = $pdo->query("SELECT nama_barang, harga_barang FROM barang");
$arr = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

echo $arr["TV Samsung 43NU7090 4K"];
```

🧩 **Hasil:**

* Akan menampilkan harga dari barang bernama “TV Samsung 43NU7090 4K”.
* Mode ini hanya bisa digunakan jika hasil query memiliki **tepat dua kolom**.

---

## 🔹 **Kesimpulan Singkat**

| Mode                  | Cara Akses Data        | Keterangan                        |
| --------------------- | ---------------------- | --------------------------------- |
| `PDO::FETCH_NUM`      | `$arr[baris][kolom]`   | Array angka (nomor urutan kolom). |
| `PDO::FETCH_ASSOC`    | `$arr[baris]['kolom']` | Array nama kolom.                 |
| `PDO::FETCH_OBJ`      | `$arr[baris]->kolom`   | Data sebagai object.              |
| `PDO::FETCH_CLASS`    | `$arr[baris]->kolom`   | Disimpan ke dalam class tertentu. |
| `PDO::FETCH_COLUMN`   | `$arr[baris]`          | Hanya satu kolom saja.            |
| `PDO::FETCH_KEY_PAIR` | `$arr[key]`            | Dua kolom → key dan value.        |

---

### **10.11. Prepared Statement dengan PDO**

Agar query ke database lebih **aman**, terutama jika datanya berasal dari **input form pengguna**, sebaiknya kita menggunakan **Prepared Statement**.
Keuntungan lain, **Prepared Statement di PDO** jauh lebih **mudah dan fleksibel** dibandingkan versi **mysqli**.

---

#### **Konsep dasar Prepared Statement**

Langkah-langkahnya tetap sama:

1. **Prepare** – menyiapkan query SQL.
2. **Bind** – menghubungkan data ke query.
3. **Execute** – menjalankan query.

Namun, di **PDO**, proses *bind* dan *execute* bisa dilakukan **langsung dalam satu langkah**.

Selain itu, kita **tidak perlu membuat objek baru** khusus untuk prepared statement seperti di mysqli.
PDO cukup menggunakan **objek `PDOStatement`** — yaitu objek yang sama yang biasa dipakai untuk method `fetch()` dan `fetchAll()`.

Artinya, setelah menjalankan prepared statement, kita bisa langsung menampilkan hasilnya dengan cara yang sama seperti query biasa.

---

### **Contoh 1: Prepared Statement dengan satu parameter**

```php
<?php
$pdo = new PDO("mysql:host=localhost;dbname=ilkoom", "root", "");
$query = "SELECT * FROM barang WHERE id_barang = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([4]);
$arr = $stmt->fetchAll(PDO::FETCH_NUM);

echo "<pre>";
print_r($arr);
echo "</pre>";
echo $arr[0][1];
```

**Penjelasan:**

* Tanda **`?`** dalam query adalah **tempat untuk nilai yang akan diisi nanti**.
* `prepare()` digunakan untuk menyiapkan query.
* `execute([4])` digunakan untuk menjalankan query sekaligus mengisi tanda tanya dengan angka 4.
  Artinya, query yang sebenarnya dijalankan adalah:

  ```sql
  SELECT * FROM barang WHERE id_barang = 4
  ```
* Nilai `[4]` di dalam `execute()` harus dalam bentuk **array**, walaupun hanya satu nilai.
* Hasil dari query bisa diambil dengan `fetchAll()` seperti biasa.

---

### **Contoh 2: Prepared Statement dengan dua kondisi**

```php
<?php
$pdo = new PDO("mysql:host=localhost;dbname=ilkoom", "root", "");
$query = "SELECT * FROM barang WHERE id_barang = ? OR nama_barang = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([1, "Printer Epson L220"]);

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo $row['id_barang']." | ".$row['nama_barang']." | ".
         $row['jumlah_barang']." | ".$row['harga_barang']." | ".
         $row['tanggal_update']."<br>";
}
```

**Penjelasan:**

* Karena ada **dua tanda tanya (?)**, maka `execute()` juga harus diisi dua nilai, yaitu:

  ```php
  [1, "Printer Epson L220"]
  ```
* Query yang sebenarnya dijalankan:

  ```sql
  SELECT * FROM barang WHERE id_barang = 1 OR nama_barang = "Printer Epson L220"
  ```
* Hasilnya ditampilkan dengan `fetch(PDO::FETCH_ASSOC)` agar data bisa diakses menggunakan nama kolom.

---

### **Perbedaan dengan mysqli**

Di mysqli, kita harus melakukan proses *bind* secara manual dan menentukan tipe data (misalnya integer atau string).
Sedangkan di PDO, **semua input dianggap string**, dan MySQL tetap bisa memprosesnya meskipun kolomnya bertipe angka.

Contohnya, kedua query ini tetap valid:

```sql
SELECT harga_barang FROM barang WHERE id_barang = 2
SELECT harga_barang FROM barang WHERE id_barang = '2'
```

---

### **Contoh 3: Menggunakan variabel dalam `execute()`**

```php
<?php
$pdo = new PDO("mysql:host=localhost;dbname=ilkoom", "root", "");
$query = "SELECT * FROM barang WHERE id_barang = ? OR nama_barang = ?";
$stmt = $pdo->prepare($query);

$id = 1;
$nama = "Printer Epson L220";

$stmt->execute([$id, $nama]);

while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
    echo $row[0]." | ".$row[1]." | ".$row[2]." | ".$row[3]." | ".$row[4]."<br>";
}
```

**Penjelasan:**

* Nilai untuk query diambil dari variabel `$id` dan `$nama`.
* PDO secara otomatis menggantikan tanda tanya dengan nilai variabel tersebut.
* Hasilnya tetap sama seperti contoh sebelumnya.

---

### **Kesimpulan**

* **Prepared Statement di PDO** lebih sederhana dan aman digunakan.
* Tidak perlu menentukan tipe data atau melakukan bind manual.
* Lebih fleksibel karena bisa langsung menampilkan hasil query dengan `fetch()` atau `fetchAll()`.

---

Berikut versi **parafrase dan penyederhanaan** dari bagian *10.12. Prepared Statement dengan Named Parameters* dan *10.13. Multiple Execution Prepared Statement* 👇

---

## **10.12. Prepared Statement dengan Named Parameters**

Sebelumnya, kita sudah menggunakan tanda tanya **`?`** sebagai penanda (placeholder) untuk data input pada *prepared statement*.
Namun di **PDO**, ada cara lain yang lebih mudah dibaca, yaitu menggunakan **named parameter**.

Named parameter menggunakan **nama yang diawali tanda titik dua (:)**, misalnya `:id`, `:nama`, atau `:harga_barang`.
Kemudian, saat mengeksekusi query, kita mengirimkan data dalam bentuk **array asosiatif (associative array)**, dengan nama yang sama seperti placeholder-nya.

---

### **Contoh penggunaan named parameter**

```php
<?php
$pdo = new PDO("mysql:host=localhost;dbname=ilkoom", "root", "");
$query = "SELECT * FROM barang WHERE id_barang = :id OR nama_barang = :nama";
$stmt = $pdo->prepare($query);
$stmt->execute(['id'=>1, 'nama'=>"Printer Epson L220"]);

while ($row = $stmt->fetch(PDO::FETCH_NUM)){
    echo $row[0]." | ".$row[1]." | ".$row[2]." | ".$row[3]." | ".$row[4]."<br>";
}
```

**Penjelasan:**

* Pada query, kita menggunakan **`:id` dan `:nama`** sebagai pengganti tanda tanya.
* Saat menjalankan `execute()`, kita kirimkan data menggunakan array asosiatif:

  ```php
  ['id'=>1, 'nama'=>"Printer Epson L220"]
  ```
* Hasilnya sama seperti menggunakan tanda tanya, tapi **lebih jelas dan mudah dibaca**.

---

### **Kelebihan named parameter**

Salah satu keuntungan utama adalah **urutan input tidak berpengaruh**.
Selama nama parameter cocok, urutannya boleh berbeda.

---

### **Contoh tanpa memperhatikan urutan**

```php
<?php
$pdo = new PDO("mysql:host=localhost;dbname=ilkoom", "root", "");
$query = "SELECT * FROM barang WHERE jumlah_barang < :jumlah OR harga_barang > :harga";
$stmt = $pdo->prepare($query);
$stmt->execute(['harga'=>5000000, 'jumlah'=>15]);

while ($row = $stmt->fetch(PDO::FETCH_NUM)){
    echo $row[0]." | ".$row[1]." | ".$row[2]." | ".$row[3]." | ".$row[4]."<br>";
}
```

**Penjelasan:**

* Di query, urutan parameter adalah `:jumlah` lalu `:harga`.
* Namun di `execute()`, kita bisa menulis urutannya terbalik (`'harga'` dulu, baru `'jumlah'`).
* Tidak masalah, karena PDO membaca **berdasarkan nama parameter, bukan urutan posisi**.

---

Kita juga bisa menuliskan key array dengan atau tanpa titik dua — keduanya sah:

```php
$stmt->execute(['harga'=>5000000, 'jumlah'=>15]);
$stmt->execute([':harga'=>5000000, ':jumlah'=>15]);
```

---

## **10.13. Multiple Execution Prepared Statement**

Salah satu keunggulan besar *prepared statement* adalah kita bisa menjalankan **query yang sama berkali-kali** dengan data yang berbeda — tanpa harus menulis ulang query-nya.
Hal ini disebut **multiple execution**.

Fitur ini sangat berguna untuk melakukan **insert data dalam jumlah banyak** secara efisien dan aman.

---

### **Contoh multiple execution**

```php
<?php
// Ambil tanggal dan waktu sekarang
$sekarang = new DateTime('now', new DateTimeZone('Asia/Jakarta'));
$timestamp = $sekarang->format("Y-m-d H:i:s");

$pdo = new PDO("mysql:host=localhost;dbname=ilkoom", "root", "");
$query = "INSERT INTO barang (nama_barang, jumlah_barang, harga_barang, tanggal_update)
          VALUES (:nama, :jumlah, :harga, :tanggal)";
$stmt = $pdo->prepare($query);

// Input data pertama
$nama = "Cosmos CRJ-8229 - Rice Cooker";
$jumlah = 4;
$harga = 299000;
$tanggal = $timestamp;
$stmt->execute(['nama'=>$nama, 'jumlah'=>$jumlah, 'harga'=>$harga, 'tanggal'=>$tanggal]);
echo "Query OK, ".$stmt->rowCount()." baris berhasil ditambah <br>";

// Input data kedua
$arr_input = [
  'nama' => "Philips Blender HR 2157",
  'jumlah' => 11,
  'harga' => 629000,
  'tanggal' => $timestamp
];
$stmt->execute($arr_input);
echo "Query OK, ".$stmt->rowCount()." baris berhasil ditambah <br>";

// Menampilkan semua data
$query = "SELECT * FROM barang";
$stmt = $pdo->query($query);
while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
    echo $row[0]." | ".$row[1]." | ".$row[2]." | ".$row[3]." | ".$row[4]."<br>";
}
```

---

**Penjelasan singkat:**

* Pertama, kita buat query `INSERT` dengan **named parameter** (`:nama`, `:jumlah`, `:harga`, `:tanggal`).
* Lalu, kita **jalankan query dua kali** (`execute()` dua kali) dengan data yang berbeda.
  Tidak perlu menulis query baru.
* Hasilnya: dua data baru berhasil dimasukkan ke tabel *barang*.

---

### **Kesimpulan**

* **Named parameter** membuat query lebih mudah dibaca dan tidak bergantung pada urutan data.
* **Multiple execution** memungkinkan satu query *prepared statement* digunakan berulang kali dengan nilai berbeda.
* Kedua fitur ini membuat PDO lebih **efisien, aman, dan mudah dikelola** dibandingkan cara konvensional.

---

### **10.15. Proses Bind Manual pada Prepared Statement**

Dalam MySQL, perintah **`LIMIT`** digunakan untuk membatasi jumlah data yang ditampilkan.
Contohnya, jika kita ingin menampilkan 3 barang dengan harga termurah, kita bisa menulis query seperti ini:

```sql
SELECT * FROM barang ORDER BY harga_barang LIMIT 3
```

Namun, saat kita menggunakan **PDO (PHP Data Object)**, ada masalah ketika nilai `LIMIT` diambil dari **prepared statement**.
Mari lihat contoh berikut:

```php
$query = "SELECT * FROM barang ORDER BY harga_barang LIMIT :batas";
$stmt = $pdo->prepare($query);
$stmt->execute(['batas'=>3]);
```

Kode di atas **akan menghasilkan error**, padahal terlihat benar.
Masalahnya terjadi karena **PDO secara otomatis mengubah semua input prepared statement menjadi string**.
Akibatnya, query yang dijalankan menjadi seperti ini:

```sql
SELECT * FROM barang ORDER BY harga_barang LIMIT '3'
```

Padahal, MySQL hanya menerima nilai angka (integer) untuk LIMIT — bukan string.
Seharusnya query yang benar adalah:

```sql
SELECT * FROM barang ORDER BY harga_barang LIMIT 3
```

---

### 🧩 **Solusi: Gunakan Bind Manual**

Untuk mengatasi masalah ini, kita bisa menggunakan salah satu dari dua method berikut:

* `bindValue()`
* `bindParam()`

Dengan kedua method ini, kita bisa menentukan **tipe data** dari nilai yang dikirim ke query.

---

### ✅ **Contoh 1: Menggunakan `bindValue()`**

```php
$query = "SELECT * FROM barang ORDER BY harga_barang LIMIT :batas";
$stmt = $pdo->prepare($query);
$stmt->bindValue('batas', 3, PDO::PARAM_INT);
$stmt->execute();
```

Penjelasan:

* `'batas'` → nama parameter di query.
* `3` → nilai yang ingin dikirim.
* `PDO::PARAM_INT` → tipe data integer.

`bindValue()` memiliki **3 parameter utama**:

1. Nama parameter (misal `'batas'`)
2. Nilai parameter (misal `3`)
3. Jenis tipe data (`PDO::PARAM_INT`, `PDO::PARAM_STR`, `PDO::PARAM_BOOL`, `PDO::PARAM_NULL`, atau `PDO::PARAM_LOB`)

Jika parameter ketiga tidak diisi, nilai otomatis dianggap **string** (`PDO::PARAM_STR`).

Dengan cara ini, query `LIMIT 3` akan dijalankan dengan benar.

---

### ✅ **Contoh 2: Menggunakan `bindValue()` untuk Banyak Parameter**

Jika query memiliki lebih dari satu parameter, `bindValue()` bisa dipanggil beberapa kali:

```php
$query = "SELECT * FROM barang WHERE id_barang = :id OR nama_barang = :barang";
$stmt = $pdo->prepare($query);
$stmt->bindValue('id', 5, PDO::PARAM_INT);
$stmt->bindValue('barang', "Printer Epson L220", PDO::PARAM_STR);
$stmt->execute();
```

---

### ✅ **Contoh 3: Menggunakan Positional Parameter (?)**

Kita juga bisa menggunakan tanda **tanya (?)** sebagai pengganti nama parameter:

```php
$query = "SELECT * FROM barang WHERE id_barang = ? OR nama_barang = ?";
$stmt = $pdo->prepare($query);
$stmt->bindValue(1, 5, PDO::PARAM_INT);
$stmt->bindValue(2, "Printer Epson L220", PDO::PARAM_STR);
$stmt->execute();
```

Angka `1` dan `2` di sini menandakan urutan tanda tanya dalam query.

---

### ✅ **Contoh 4: Menggunakan `bindParam()`**

`bindParam()` mirip dengan `bindValue()`, tetapi nilai yang dikirim **harus berupa variabel**, bukan angka langsung.

```php
$query = "SELECT * FROM barang ORDER BY harga_barang LIMIT :batas";
$stmt = $pdo->prepare($query);
$stmt->bindParam('batas', $batas, PDO::PARAM_INT);
$batas = 3;
$stmt->execute();
```

Jika kita menulis `bindParam('batas', 3, PDO::PARAM_INT)`, maka akan terjadi error, karena `bindParam` tidak menerima nilai langsung.

---

### 💡 Kesimpulan

Secara umum, kita bisa langsung mengirim nilai ke `execute()` tanpa perlu `bindValue()` atau `bindParam()`.
Namun, untuk kasus tertentu — seperti `LIMIT` atau parameter yang membutuhkan tipe data tertentu — **bind manual lebih aman dan disarankan**.

---