<?php
require 'Input.php';

$error = [];

if (!empty($_POST)) {

  function check_required($elemen, $labelField){
    $nilaiForm = Input::get($elemen);

    global $error;
    if (empty($nilaiForm)) {
      $error[] = "$labelField tidak boleh kosong";
    }
  }

  function check_min_char($elemen, $labelField, $nilaiAturan){
    $nilaiForm = Input::get($elemen);

    global $error;
    if (strlen($nilaiForm) < $nilaiAturan) {
      $error[] = "$labelField minimal $nilaiAturan karakter";
    }
  }

  function check_numeric($elemen, $labelField){
    $nilaiForm = Input::get($elemen);

    global $error;
    if (!is_numeric($nilaiForm)) {
      $error[] = "$labelField harus diisi angka";
    }
  }

  check_required('nama_inventaris','Nama inventaris');
  check_required('jumlah_inventaris','Jumlah inventaris');
  check_required('biaya_inventaris','Harga inventaris');

  check_min_char('nama_inventaris','Nama inventaris',5);

  check_numeric('jumlah_inventaris','Jumlah inventaris');
  check_numeric('biaya_inventaris','Harga inventaris');
}

?>
<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <title>Validation Class</title>
  </head>
  <style>
    .container {
      margin: 20px auto;
      width: 500px;
    }
    form > div {
      margin: 15px 0;
    }
    label {
      display:inline-block;
      width:100px;
    }
  </style>
  <body>
    <div class="container">
    <h2>Tambah Barang</h2>
    <div class="pesan-error">
      <ul>
        <?php
          foreach ($error as $nilai) {
            echo "<li>$nilai</li>";
          }
        ?>
      </ul>
    </div>
      <form method="post">
        <div>
          <label for="nama_inventaris">Nama Barang</label>
          <input type="text" name="nama_inventaris" value="<?php echo Input::get('nama_inventaris') ?>">
        </div>
        <div>
          <label for="jumlah_inventaris">Jumlah</label>
          <input type="text" name="jumlah_inventaris" value="<?php echo Input::get('jumlah_inventaris') ?>">
        </div>
        <div>
          <label for="biaya_inventaris">Harga</label>
          <input type="text" name="biaya_inventaris" value="<?php echo Input::get('biaya_inventaris') ?>">
        </div>
        <div>
          <input type="submit" value="Submit">
        </div>
      </form>
    </div>
  </body>
</html>
