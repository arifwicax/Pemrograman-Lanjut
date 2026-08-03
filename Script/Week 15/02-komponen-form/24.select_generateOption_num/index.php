<?php
require 'Input.php';
require 'Validate.php';

$error = [];

if (!empty($_POST)) {

  $validate = new Validate($_POST);

  $rd_framework = $validate->setRules('sl_tahun','Pilihan Tahun', [
    'sanitize' => 'string',
    'required' => true,
  ]);

  print_r($_POST);

  if($validate->passed()) {
    echo "<p> Lolos Validasi!</p>";
  } else {
    $error = $validate->getError();
  }

}

// Untuk proses re-populate

// generate <option>
for ($i=2000;$i<=2020;$i++) {
  $pilihanTahun[] = $i;
}

$optionTahun = Input::generateOption($pilihanTahun,Input::get('sl_tahun'));
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
      width:130px;
      margin: 5px 0 0 0;
    }
  </style>
  <body>
    <div class="container">
    <h2>Framework PHP Favorit</h2>
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
          <label>Pilihan Anda :</label>
          <select name="sl_tahun">
            <?php echo $optionTahun; ?>
          </select>
        </div>
        <div>
          <input type="submit" value="Submit" name="submit">
        </div>
      </form>
    </div>
  </body>
</html>
