<?php
include "../koneksi.php";
session_start();
if (!isset($_SESSION["guru"])) {
    header('Location: /desi/login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pelanggaran | guru</title>
    <link rel="stylesheet" href="../assets/css/sidebar.css">
</head>
<body>
    <?php include "../navbar.php" ?>
    <div class="row">
        <div class="col-2">
<div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark d-print-none">
    <a href="/desi/guru/pelanggaran.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
      <span class="fs-4 d-print-none">PELANGGARAN</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li><a href="#" id="kp" class="nav-link text-white">Kategori Pelanggaran</a></li>
      <li><a href="#" id="tatib" class="nav-link text-white">Tata Tertib</a></li>
      <li><a href="#" id="lp" class="nav-link text-white">List Pelanggaran</a></li>
    </ul>
</div>
        </div>
        <div class="col-10">
        <?php 
        if (isset($_GET["pesanSuccess"])) {
            echo '<div class="p-3 mt-3 text-primary-emphasis bg-success-subtle border border-success-subtle rounded-3">';
            echo $_GET["pesanSuccess"];
            echo '</div>';
        }
        elseif (isset($_GET["pesanGagal"])) {
            echo '<div class="p-3 mt-3 text-danger-emphasis bg-danger-subtle border border-danger-subtle rounded-3">';
            echo $_GET["pesanGagal"];
            echo '</div>';
        }
        ?>
            <div id="my-data"></div>
        </div>
    </div>
  <script src="../assets/js/sidebar.js"></script>
  <script>
    // Mengambil referensi tombol dan elemen yang ingin diubah atribut CSS-nya
    const btnkp = document.getElementById("kp");
    const btntatib = document.getElementById("tatib");
    const btnlp = document.getElementById("lp");

    function loadPelanggarankp() {
        btnkp.classList.add("active");
        fetch("/desi/guru/pelanggaran_kp.php")
        .then(response => response.text())
        .then(data => {
            document.getElementById("my-data").innerHTML = data;
        });
        btntatib.classList.remove("active");
        btnlp.classList.remove("active");
    }
    function loadPelanggarantatib() {
        btntatib.classList.add("active");
        fetch("/desi/guru/pelanggaran_tatib.php")
        .then(response => response.text())
        .then(data => {
            document.getElementById("my-data").innerHTML = data;
        });
        btnkp.classList.remove("active");
        btnlp.classList.remove("active");
    }
    function loadPelanggaranlp() {
        btnlp.classList.add("active");
        fetch("/desi/guru/pelanggaran_lp.php")
        .then(response => response.text())
        .then(data => {
            document.getElementById("my-data").innerHTML = data;
        });
        btnkp.classList.remove("active");
        btntatib.classList.remove("active");
    }

    btnkp.addEventListener("click", loadPelanggarankp);
    btntatib.addEventListener("click", loadPelanggarantatib);
    btnlp.addEventListener("click", loadPelanggaranlp);

    // ambil nilai parameter runFunction dari URL
    const urlParams = new URLSearchParams(window.location.search);
    const runFunction = urlParams.get('runFunction');
    // jalankan fungsi yang diinginkan berdasarkan nilai parameter runFunction
    if (runFunction === 'getPelanggarankp') {
      loadPelanggarankp();
    } else if (runFunction === 'getPelanggarantatib') {
      loadPelanggarantatib();
    } else if (runFunction === 'getPelanggaranlp') {
      loadPelanggaranlp();
    } else {
      // tidak ada parameter runFunction atau nilai yang tidak valid
      // tidak melakukan apa-apa
    }
  </script>
</body>
</html>