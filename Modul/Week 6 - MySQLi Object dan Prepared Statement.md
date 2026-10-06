# MODUL PERKULIAHAN

## Mata Kuliah: Pemrograman Lanjut
### Minggu Ke-6: MySQLi Object dan Prepared Statement

## 1. Identitas dan Sub-CPMK

| Komponen | Keterangan |
| --- | --- |
| Mata Kuliah | Pemrograman Lanjut |
| Minggu | 6 |
| Topik | MySQLi Object, result set, validasi input, prepared statement, dan transaksi |
| Dosen Pengampu | **Arif Wicaksono Septyanto, S.Kom., M.Kom.** |
| Durasi | 1 pertemuan (3 × 50 menit) |

Mahasiswa mampu mengaplikasikan koneksi database menggunakan MySQLi Object, menjalankan query, mengolah result set, menerapkan prepared statement dan parameter binding, serta menangani kesalahan dan transaksi database secara terkontrol (C3, A4, P2).

## 2. Prasyarat dan Struktur Script

Prasyarat: dasar PHP dan class/object, SQL dasar, serta try-catch-finally dari Minggu 5.

Contoh menggunakan database kampus_lanjut dan tabel inventaris. Sesuaikan username/password MySQL dengan komputer masing-masing. Script praktik berada di [Script/Week 06](../Script/Week%2006/):

1. 01-koneksi-dan-query: koneksi, database, tabel, dan query dasar.
2. 02-result-set: membaca hasil SELECT, menampilkan data, serta query perubahan.
3. 03-validasi-input-sql: validasi tipe input dan pembahasan SQL injection.
4. 04-prepared-statement: prepare, binding, SELECT, INSERT, dan penggunaan ulang statement.
5. 05-transaksi: begin_transaction, commit, dan rollback.

Alur praktik:

Koneksi → database/tabel → query/result set → validasi input → prepared statement → transaksi

### Cara membaca folder praktik

Jalankan script secara berurutan. Setiap kelompok script menambahkan satu konsep baru pada kode sebelumnya. Nama variabel pada script menggunakan istilah yang sama, seperti `$databaseMysqli`, `$perintahSql`, `$hasil`, dan `$pernyataan`, agar alurnya mudah dibandingkan.

## 3. Koneksi MySQLi Object

Aktifkan exception MySQLi sebelum membuat koneksi:

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    try {
        $db = new mysqli('localhost', 'root', '', 'kampus_lanjut');
        $db->set_charset('utf8mb4');
        echo 'Koneksi berhasil';
    } catch (mysqli_sql_exception $error) {
        error_log($error->getMessage());
        echo 'Koneksi database gagal.';
    } finally {
        if (isset($db)) {
            $db->close();
        }
    }

new mysqli menerima host, username, password, dan database. set_charset mengatur encoding. close menutup koneksi.

Script terkait: 01-koneksi-dan-query/10.mysqli_query.php sampai 14.mysqli_query_error_exception_2.php.

Potongan dari `10.mysqli_query.php` memperlihatkan pola dasar koneksi dan query:

    $databaseMysqli = new mysqli(
        'localhost',
        'root',
        '',
        'kampus_lanjut'
    );
    $perintahSql = 'SELECT * FROM inventaris';
    $hasil = $databaseMysqli->query($perintahSql);

Script awal menunjukkan pemeriksaan $db->error, die(), dan exception. Untuk aplikasi, exception lebih terstruktur. Detail error sebaiknya dicatat memakai error_log(), bukan ditampilkan kepada pengguna.

## 4. Menyiapkan Database dan Tabel

Script 15.mysqli_create_database.php sampai 20.mysqli_generate.php menunjukkan cara membuat database, memilih database, membuat tabel, menghapus tabel lama, dan mengisi data.

    CREATE TABLE inventaris (
        id_inventaris INT PRIMARY KEY AUTO_INCREMENT,
        nama_inventaris VARCHAR(50),
        jumlah_inventaris INT,
        biaya_inventaris DECIMAL(12, 2),
        waktu_pembaruan TIMESTAMP
    );

    INSERT INTO inventaris
        (nama_inventaris, jumlah_inventaris, biaya_inventaris, waktu_pembaruan)
    VALUES ('Laptop ASUS ROG GL503GE', 7, 16200000, CURRENT_TIMESTAMP);

