<?php
include "../koneksi.php";
session_start();
if (!isset($_SESSION["admin"])) {
    header('Location: /desi/login.php');
    exit();
}

if (isset($_GET["singkatan"])) {
  $sql1 = "DELETE FROM jurusan WHERE singkatan = ".$_GET["singkatan"];
  $result1 = mysqli_query($con_mysqli, $sql1);
  header('Location: /desi/admin/data.php?pesanSuccess=Data%20berhasil%20di%20hapus&runFunction=getDataJurusan');
  exit();
}
?>