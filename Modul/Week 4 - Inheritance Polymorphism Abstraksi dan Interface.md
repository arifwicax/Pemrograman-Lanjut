# MODUL PERKULIAHAN

## Mata Kuliah: Pemrograman Lanjut

### Minggu Ke-4: Inheritance, Polymorphism, Abstraksi, dan Interface

# 1. IDENTITAS MATA KULIAH

| Komponen | Keterangan |
| --- | --- |
| Mata Kuliah | Pemrograman Lanjut |
| Minggu | 4 |
| Topik | Inheritance, Polymorphism, Abstraksi, dan Interface |
| Dosen Pengampu | **Arif Wicaksono Septyanto, S.Kom., M.Kom.** |
| Durasi | 1 Pertemuan (3 × 50 menit) |

# 2. SUB-CPMK

> **Mahasiswa mampu mengaplikasikan inheritance, polymorphism, abstraksi dan interface (C3, A4, P2).**

# 3. BAHAN KAJIAN

- Inheritance dengan `extends`.
- Method overriding dan `parent`.
- Abstract class dan abstract method.
- Interface dan `implements`.
- Polymorphism melalui kontrak tipe yang sama.

Trait, magic method, late static binding, dan method chaining tidak menjadi materi inti minggu ini karena tidak dinyatakan dalam Sub-CPMK.

# 4. INDIKATOR PENILAIAN

Mahasiswa mampu membuat parent dan child class, melakukan overriding, membuat abstract class dan interface, serta memproses object berbeda melalui tipe abstrak yang sama.

# 5. MATERI PERKULIAHAN

```php
class Pegawai
{
    public function deskripsi(): string
    {
        return 'Pegawai';
    }
}

class Dosen extends Pegawai
{
    public function deskripsi(): string
    {
        return parent::deskripsi() . ' dengan peran dosen';
    }
}
```

```php
interface DapatDibayar
{
    public function bayar(float $jumlah): string;
}

class TransferBank implements DapatDibayar
{
    public function bayar(float $jumlah): string
    {
        return "Transfer sebesar {$jumlah}";
    }
}

function prosesPembayaran(DapatDibayar $metode, float $jumlah): string
{
    return $metode->bayar($jumlah);
}
```

# 6. LATIHAN

Buat abstract class `BangunDatar` dengan method `hitungLuas()`. Implementasikan pada `Persegi` dan `Lingkaran`, lalu proses kumpulan object melalui tipe `BangunDatar`.
