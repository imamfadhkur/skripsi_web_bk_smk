<?php
include "../koneksi.php";
session_start();
if (!isset($_SESSION["admin"])) {
    header('Location: /desi/login.php');
    exit();
}

if (isset($_GET["nama"])) {
  $sql1 = "DELETE FROM kelas WHERE nama = ".$_GET["nama"];
  $result1 = mysqli_query($con_mysqli, $sql1);
  header('Location: /desi/admin/data.php?pesanSuccess=Data%20berhasil%20di%20hapus&runFunction=getDataKelas');
  exit();
}
else {
  header('Location: /desi/admin/data.php');
  exit();
}
?>