<?php
include "../koneksi.php";
session_start();
if (!isset($_SESSION["admin"])) {
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
    <title>pelanggaran | admin</title>
    <link rel="stylesheet" href="../assets/css/sidebar.css">
</head>
<body>
    <?php include "../navbar.php" ?>
    <div class="row">
        <div class="col-2">
<div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark">
    <a href="/desi/admin/pelanggaran.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
      <span class="fs-4">PELANGGARAN</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li><a href="#" id="guru" class="nav-link text-white">Kategori Pelanggaran</a></li>
      <li><a href="#" id="jurusan" class="nav-link text-white">Tata Tertib</a></li>
      <li><a href="#" id="kelas" class="nav-link text-white">List Pelanggaran</a></li>
      <li><a href="#" id="siswa" class="nav-link text-white">Rekap Pelanggaran</a></li>
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
    const btnGuru = document.getElementById("guru");
    const btnJurusan = document.getElementById("jurusan");
    const btnKelas = document.getElementById("kelas");
    const btnSiswa = document.getElementById("siswa");

    function loadDataGuru() {
        btnGuru.classList.add("active");
        fetch("/desi/admin/data_guru.php")
        .then(response => response.text())
        .then(data => {
            document.getElementById("my-data").innerHTML = data;
        });
        btnJurusan.classList.remove("active");
        btnKelas.classList.remove("active");
        btnSiswa.classList.remove("active");
    }
    function loadDataJurusan() {
        btnJurusan.classList.add("active");
        fetch("/desi/admin/data_jurusan.php")
        .then(response => response.text())
        .then(data => {
            document.getElementById("my-data").innerHTML = data;
        });
        btnGuru.classList.remove("active");
        btnKelas.classList.remove("active");
        btnSiswa.classList.remove("active");
    }
    function loadDataKelas() {
        btnKelas.classList.add("active");
        fetch("/desi/admin/data_kelas.php")
        .then(response => response.text())
        .then(data => {
            document.getElementById("my-data").innerHTML = data;
        });
        btnGuru.classList.remove("active");
        btnJurusan.classList.remove("active");
        btnSiswa.classList.remove("active");
    }
    function loadDataSiswa() {
        btnSiswa.classList.add("active");
        fetch("/desi/admin/data_siswa.php")
        .then(response => response.text())
        .then(data => {
            document.getElementById("my-data").innerHTML = data;
        });
        btnGuru.classList.remove("active");
        btnJurusan.classList.remove("active");
        btnKelas.classList.remove("active");
    }

    btnGuru.addEventListener("click", loadDataGuru);
    btnJurusan.addEventListener("click", loadDataJurusan);
    btnKelas.addEventListener("click", loadDataKelas);
    btnSiswa.addEventListener("click", loadDataSiswa);

    // ambil nilai parameter runFunction dari URL
    const urlParams = new URLSearchParams(window.location.search);
    const runFunction = urlParams.get('runFunction');
    // jalankan fungsi yang diinginkan berdasarkan nilai parameter runFunction
    if (runFunction === 'getDataGuru') {
      loadDataGuru();
    } else if (runFunction === 'getDataJurusan') {
      loadDataJurusan();
    } else if (runFunction === 'getDataKelas') {
      loadDataKelas();
    } else if (runFunction === 'getDataSiswa') {
      loadDataSiswa();
    } else {
      // tidak ada parameter runFunction atau nilai yang tidak valid
      // tidak melakukan apa-apa
    }
  </script>
</body>
</html>