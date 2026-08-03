<?php
require 'Input.php';
require 'Validate.php';

$error = [];

if (!empty($_POST)) {

  $validate = new Validate($_POST);

  $nama_inventaris = $validate->setRules('nama_inventaris','Nama inventaris', [
    'sanitize' => 'string',
    'required' => true,
    'min_char' => 5,
  ]);

  $jumlah_inventaris = $validate->setRules('jumlah_inventaris','Jumlah inventaris', [
    'required' => true,
    'numeric' => true,
    'min_value' => 0,
    'max_value' => 110,
  ]);

  $biaya_inventaris = $validate->setRules('biaya_inventaris','Harga inventaris', [
    'required' => true,
    'numeric' => true,
    'min_value' => 0,
  ]);

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
          <input type="text" name="nama_inventaris" value="<?php if (isset($nama_inventaris)) { echo $nama_inventaris; } ?>">
        </div>
        <div>
          <label for="jumlah_inventaris">Jumlah</label>
          <input type="text" name="jumlah_inventaris" value="<?php if (isset($jumlah_inventaris)) { echo $jumlah_inventaris; } ?>">
        </div>
        <div>
          <label for="biaya_inventaris">Harga</label>
          <input type="text" name="biaya_inventaris" value="<?php if (isset($biaya_inventaris)) { echo $biaya_inventaris; } ?>">
        </div>
        <div>
          <input type="submit" value="Submit">
        </div>
      </form>
    </div>
  </body>
</html>
