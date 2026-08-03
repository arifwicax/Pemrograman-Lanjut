<?php
require 'Input.php';
require 'Validate.php';

$error = [];

if (!empty($_POST)) {

  $validate = new Validate($_POST);

  $rd_framework = $validate->setRules('rd_framework','Framework', [
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

$check_code_igniter = Input::get('rd_framework')==='Code Igniter'? 'checked' : '';
$check_laravel = Input::get('rd_framework')==='Laravel'? 'checked' : '';
$check_symfony = Input::get('rd_framework')==='Symfony'? 'checked' : '';
$check_zend = Input::get('rd_framework')==='Zend'? 'checked' : '';

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
            <label><input type="radio" name="rd_framework" value="Code Igniter"
              <?php echo $check_code_igniter; ?> >Code Igniter</label>
          </div>
          <div>
            <label><input type="radio" name="rd_framework" value="Laravel"
              <?php echo $check_laravel; ?>>Laravel</label>
          </div>
          <div>
            <label><input type="radio" name="rd_framework" value="Symfony"
              <?php echo $check_symfony; ?>>Symfony</label>
          </div>
          <div>
            <label><input type="radio" name="rd_framework" value="Zend"
              <?php echo $check_zend; ?>>Zend</label>
          </div>
        </div>
        <div>
          <input type="submit" value="Submit" name="submit">
        </div>
      </form>
    </div>
  </body>
</html>
