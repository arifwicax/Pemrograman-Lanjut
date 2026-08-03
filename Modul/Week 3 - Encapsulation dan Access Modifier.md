# MODUL PERKULIAHAN

## Mata Kuliah: Pemrograman Lanjut

### Minggu Ke-3: Encapsulation dan Access Modifier

# 1. IDENTITAS MATA KULIAH

| Komponen | Keterangan |
| --- | --- |
| Mata Kuliah | Pemrograman Lanjut |
| Minggu | 3 |
| Topik | Encapsulation dan Access Modifier |
| Dosen Pengampu | **Arif Wicaksono Septyanto, S.Kom., M.Kom.** |
| Durasi | 1 Pertemuan (3 × 50 menit) |

# 2. SUB-CPMK

> **Mahasiswa mampu mengaplikasikan konsep encapsulation, dan access modifier (C3, A4, P2).**

# 3. BAHAN KAJIAN

- Tujuan encapsulation.
- Access modifier `public`, `protected`, dan `private`.
- Getter dan setter.
- Validasi sederhana pada setter.
- Menjaga konsistensi state object.

Inheritance dan overriding tidak dibahas pada minggu ini karena menjadi materi utama Minggu 4.

# 4. INDIKATOR PENILAIAN

Mahasiswa mampu:

1. Menjelaskan alasan property tidak selalu dibuat `public`.
2. Memilih access modifier sesuai kebutuhan akses.
3. Membuat getter dan setter.
4. Mengendalikan perubahan state melalui method.
5. Menerapkan validasi sederhana pada setter.

# 5. MATERI PERKULIAHAN

Encapsulation membatasi akses langsung terhadap data object. Data disimpan dalam property non-public dan diakses melalui method yang menyediakan aturan yang jelas.

```php
class Rekening
{
    private string $nomor;
    private float $saldo = 0;

    public function __construct(string $nomor)
    {
        $this->nomor = $nomor;
    }

    public function setor(float $jumlah): void
    {
        if ($jumlah <= 0) {
            throw new InvalidArgumentException('Jumlah setoran harus lebih dari nol.');
        }
        $this->saldo += $jumlah;
    }

    public function getSaldo(): float
    {
        return $this->saldo;
    }
}
```

## 5.1. Access Modifier

- `public`: dapat diakses dari mana saja.
- `protected`: dapat diakses oleh class sendiri dan class turunannya.
- `private`: hanya dapat diakses oleh class yang mendeklarasikannya.

## 5.2. Getter dan Setter

Getter mengembalikan nilai, sedangkan setter mengubah nilai dengan aturan tertentu. Setter tidak harus dibuat untuk setiap property. Property yang tidak boleh berubah setelah object dibuat cukup memiliki getter.

```php
class Produk
{
    private float $harga;

    public function setHarga(float $harga): void
    {
        if ($harga <= 0) {
            throw new InvalidArgumentException('Harga harus lebih dari nol.');
        }
        $this->harga = $harga;
    }

    public function getHarga(): float
    {
        return $this->harga;
    }
}
```

# 6. LATIHAN

Buat class `Mahasiswa` dengan property `nim`, `nama`, dan `ipk`. Tentukan access modifier yang tepat, sediakan method akses yang diperlukan, dan tolak IPK di luar rentang 0–4.

# 7. RANGKUMAN

Encapsulation menjaga data object melalui pembatasan akses. Access modifier dan method perilaku digunakan agar perubahan state selalu mengikuti aturan class.