Jalankan script pembuat database/tabel pada database latihan. DROP TABLE dan DELETE dapat menghilangkan data sehingga jangan dijalankan pada database penting.

## 5. Query dan Result Set

### Menjalankan SELECT

    $hasil = $db->query('SELECT * FROM inventaris');
    echo 'Kolom: ' . $hasil->field_count;
    echo ' Baris: ' . $hasil->num_rows;

$hasil adalah object mysqli_result. num_rows berisi jumlah baris, field_count jumlah kolom, dan free() membebaskan memory.

### Membaca baris

| Method | Bentuk hasil |
| --- | --- |
| fetch_row() | Array dengan index angka |
| fetch_assoc() | Array dengan nama kolom |
| fetch_array(MYSQLI_ASSOC) | Array associative |
| fetch_object() | Object dengan properti nama kolom |
| fetch_all(MYSQLI_ASSOC) | Semua baris sebagai array |

Rekomendasi untuk pemula:

    $hasil = $db->query('SELECT * FROM inventaris');
    while ($baris = $hasil->fetch_assoc()) {
        echo $baris['id_inventaris'] . ' | ';
        echo $baris['nama_inventaris'] . ' | ';
        echo $baris['jumlah_inventaris'] . '<br>';
    }
    $hasil->free();

Satu baris dibaca dengan fetch_assoc(). Seluruh baris dapat dibaca dengan fetch_all(MYSQLI_ASSOC). Script terkait: 21.mysqli_result_object.php sampai 37.mysqli_fetch_array_process.php.

### Menampilkan data ke HTML

Data dari database harus di-escape:

    function e(string $nilai): string
    {
        return htmlspecialchars($nilai, ENT_QUOTES, 'UTF-8');
    }

    foreach ($data as $baris) {
        echo '<td>' . e((string) $baris['id_inventaris']) . '</td>';
        echo '<td>' . e($baris['nama_inventaris']) . '</td>';
    }

Lihat 34.mysqli_result_fetch_all_html.php, 35.mysqli_result_fetch_all_html_style.php, dan 37.mysqli_fetch_array_process.php.

Urutan yang perlu diingat dari script result set adalah:

    $hasil = $databaseMysqli->query($perintahSql);
    while ($baris = $hasil->fetch_assoc()) {
        echo $baris['nama_inventaris'];
    }
    $hasil->free();

`fetch_assoc()` mengembalikan satu baris setiap kali dipanggil. Ketika tidak ada baris lagi, nilainya menjadi `false`, sehingga cocok digunakan sebagai kondisi `while`.

### Query DELETE dan beberapa query

    $db->query('DELETE FROM inventaris WHERE id_inventaris = 1');
    echo 'Data berubah: ' . $db->affected_rows;

multi_query ditunjukkan pada 40.mysqli_multi_query.php dan 41.mysqli_multi_query_2.php, tetapi jangan menggabungkan input pengguna ke SQL. Untuk input gunakan prepared statement.

## 6. Validasi Input dan SQL Injection

Validasi dilakukan sebelum input dikirim ke database:

    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
    if ($id === false || $id === null || $id < 1) {
        exit('ID tidak valid');
    }

real_escape_string atau casting bukan pengganti prepared statement. Script 42.mysqli_validate_int.php sampai 47.mysqli_validate_string_real_escape_string.php membandingkan beberapa pendekatan; gunakan prepared statement sebagai pilihan utama.

Contoh pemeriksaan integer dari `42.mysqli_validate_int.php` dapat dikembangkan menjadi validasi yang menghentikan proses sebelum query dijalankan:

    $id_inventaris = filter_input(
        INPUT_GET,
        'id_inventaris',
        FILTER_VALIDATE_INT
    );

    if ($id_inventaris === false || $id_inventaris === null) {
        exit('ID inventaris tidak valid');
    }

