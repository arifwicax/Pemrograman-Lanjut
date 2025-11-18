<?php
  session_start();
  // hapus session
  unset($_SESSION["nama"]);

  // redirect ke halaman login.php
  header("Location: login.php");
?>