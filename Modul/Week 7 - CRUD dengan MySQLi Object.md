# MODUL PERKULIAHAN

## Mata Kuliah: Pemrograman Lanjut

### Minggu Ke-7: Integrasi CRUD dengan MySQLi Object

# 1. IDENTITAS MATA KULIAH

| Komponen | Keterangan |
| --- | --- |
| Mata Kuliah | Pemrograman Lanjut |
| Minggu | 7 |
| Topik | Integrasi CRUD dengan MySQLi Object |
| Dosen Pengampu | **Arif Wicaksono Septyanto, S.Kom., M.Kom.** |
| Durasi | 1 Pertemuan (3 × 50 menit) |

# 2. SUB-CPMK

> **Mahasiswa mampu mengaplikasikan exception handling, Mysqli Object (C3, A4, P2).**

# 3. FOKUS TAHAP

Minggu 7 mengintegrasikan materi Minggu 5–6 menjadi aplikasi CRUD. Teori exception dan prepared statement tidak dijelaskan ulang.

# 4. BAHAN KAJIAN

- Pemisahan class koneksi/repository dari halaman antarmuka.
- CREATE, READ, UPDATE, dan DELETE dengan prepared statement.
- Validasi input dasar dan output escaping.
- Penanganan exception pada alur aplikasi.

# 5. INDIKATOR PENILAIAN

Mahasiswa mampu membangun CRUD, menggunakan API MySQLi Object secara konsisten, memakai prepared statement untuk input dinamis, menangani exception, serta memisahkan akses data dari tampilan.

# 6. STRUKTUR APLIKASI

```text
crud-mahasiswa/
├── config/Database.php
├── src/MahasiswaRepository.php
├── public/index.php
├── public/tambah.php
├── public/edit.php
└── public/hapus.php
```

# 7. CONTOH REPOSITORY

```php
class MahasiswaRepository
{
    public function __construct(private mysqli $db) {}

    public function semua(): array
    {
        return $this->db
            ->query('SELECT id, nim, nama FROM mahasiswa ORDER BY nama')
            ->fetch_all(MYSQLI_ASSOC);
    }

    public function tambah(string $nim, string $nama): void
    {
        $statement = $this->db->prepare(
            'INSERT INTO mahasiswa (nim, nama) VALUES (?, ?)'
        );
        $statement->bind_param('ss', $nim, $nama);
        $statement->execute();
    }

    public function ubah(int $id, string $nim, string $nama): void
    {
        $statement = $this->db->prepare(
            'UPDATE mahasiswa SET nim = ?, nama = ? WHERE id = ?'
        );
        $statement->bind_param('ssi', $nim, $nama, $id);
        $statement->execute();
    }

    public function hapus(int $id): void
    {
        $statement = $this->db->prepare('DELETE FROM mahasiswa WHERE id = ?');
        $statement->bind_param('i', $id);
        $statement->execute();
    }
}
```

Saat menampilkan data ke HTML, gunakan `htmlspecialchars()`. Jangan menampilkan pesan exception database mentah kepada pengguna; catat detail teknis pada log.

# 8. TUGAS PRAKTIK

Bangun CRUD mahasiswa yang menyediakan daftar, tambah, edit, dan hapus. Seluruh nilai dinamis wajib menggunakan prepared statement dan kegagalan database wajib ditangani melalui exception.
