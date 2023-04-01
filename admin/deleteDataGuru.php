<?php
include "../koneksi.php";
session_start();
if (!isset($_SESSION["admin"])) {
    header('Location: /desi/login.php');
    exit();
}

if (isset($_GET["nip"])) {
  $sql1 = "DELETE FROM guru WHERE nip = ".$_GET["nip"];
  $sql2 = "DELETE FROM user WHERE username = ".$_GET["nip"];
  $result1 = mysqli_query($con_mysqli, $sql1);
  $result2 = mysqli_query($con_mysqli, $sql2);
  header('Location: /desi/admin/data.php?pesanSuccess=Data%20berhasil%20di%20hapus&runFunction=getDataGuru');
  exit();
}
?>