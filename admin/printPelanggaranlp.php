<?php
include "../koneksi.php";
session_start();
if (!isset($_SESSION["admin"])) {
    header('Location: /desi/login.php');
    exit();
}

if (isset($_GET["siswa"])) {

    $query = "SELECT * FROM settings";
    $result = $con_mysqli->query($query);
    $row = $result->fetch_assoc();
    $aturan_poin = $row["total_poin"];
    $nama_website = $row["nama_website"];
    
    
    $nisn = $_GET['siswa'];
    $query1 = "SELECT * FROM siswa WHERE nisn = ".$nisn;
    $result1 = $con_mysqli->query($query1);
    $data_siswa = $result1->fetch_assoc();
    

    // panggil query untuk menampilkan total poin dari view database
    $query = "SELECT total_poin FROM view_total_poin_siswa WHERE nisn_siswa = ".$nisn;
    $result = $con_mysqli->query($query);

    // jika query berhasil dieksekusi, tampilkan hasilnya
    if ($result) {
      $row = $result->fetch_assoc();
      $total_poin = $row['total_poin'];
    } else {
      echo "Terjadi kesalahan saat menampilkan total poin pelanggaran";
    }
  }
  else {
    header('Location: /desi/admin/pelanggaran.php?runFunction=getPelanggaranlp');
    exit();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>tambah data list pelanggaran</title>
    <style>
      @media print {
        .tanggal,
        .waktu {
          display: none !important;
        }
      }

    </style>
</head>
<body>
    <?php include "../navbar.php" ?>
<?php 

if ($total_poin < $aturan_poin) {
  ?>
  <div class="container mb-5">
    <div class="row">
      <div class="col">
        <h4 class="mt-4">Nama: <?php echo $data_siswa["nama"] ?><br>NISN : <?php echo $data_siswa["nisn"] ?><br>Total Poin Pelanggaran: <?php echo $total_poin ?></h4>
        <div class="p-3 mt-3 text-primary-emphasis bg-success-subtle border border-success-subtle rounded-3">
            Total pelanggaran dibawah batas poin maksimal.
        </div>
      </div>
    </div>
  </div>
  <?php
}
else {
  ?>
<div class="container my-5 d-print-block">
  <div class="row d-print-block">
    <div class="col-md-12">
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th colspan="2" class="text-center">
                <h3>Surat Panggilan Orang Tua Siswa</h3>
              </th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Kepada Yth. Orang Tua / Wali Siswa:</td>
              <td>
                Nama Siswa : <?php echo $data_siswa["nama"] ?><br>
                Kelas : <?php echo $data_siswa["kelas_siswa"] ?><br>
                NIS : <?php echo $data_siswa["nisn"] ?><br>
                Sekolah : <?php echo $nama_website ?>
              </td>
            </tr>
            <tr>
              <td>Dalam kurun waktu enam bulan terakhir, kami menemukan perilaku yang kurang baik dari siswa tersebut dengan melakukan pelanggaran berat.</td>
              <td>
              <div class="form-group tanggal">
                <label for="tanggal">Tanggal</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal">
              </div>
              <div class="form-group waktu">
                <label for="waktu">Waktu</label>
                <input type="time" class="form-control" id="waktu" name="waktu">
              </div>
              </td>
            </tr>
            <tr>
              <td colspan="2">
                Kami berharap adanya dukungan dan kerjasama dari orang tua / wali siswa dalam mengatasi perilaku siswa tersebut agar kedepannya bisa menjadi lebih baik. Oleh karena itu, kami mengundang Bapak/Ibu/Saudara/i untuk datang ke sekolah pada:
                <br>
                <br>
                Tanggal: <span id="tgl-cetak"></span><br>
                Waktu: <span id="waktu-cetak"></span><br>
                <br>
                Atas perhatian dan kerjasamanya, kami ucapkan terima kasih.
              </td>
            </tr>
            <tr>
              <td colspan="2" class="text-right">
                <?php echo $nama_website ?><br>
                Kepala Sekolah
              </td>
            </tr>
            <tr>
              <td colspan="2" class="text-center">
                <button class="btn btn-primary d-print-none" onclick="cetak()">Cetak Surat Panggilan</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
function cetak() {
  var tgl = document.getElementById("tanggal").value;
  var waktu = document.getElementById("waktu").value;
  document.getElementById("tgl-cetak").innerHTML = tgl;
  document.getElementById("waktu-cetak").innerHTML = waktu;
  window.print();
}
</script>

  <?php
}
 ?>
</body>
</html>