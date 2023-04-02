<?php
include "../koneksi.php";
session_start();
if (!isset($_SESSION["guru"])) {
    header('Location: /desi/login.php');
    exit();
}

if (isset($_GET["nisn"])) {
  $sql1 = "DELETE FROM siswa WHERE nisn = ".$_GET["nisn"];
  $sql2 = "DELETE FROM user WHERE username = ".$_GET["nisn"];
  $result1 = mysqli_query($con_mysqli, $sql1);
  $result2 = mysqli_query($con_mysqli, $sql2);
  header('Location: /desi/guru/data.php?pesanSuccess=Data%20berhasil%20di%20hapus&runFunction=getDataSiswa');
  exit();
}
?>