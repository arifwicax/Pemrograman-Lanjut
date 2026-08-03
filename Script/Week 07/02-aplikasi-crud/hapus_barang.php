<?php
// jalankan init.php (untuk session_start dan autoloader)
require 'init.php';

// halaman tidak bisa diakses langsung, harus ada query string id_inventaris
if(empty(Input::get('id_inventaris'))) {
  die ('Maaf halaman ini tidak bisa diakses langsung');
}

//ambil data inventaris yang akan dihapus
$inventaris = new Barang();
$inventaris->generate(Input::get('id_inventaris'));

if (!empty($_POST)) {
  // jika terdeteksi form di submit, hapus inventaris berdasarkan nilai id_inventaris
  $inventaris->delete(Input::get('id_inventaris'));
  header('Location:tampil_barang.php');
}

// include head
include 'template/header.php';
?>

  <div class="container">
    <div class="row">
      <div class="col-6 mx-auto">

      <!-- Modal Untuk Konfirmasi Hapus -->
      <div id="modalHapus">
        <div class="modal-dialog modal-confirm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Konfirmasi</h4>
            </div>
            <div class="modal-body">
              <p> Apakah anda yakin akan menghapus
                <b><?php echo $inventaris->getItem('nama_inventaris'); ?>?</b></p>
            </div>
            <div class="modal-footer">
            <a href="tampil_barang.php" class="btn btn-secondary">Tidak</a>

            <form method="post">
              <input type="hidden" name="id_inventaris"
               value="<?php echo $inventaris->getItem('id_inventaris'); ?>">
              <input type="submit" class="btn btn-danger" value="Ya">
            </form>

            </div>
          </div>
        </div>
      </div>

      </div>
    </div>
  </div>

<?php
// include footer
include 'template/footer.php';
?>
