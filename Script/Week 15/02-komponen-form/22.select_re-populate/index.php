<?php
require 'Input.php';
require 'Validate.php';

$error = [];

if (!empty($_POST)) {

  $validate = new Validate($_POST);

  $rd_framework = $validate->setRules('sl_framework','Framework', [
    'sanitize' => 'string',
    'required' => true,
    'regexp' => '/^Code Igniter|Laravel|Symfony|Zend$/',
  ]);

  print_r($_POST);

  if($validate->passed()) {
    echo "<p> Lolos Validasi!</p>";
  } else {
    $error = $validate->getError();
  }

}

// Untuk proses re-populate

$select_code_igniter = Input::get('sl_framework')==='Code Igniter'? 'selected' : '';
$select_laravel = Input::get('sl_framework')==='Laravel'? 'selected' : '';
$select_symfony = Input::get('sl_framework')==='Symfony'? 'selected' : '';
$select_zend = Input::get('sl_framework')==='Zend'? 'selected' : '';

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
          <select name="sl_framework">
            <option value="Code Igniter" <?php echo $select_code_igniter ?>>Code Igniter</option>
            <option value="Laravel" <?php echo $select_laravel ?>>Laravel</option>
            <option value="Symfony" <?php echo $select_symfony ?>>Symfony</option>
            <option value="Zend" <?php echo $select_zend ?>>Zend</option>
          </select>
        </div>
        <div>
          <input type="submit" value="Submit" name="submit">
        </div>
      </form>
    </div>
  </body>
</html>
