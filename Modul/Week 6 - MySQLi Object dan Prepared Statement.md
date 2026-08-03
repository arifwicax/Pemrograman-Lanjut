# MODUL PERKULIAHAN

## Mata Kuliah: Pemrograman Lanjut

### Minggu Ke-6: MySQLi Object dan Prepared Statement

# 1. IDENTITAS MATA KULIAH

| Komponen | Keterangan |
| --- | --- |
| Mata Kuliah | Pemrograman Lanjut |
| Minggu | 6 |
| Topik | MySQLi Object dan Prepared Statement |
| Dosen Pengampu | **Arif Wicaksono Septyanto, S.Kom., M.Kom.** |
| Durasi | 1 Pertemuan (3 × 50 menit) |

# 2. SUB-CPMK

> **Mahasiswa mampu mengaplikasikan exception handling, Mysqli Object (C3, A4, P2).**

# 3. FOKUS TAHAP

Minggu 6 menerapkan exception handling dari Minggu 5 pada koneksi dan query. Integrasi CRUD lengkap dilaksanakan pada Minggu 7.

# 4. BAHAN KAJIAN

- Koneksi dan konfigurasi MySQLi Object.
- Query SELECT dan result set.
- Prepared statement dan parameter binding.
- Exception pada koneksi dan query.
- Penutupan statement dan koneksi.

# 5. INDIKATOR PENILAIAN

Mahasiswa mampu membuat koneksi MySQLi Object, menjalankan SELECT, menggunakan prepared statement, membaca result set, dan menangani `mysqli_sql_exception`.

# 6. MATERI PERKULIAHAN

```php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $db = new mysqli('localhost', 'root', '', 'akademik');
    $db->set_charset('utf8mb4');

    $minimumIpk = 3.0;
    $statement = $db->prepare(
        'SELECT nim, nama, ipk FROM mahasiswa WHERE ipk >= ?'
    );
    $statement->bind_param('d', $minimumIpk);
    $statement->execute();

    $hasil = $statement->get_result();
    while ($mahasiswa = $hasil->fetch_assoc()) {
        echo htmlspecialchars($mahasiswa['nama']) . '<br>';
    }

    $statement->close();
    $db->close();
} catch (mysqli_sql_exception $exception) {
    error_log($exception->getMessage());
    echo 'Operasi database gagal.';
}
```

Prepared statement memisahkan perintah SQL dari nilai input. Input pengguna tidak boleh digabungkan langsung ke string SQL.

# 7. LATIHAN

Buat prepared statement untuk mencari mahasiswa berdasarkan program studi dan batas IPK. Tampilkan hasilnya ke tabel HTML dengan output escaping.