## 7. Prepared Statement

Prepared statement memisahkan struktur SQL dari nilai input. Empat tahapnya adalah prepare, bind_param, execute, lalu get_result atau bind_result.

Kode tipe bind_param: i = integer, d = double/desimal, s = string, b = data biner. Jumlah kode harus sama dengan jumlah tanda tanya.

### SELECT dengan get_result

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    try {
        $db = new mysqli('localhost', 'root', '', 'kampus_lanjut');
        $db->set_charset('utf8mb4');
        $id = 5;
        $statement = $db->prepare(
            'SELECT id_inventaris, nama_inventaris, jumlah_inventaris,
                    biaya_inventaris, waktu_pembaruan
             FROM inventaris WHERE id_inventaris = ?'
        );
        $statement->bind_param('i', $id);
        $statement->execute();
        $hasil = $statement->get_result();
        while ($baris = $hasil->fetch_assoc()) {
            echo htmlspecialchars($baris['nama_inventaris'], ENT_QUOTES, 'UTF-8');
        }
        $hasil->free();
        $statement->close();
    } catch (mysqli_sql_exception $error) {
        error_log($error->getMessage());
        echo 'Operasi database gagal.';
    } finally {
        if (isset($db)) {
            $db->close();
        }
    }

Script terkait: 48.mysqli_prepared_select.php dan 49.mysqli_prepared_select_2.php.

Jika dibandingkan dengan query biasa, inti perubahan pada `48.mysqli_prepared_select.php` adalah tiga baris berikut:

    $pernyataan = $databaseMysqli->prepare(
        'SELECT * FROM inventaris WHERE id_inventaris = ?'
    );
    $pernyataan->bind_param('i', $id_inventaris);
    $pernyataan->execute();

Tanda `?` bukan nilai data. Tanda tersebut adalah tempat yang akan diisi melalui `bind_param()`.

### Menggunakan ulang statement

Variabel yang sudah di-bind dapat diberi nilai baru sebelum execute:

    $statement = $db->prepare(
        'SELECT * FROM inventaris WHERE id_inventaris = ?'
    );
    $statement->bind_param('i', $id);
    $id = 2;
    $statement->execute();
    $hasil = $statement->get_result();
    $baris = $hasil->fetch_assoc();
    $hasil->free();
    $id = 4;
    $statement->execute();
    $hasil = $statement->get_result();
    $baris = $hasil->fetch_assoc();
    $hasil->free();
    $statement->close();

Lihat 50.mysqli_prepared_reuse.php.

### Bentuk hasil lain

    $baris = $statement->get_result()->fetch_object();
    echo $baris->nama_inventaris;

Contoh fetch_object dan method chaining ada di 51.mysqli_prepared_fetch_object.php dan 52.mysqli_prepared_method_chaining.php.

Alternatif tanpa get_result:

    $statement->bind_result($idHasil, $nama, $jumlah, $biaya, $waktu);
    while ($statement->fetch()) {
        echo $idHasil . ' | ' . $nama . ' | ' . $jumlah . '<br>';
    }

Contoh ini ada di 54.mysqli_prepared_fetch.php, 55.mysqli_prepared_fetch_2.php, dan 56.mysqli_prepared_fetch_while.php.

### LIKE dan INSERT

Wildcard persen menjadi bagian dari nilai parameter:

    $kataKunci = '%kulkas%';
    $statement = $db->prepare(
        'SELECT * FROM inventaris WHERE nama_inventaris LIKE ?'
    );
    $statement->bind_param('s', $kataKunci);
    $statement->execute();

Contoh INSERT:

    $statement = $db->prepare(
        'INSERT INTO inventaris
            (nama_inventaris, jumlah_inventaris, biaya_inventaris, waktu_pembaruan)
         VALUES (?, ?, ?, ?)'
    );
    $statement->bind_param('siis', $nama, $jumlah, $biaya, $waktu);
    $nama = 'Keyboard Mekanik';
    $jumlah = 10;
    $biaya = 450000;
    $waktu = date('Y-m-d H:i:s');
    $statement->execute();

