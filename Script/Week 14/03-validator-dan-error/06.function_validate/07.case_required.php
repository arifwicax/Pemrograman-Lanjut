<?php
require 'Input.php';

$error = [];

if (!empty($_POST)) {

  function validate($elemen,$labelField,$rules) {
    $nilaiForm = Input::get($elemen);
    global $error;

    foreach ($rules as $rule => $nilaiAturan) {

      switch($rule) {
        case 'required':
          if ($nilaiAturan === TRUE && empty($nilaiForm)) {
            $error[$elemen] = "$labelField tidak boleh kosong";
          }
        break;
      }

    }
  }

  validate('nama_inventaris','Nama inventaris', [
    'required' => true,
    'min_char' => 5
  ]);

  validate('jumlah_inventaris','Jumlah inventaris', [
    'required' => true,
    'numeric' => true,
  ]);

  validate('biaya_inventaris','Harga inventaris', [
    'required' => true,
    'numeric' => true,
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
