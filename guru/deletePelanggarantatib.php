<?php
include "../koneksi.php";
session_start();
if (!isset($_SESSION["guru"])) {
    header('Location: /desi/login.php');
    exit();
}

if (isset($_GET["nama"])) {
  $sql1 = "DELETE FROM tata_tertib WHERE jenis_tatib = ".$_GET["nama"];
  $result1 = mysqli_query($con_mysqli, $sql1);
  header('Location: /desi/guru/pelanggaran.php?pesanSuccess=Data%20berhasil%20di%20hapus&runFunction=getPelanggarantatib');
  exit();
}
else {
  header('Location: /desi/guru/pelanggaran.php');
  exit();
}
?>