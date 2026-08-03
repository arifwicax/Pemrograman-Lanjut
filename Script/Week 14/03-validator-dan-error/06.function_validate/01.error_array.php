<?php
require 'Input.php';

$error = [];

if (!empty($_POST)) {

  if(empty(Input::get('nama_inventaris'))) {
    $error[] = "Nama inventaris tidak boleh kosong";
  }

  if(empty(Input::get('jumlah_inventaris'))) {
    $error[] = "Jumlah inventaris tidak boleh kosong";
  }

  if(empty(Input::get('biaya_inventaris'))) {
    $error[] = "Harga inventaris tidak boleh kosong";
  }

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
