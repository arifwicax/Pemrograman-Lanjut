<?php
require 'Input.php';

$error = [];

if (!empty($_POST)) {

  function validate($elemen,$labelField,$rules) {
    $nilaiForm = Input::get($elemen);

    // jalankan proses sanitize untuk setiap item (jika disyaratkan)
    if (array_key_exists('sanitize',$rules)) {
      $nilaiForm = Input::runSanitize($nilaiForm,$rules['sanitize']);
    }

    global $error;

    foreach ($rules as $rule => $nilaiAturan) {

      switch($rule) {

        case 'required':
          if ($nilaiAturan === TRUE && empty($nilaiForm)) {
            $error[$elemen] = "$labelField tidak boleh kosong";
          }
        break;

        case 'min_char' :
          if (strlen($nilaiForm) < $nilaiAturan) {
            $error[$elemen] = "$labelField minimal $nilaiAturan karakter";
          }
        break;

        case 'max_char' :
          if (strlen($nilaiForm) > $nilaiAturan) {
            $error[$elemen] = "$labelField maksimal $nilaiAturan karakter";
          }
        break;

        case 'numeric' :
          if ($nilaiAturan === TRUE && !is_numeric($nilaiForm)) {
            $error[$elemen] = "$labelField harus diisi angka";
          }
        break;

        case 'min_value' :
          if ($nilaiForm < $nilaiAturan) {
            $error[$elemen] = "$labelField minimal $nilaiAturan";
          }
        break;

        case 'max_value' :
          if ($nilaiForm > $nilaiAturan) {
            $error[$elemen] = "$labelField maksimal $nilaiAturan";
          }
        break;

      }

      // cek jika sudah ada error di item yang sama, langsung keluar dari looping
      if (!empty($error[$elemen])) {
        break;
      }

    }
    // kembalikan nilai yang sudah lewat proses sanitize
    return $nilaiForm;
  }

  $nama_inventaris = validate('nama_inventaris','Nama inventaris', [
    'sanitize' => 'string',
    'required' => true,
    'min_char' => 5,
  ]);

  $jumlah_inventaris = validate('jumlah_inventaris','Jumlah inventaris', [
    'required' => true,
    'numeric' => true,
    'min_value' => 0,
    'max_value' => 110,
  ]);

  $biaya_inventaris = validate('biaya_inventaris','Harga inventaris', [
    'required' => true,
    'numeric' => true,
    'min_value' => 0,
  ]);

  echo '<pre>';
  print_r($error);
  echo '</pre>';

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
