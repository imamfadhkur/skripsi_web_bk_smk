<!-- <button class="btn btn-primary mt-4 d-print-none" onclick="window.print()">print rekap pelanggaran</button> -->
<a href="print_rekap_pelanggaran.php" target="_blank" class="btn btn-primary mt-4">print rekap pelanggaran</a>
<table class="table mt-1 d-d-print-table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">NISN siswa</th>
      <th scope="col">Nama siswa</th>
      <th scope="col">Kelas siswa</th>
      <th scope="col">Pelapor - NIP</th>
      <th scope="col">Wali Kelas - NIP</th>
      <th scope="col">pelanggaran</th>
      <th scope="col">poin</th>
      <th scope="col">keterangan tindakan</th>
    </tr>
  </thead>
  <tbody>
    <?php
    include "../koneksi.php";
    $data_kelas = $con_pdo->prepare("SELECT list_pelanggaran.*, siswa.nama AS nama_siswa, siswa.kelas_siswa AS kelas_siswa FROM list_pelanggaran, siswa WHERE list_pelanggaran.nisn_siswa = siswa.nisn");
    $data_kelas->execute();
    $count = 0;
    foreach ($data_kelas as $key => $value) {
      $count++;
      ?>
      <tr>
        <th scope="row"><?php echo $count ?></th>
        <td scope="col"><?php echo $value["nisn_siswa"] ?></td>
        <td scope="col"><?php echo $value["nama_siswa"] ?></td>
        <td scope="col"><?php echo $value["kelas_siswa"] ?></td>
        <td scope="col"><?php echo $value["dilaporkan_oleh"] ?> - <?php
        $sql = "SELECT * FROM guru WHERE nip = '".$value["dilaporkan_oleh"]."'";
        $result = mysqli_query($con_mysqli, $sql);
        $row = mysqli_fetch_assoc($result);
        echo $row["nama"];
        ?></td>
        <td scope="col"><?php echo $value["wali_kelas"] ?> - <?php
        $sql = "SELECT * FROM guru WHERE nip = '".$value["wali_kelas"]."'";
        $result = mysqli_query($con_mysqli, $sql);
        $row = mysqli_fetch_assoc($result);
        echo $row["nama"];
        ?></td>
        <td scope="col"><?php echo $value["kategori_pelanggaran"] ?></td>
        <td scope="col"><?php
        $data_kels = $con_pdo->prepare("SELECT * FROM kategori_pelanggaran WHERE nama_pelanggaran = :nama");
        $data_kels->bindValue(':nama',$value["kategori_pelanggaran"]);
        $data_kels->execute();
        foreach ($data_kels as $key => $v) {
          # code...
        }
        echo $v["poin"];
        ?></td>
        <td scope="col"><?php echo $value["keterangan_tindakan"] ?></td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>