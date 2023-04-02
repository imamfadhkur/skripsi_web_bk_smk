<?php
$url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
if (strpos($url, "guru") || strpos($url, "admin") || strpos($url, "siswa")) {
  ?>
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <script src="../assets/js/bootstrap.min.js"></script>
  <script src="../assets/js/bootstrap.bundle.min.js"></script>
  <?php
}
else {
  ?>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <?php
}
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

<nav class="navbar navbar-expand-lg bg-light px-5 navbar-light border-bottom d-print-none" style="z-index: 20">
  <div class="container-fluid d-print-none">
    <div class="collapse navbar-collapse d-print-none" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <img src="/desi/assets/img/header_smkn2bkl.png" alt="smkn 2 bkl" width="25%">
      </ul>
      <ul class="navbar-nav ms-auto">
        <?php
        if (isset($_SESSION["username"])) {
          if (isset($_SESSION["guru"])) {
          ?>
          <li class="nav-item">
              <p class="nav-link">Hello, <?php echo $_SESSION["guru"]["nama"] ?></p>
          </li>
      <li class="nav-item border-start">
          <?php
          }
          elseif (isset($_SESSION["admin"])) {
            ?>
            <li class="nav-item">
                <p class="nav-link">Hello, <?php echo $_SESSION["admin"]["nama"] ?></p>
            </li>
        <li class="nav-item border-start">
            <?php
            }
          else {
            ?>
            <li class="nav-item">
                <p class="nav-link">Hello, <?php echo $_SESSION["siswa"]["nama"] ?></p>
            </li>
        <li class="nav-item border-start">
            <?php
          }
        }
        else {
          ?>
          <li class="nav-item border-start">
              <a class="nav-link" href="#">0821xxxxxx</a>
          </li>
          <li class="nav-item border-start">
              <a class="nav-link" href="#">example@gmail.com</a>
          </li>
          <li class="nav-item border-start">
            <?php
        }
          if (isset($_SESSION["guru"]) || isset($_SESSION["admin"]) || isset($_SESSION["siswa"])) {
              ?>
              <form action="../logout.php" method="POST">
                <input class="nav-link" type="submit" value="logout" name="logout" onclick="return confirm('Yakin ingin keluar?')">
              </form>
              <?php
          }
          else {
            if (strpos($url, "guru") || strpos($url, "admin") || strpos($url, "siswa")) {
              echo '<a class="nav-link" href="../login.php">login</a>';
            }
            else {
              echo '<a class="nav-link" href="login.php">login</a>';
            }
          }
          ?>
        </li>
      </ul>
    </div>
  </div>
</nav>

<nav class="navbar sticky-top navbar-dark border-bottom bg-primary navbar-expand-lg mx-6 my-6 px-3 d-print-none" style="z-index: 10">
  <div class="container-fluid mx-5 d-print-none">
    <?php
    $query = "SELECT nama_website FROM settings";
    $result = $con_mysqli->query($query);
    $row = $result->fetch_assoc();
    $nama_web = $row["nama_website"];

    if (isset($_SESSION["guru"])) {
      echo '<a class="navbar-brand fs-5" href="/desi/guru/index.php">'.$nama_web.'</a>';
    }
    elseif (isset($_SESSION["siswa"])) {
      echo '<a class="navbar-brand fs-5" href="/desi/siswa/index.php">'.$nama_web.'</a>';
    }
    elseif (isset($_SESSION["admin"])) {
      echo '<a class="navbar-brand fs-5" href="/desi/admin/index.php">'.$nama_web.'</a>';
    }
    else {
      echo '<a class="navbar-brand fs-5" href="/desi/index.php">'.$nama_web.'</a>';
    }
    ?>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse flex-grow-1 text-right mx-4" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <?php
          if (isset($_SESSION["admin"])) {
            ?>
              <li class="nav-item">
                  <a class="nav-link active" href="/desi/admin/index.php">Dashboard</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link active" href="/desi/admin/data.php">Data</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link active" href="/desi/admin/pelanggaran.php">Pelanggaran</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link active" href="/desi/admin/user.php">User</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link active" href="/desi/admin/settings.php">Settings</a>
              </li>
              <?php

          }
          elseif (isset($_SESSION["siswa"])) {
            ?>
            <li class="nav-item">
              <a class="nav-link active" href="/desi/siswa/index.php">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="/desi/pengumuman.php">Pengumuman</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="/desi/siswa/konsultasi.php">Konsultasi</a>
            </li>
            <?php
          }
          elseif (isset($_SESSION["guru"])) {
            ?>
            <li class="nav-item">
              <a class="nav-link active" href="/desi/guru/index.php">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="/desi/pengumuman.php">Pengumuman</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="/desi/guru/konsultasi.php">Konsultasi</a>
            </li>
            <?php
          }
          else {
            ?>
            <li class="nav-item">
              <a class="nav-link active" href="/desi/index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="/desi/pengumuman.php">Pengumuman</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="/desi/profil.php">Profil</a>
            </li>
            <?php
          }
        ?>
      </ul>
    </div>
  </div>
</nav>