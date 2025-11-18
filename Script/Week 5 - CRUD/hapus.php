<?php
include("connection.php");

if(isset($_GET['id_hapus'])){
    $id_hapus = $_GET['id_hapus'];

    $query = "DELETE FROM tb_crud WHERE id=$id_hapus";
    $result = mysqli_query($link, $query);
    if(!$result){
        die ("Query Error : ".mysqli_errno($link).
        " - ".mysqli_error($link));
    }
    else{
        // echo "Data tb_crud berhasil dihapus";
        header('Location: tampil.php');
    }
}


?>