<?php
session_start();
if (isset($_POST["logout"])) {

  unset($_SESSION["username"]);
  unset($_SESSION["level"]);
  
  if (isset($_SESSION["guru"])) {
    unset($_SESSION["guru"]);
  }
  elseif ($_SESSION["admin"]) {
    unset($_SESSION["admin"]);
  }
  else {
    unset($_SESSION["siswa"]);
  }
  // exit();
  header('Location: /desi/index.php');
  exit();
}