<?php
require 'Input.php';
require 'Validate.php';

$error = [];

if (!empty($_POST)) {

  $validate = new Validate($_POST);

  $cb_code_igniter = $validate->setRules('cb_code_igniter','Code Igniter', [
    'required' => true,
  ]);

  print_r($_POST);

  if($validate->passed()) {
    echo "<p> Lolos Validasi!</p>";
  } else {
    $error = $validate->getError();
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
          <div>
            <label><input type="checkbox" name="cb_code_igniter"
              value="Code Igniter">Code Igniter</label>
          </div>
          <div>
            <label><input type="checkbox" name="cb_laravel"
              value="Laravel">Laravel</label>
          </div>
          <div>
            <label><input type="checkbox" name="cb_symfony"
              value="Symfony">Symfony</label>
          </div>
          <div>
            <label><input type="checkbox" name="cb_zend"
              value="Zend">Zend</label>
          </div>
        </div>
        <div>
          <input type="submit" value="Submit">
        </div>
      </form>
    </div>
  </body>
</html>
