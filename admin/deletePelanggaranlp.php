<?php
include "../koneksi.php";
session_start();
if (!isset($_SESSION["admin"])) {
    header('Location: /desi/login.php');
    exit();
}

if (isset($_GET["lp"])) {
  $sql1 = "DELETE FROM list_pelanggaran WHERE id = ".$_GET["lp"];
  $result1 = mysqli_query($con_mysqli, $sql1);
  header('Location: /desi/admin/pelanggaran.php?pesanSuccess=Data%20berhasil%20di%20hapus&runFunction=getPelanggaranlp');
  exit();
}
else {
  header('Location: /desi/admin/pelanggaran.php');
  exit();
}
?>