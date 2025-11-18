<?php

include("connection.php");

if(isset($_POST['edit'])){

        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telepon = $_POST['no_tlp'];
    $password = $_POST['password'];


    $query = "UPDATE tb_crud SET ";
    $query .= "nama = '$nama', email = '$email', no_telp = '$telepon',";
    $query .= "password = '$password' WHERE id = '$id'";
    $result = mysqli_query($link, $query);
    if(!$result){
        die ("Query Error : ".mysqli_errno($link).
        " - ".mysqli_error($link));
    }
    else{
        //echo "Tabel 'tb_crud' berhasil diedit..";
        header('Location: tampil.php');
    }

}

?>

<?php

$id = $_GET['id_edit'];
$query = "SELECT * FROM tb_crud WHERE id=$id";
$result = mysqli_query($link, $query);
$row = mysqli_fetch_assoc($result);
$nama = $row['nama'];
$email = $row['email'];
$telepon = $row['no_telp'];
$password = $row['password'];

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <div class="container">

        <form action="edit.php" method="POST">
            <div class="mb-3">
                <label for="exampleInputNama1" class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" id="exampleInputNama1"
                placeholder="Enter Your Name" value="<?php echo $nama ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                placeholder="Enter Your Email" value="<?php echo $email ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputTlp1" class="form-label">Nomor Telepon</label>
                <input type="text" name="no_tlp" class="form-control" id="exampleInputTlp1"
                placeholder="Enter Your Number Telepon" value="<?php echo $telepon ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputPass1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPass1"
                placeholder="Enter Your Password" value="<?php echo $password ?>">
            </div>
            <td><input type="hidden" name="id" value="<?php echo $_GET['id_edit']; ?>"></td>
            <button type="submit" name="edit" class="btn btn-primary">Edit</button>
        </form>

    </div>
</body>

</html>