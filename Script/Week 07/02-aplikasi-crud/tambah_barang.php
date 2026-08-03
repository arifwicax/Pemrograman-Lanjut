<?php
// jalankan init.php (untuk session_start dan autoloader)
require 'init.php';

// buat object inventaris yang akan dipakai untuk proses input
$inventaris = new Barang();

if (!empty($_POST)) {
  // jika terdeteksi form di submit, jalankan proses validasi
  $pesanError = $inventaris->validasi($_POST);
  if (empty($pesanError)) {
    // jika tidak ada error, proses insert inventaris
    $inventaris->insert();
    header('Location:tampil_barang.php');
  }
}

// include head
include 'template/header.php';
?>

  <div class="container">
    <div class="row">
      <div class="col-6 py-4">
      <h1 class="h2 mr-auto"><a class="text-info" href="tambah_barang.php">
        Tambah Barang</a></h1>

      <?php
        // jika ada error, tampilkan pesan error
        if (!empty($pesanError)):
      ?>

      <div id="divPesanError">
        <div class="mx-auto">
          <div class="alert alert-danger" role="alert">
            <ul class="mb-0">
            <?php
             foreach ($pesanError as $pesan) {
               echo "<li>$pesan</li>";
             }
            ?>
            </ul>
          </div>
        </div>
      </div>

      <?php
        endif;
      ?>

      <!-- Form untuk proses insert -->
      <form method="post">
        <div class="form-group">
          <label for="nama_inventaris">Nama Barang</label>
          <input type="text" class="form-control" name="nama_inventaris"
          value="<?php echo $inventaris->getItem('nama_inventaris'); ?>">
        </div>
        <div class="form-group">
          <label for="jumlah_inventaris">Jumlah</label>
          <input type="text" class="form-control" name="jumlah_inventaris"
          value="<?php echo $inventaris->getItem('jumlah_inventaris'); ?>">
        </div>
        <div class="form-group">
          <label for="biaya_inventaris">Harga</label>
          <input type="text" class="form-control" name="biaya_inventaris"
          value="<?php echo $inventaris->getItem('biaya_inventaris'); ?>">
        </div>
        <input type="submit" class="btn btn-primary" value="Tambah">
      </form>

      </div>
    </div>
  </div>

<?php
// include footer
include 'template/footer.php';
?>
