<?php
// jalankan init.php (untuk session_start dan autoloader)
require 'init.php';

// halaman tidak bisa diakses langsung, harus ada query string id_inventaris
if(empty(Input::get('id_inventaris'))) {
  die ('Maaf halaman ini tidak bisa diakses langsung');
}

// ambil semua data inventaris yang akan diupdate dari database
$inventaris = new Barang();
$inventaris->generate(Input::get('id_inventaris'));

if (!empty($_POST)) {
  // jika terdeteksi form $_POST di submit, jalankan proses validasi
  $pesanError = $inventaris->validasi($_POST);
  if (empty($pesanError)) {
    // jika tidak ada error, proses update inventaris
    $inventaris->update($inventaris->getItem('id_inventaris'));
    header('Location:tampil_barang.php');
  }
}

// include head
include 'template/header.php';
?>

<!doctype html>

  <div class="container">
    <div class="row">
      <div class="col-6 py-4">
      <h1 class="h2 mr-auto"><a class="text-info" href="edit_barang.php">
        Edit Barang</a></h1>

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

      <!-- Form untuk proses update -->
      <form method="post">

        <div class="form-group">
          <label for="nama_inventaris">ID Barang</label>
          <input type="text" class="form-control" name="nama_inventaris" disabled
          value="<?php echo $inventaris->getItem('id_inventaris'); ?>">
          <small class="d-block">*ID Barang tidak bisa diubah</small>
        </div>

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

        <input type="submit" class="btn btn-primary" value="Update">
        <a href="tampil_barang.php" class="btn btn-secondary">Cancel</a>

      </form>

      </div>
    </div>
  </div>

<?php
// include footer
include 'template/footer.php';
?>