Lihat 53.mysqli_prepared_select_like.php, 57.mysqli_prepared_insert.php, dan 58.mysqli_prepared_insert_reuse.php.

Pada `57.mysqli_prepared_insert.php`, string tipe `siis` dibaca dari kiri ke kanan:

    $pernyataan->bind_param(
        'siis',
        $nama_inventaris,
        $jumlah_inventaris,
        $biaya_inventaris,
        $waktu_pembaruan
    );

Artinya, nama adalah string, jumlah adalah integer, biaya pada script diperlakukan sebagai integer, dan waktu adalah string. Jika kolom biaya menggunakan pecahan, gunakan tipe `d` dan nilai desimal.

## 8. Transaksi dan Rollback

Transaksi membuat beberapa operasi menjadi satu kesatuan:

    $db->begin_transaction();
    try {
        $db->query('DELETE FROM inventaris WHERE id_inventaris = 2');
        $db->query('DELETE FROM inventaris WHERE id_inventaris = 4');
        $db->commit();
        echo 'Semua perubahan disimpan';
    } catch (Throwable $error) {
        $db->rollback();
        echo 'Perubahan dibatalkan';
    }

Gunakan commit jika semua operasi berhasil dan rollback jika salah satu gagal. Script 59.transaction_rollback.php memperlihatkan kondisi sebelum, selama, dan setelah rollback. Pada aplikasi nyata, query di dalam transaksi juga sebaiknya prepared statement.

Alur pada `59.transaction_rollback.php` adalah:

    $databaseMysqli->begin_transaction();
    // beberapa INSERT, UPDATE, atau DELETE
    $databaseMysqli->rollback();

Untuk menyimpan perubahan, ganti `rollback()` dengan `commit()`. Perhatikan bahwa transaksi hanya bermakna jika operasi dilakukan pada koneksi yang sama.

## 9. Pola Program dan Checklist

Aktifkan exception → buat koneksi dan atur charset → validasi input → prepare → bind_param → execute → ambil result set → escape output → free/close resource.

- [ ] Exception MySQLi diaktifkan.
- [ ] Charset koneksi diatur.
- [ ] Input divalidasi.
- [ ] Nilai input memakai tanda tanya, bukan gabungan string SQL.
- [ ] Kode binding sesuai tipe data.
- [ ] Output HTML memakai htmlspecialchars().
- [ ] Result set, statement, dan koneksi ditutup.
- [ ] Detail error tidak ditampilkan kepada pengguna.
- [ ] Operasi yang saling bergantung memakai transaksi.

## 10. Latihan dan Tugas Praktik

Buat program pencarian inventaris dengan ketentuan:

1. Terima parameter nama melalui GET.
2. Validasi kata kunci minimal dua karakter.
3. Cari dengan LIKE menggunakan prepared statement.
4. Tampilkan ID, nama, jumlah, biaya, dan waktu dalam tabel HTML.
5. Escape seluruh nilai dengan htmlspecialchars().
6. Tampilkan pesan jika hasil kosong.
7. Tangani kesalahan dengan try-catch-finally.

Sebagai tugas, tambahkan form INSERT, validasi jumlah/biaya tidak negatif, pesan sukses/error terkontrol, serta penutupan resource. Update, delete, dan CRUD lengkap dilanjutkan pada Minggu 7.

## 11. Ringkasan

MySQLi Object menyediakan object koneksi dan result set untuk berkomunikasi dengan MySQL. Result set dibaca memakai fetch_assoc, fetch_row, fetch_object, atau fetch_all. Prepared statement memisahkan SQL dari input melalui prepare, bind_param, dan execute. Validasi, output escaping, exception handling, penutupan resource, dan transaksi menjadikan program database lebih aman dan terstruktur.
