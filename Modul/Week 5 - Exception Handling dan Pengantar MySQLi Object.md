# MODUL PERKULIAHAN

## Mata Kuliah: Pemrograman Lanjut

### Minggu Ke-5: Exception Handling dan Pengantar MySQLi Object

# 1. IDENTITAS MATA KULIAH

| Komponen | Keterangan |
| --- | --- |
| Mata Kuliah | Pemrograman Lanjut |
| Minggu | 5 |
| Topik | Exception Handling dan Pengantar MySQLi Object |
| Dosen Pengampu | **Arif Wicaksono Septyanto, S.Kom., M.Kom.** |
| Durasi | 1 Pertemuan (3 × 50 menit) |

# 2. SUB-CPMK

> **Mahasiswa mampu mengaplikasikan exception handling, Mysqli Object (C3, A4, P2).**

# 3. POSISI DALAM RANGKAIAN MINGGU 5–7

Minggu 5 berfokus pada exception handling. Minggu 6 menerapkannya pada akses database dengan MySQLi Object, sedangkan Minggu 7 mengintegrasikannya ke aplikasi CRUD.

# 4. BAHAN KAJIAN

- Perbedaan error dan exception.
- `throw`, `try`, `catch`, dan `finally`.
- Exception bawaan dan custom exception.
- Pengantar kegagalan koneksi MySQLi Object.

# 5. INDIKATOR PENILAIAN

Mahasiswa mampu membuat blok `try-catch-finally`, melempar exception berdasarkan kondisi program, membuat custom exception, dan menangani kegagalan koneksi tanpa menampilkan informasi sensitif.

# 6. MATERI PERKULIAHAN

```php
function hitungPembagian(float $a, float $b): float
{
    if ($b == 0.0) {
        throw new InvalidArgumentException('Pembagi tidak boleh nol.');
    }
    return $a / $b;
}

try {
    echo hitungPembagian(10, 0);
} catch (InvalidArgumentException $exception) {
    echo $exception->getMessage();
} finally {
    echo ' Proses selesai.';
}
```

```php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $db = new mysqli('localhost', 'root', '', 'akademik');
    $db->set_charset('utf8mb4');
} catch (mysqli_sql_exception $exception) {
    error_log($exception->getMessage());
    echo 'Koneksi database gagal.';
}
```

# 7. LATIHAN

Buat fungsi penarikan saldo yang melempar exception jika nominal tidak positif atau melebihi saldo. Tangani setiap kegagalan dengan pesan yang sesuai.
