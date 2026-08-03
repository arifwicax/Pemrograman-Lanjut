<?php
// jalankan init.php (untuk session_start dan autoloader)
require 'init.php';

// buat koneksi ke database
$DB = DB::getInstance();

if (!empty($_GET)) {
  // jika terdeteksi form di submit, tampilkan hasil pencarian
  $tabelBarang = $DB->getLike(
    'inventaris',
    'nama_inventaris',
    '%' . Input::get('search') . "%"
  );
} else {
  // jika form tidak di submit, ambil semua isi tabel inventaris
  $tabelBarang = $DB->get('inventaris');
}

// include head
include 'template/header.php';
?>

<div class="container">
  <div class="row">
    <div class="col-12">

      <!-- Form pencarian -->
      <div class="py-4 d-flex justify-content-end align-items-center">
        <h1 class="h2 mr-auto">
          <a class="text-info" href="tampil_barang.php">Tabel Barang</a>
        </h1>
        <a href="tambah_barang.php" class="btn btn-primary">Tambah Barang</a>
        <form class="w-25 ml-4" method="get">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="search"
              name="search">
            <div class="input-group-append">
              <input type="submit" class="btn btn-outline-secondary"
                value="Cari">
            </div>
          </div>
        </form>
      </div>

      <!-- Tabel inventaris -->
      <?php
      if (!empty($tabelBarang)) :
      ?>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nama Barang</th>
              <th>Jumlah</th>
              <th>Harga (Rp.)</th>
              <th>Tanggal Update</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($tabelBarang as $inventaris) {
              echo "<tr>";
              echo "<th>{$inventaris->id_inventaris}</th>";
              echo "<td>{$inventaris->nama_inventaris}</td>";
              echo "<td>{$inventaris->jumlah_inventaris}</td>";
              echo "<td>" . number_format($inventaris->biaya_inventaris, 0, ',', '.') . "</td>";

              // Periksa apakah waktu_pembaruan memiliki nilai valid
              if (!empty($inventaris->waktu_pembaruan)) {
                try {
                  $tanggal = new DateTime($inventaris->waktu_pembaruan);
                  echo "<td>" . $tanggal->format("d-m-Y H:i") . "</td>";
                } catch (Exception $e) {
                  // Jika terjadi error, tampilkan pesan default
                  echo "<td>Tanggal tidak valid</td>";
                }
              } else {
                // Jika waktu_pembaruan kosong, tampilkan nilai default
                echo "<td>Tanggal tidak tersedia</td>";
              }

              echo "<td>";
              echo "<a href=\"edit_barang.php?id_inventaris={$inventaris->id_inventaris}\" class=\"btn btn-info\">Edit</a> ";
              echo "<a href=\"hapus_barang.php?id_inventaris={$inventaris->id_inventaris}\" class=\"btn btn-danger\">Hapus</a>";
              echo "</td>";
              echo "</tr>";
            }
            ?>

          </tbody>
        </table>

      <?php
      endif;
      ?>

    </div>
  </div>
</div>

<?php
// include footer
include 'template/footer.php';
?>