<a href="tambahDataSiswa.php" class="btn btn-primary mt-4"><i class="bi bi-plus-circle"></i> tambah data siswa</a>
<table class="table table-striped mt-1">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">NISN</th>
      <th scope="col">Nama</th>
      <th scope="col">Email</th>
      <th scope="col">Kelas Siswa</th>
      <th scope="col">Jurusan</th>
      <th scope="col">Nama Orang Tua</th>
      <th scope="col">Alamat</th>
      <th scope="col">Kontak</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    include "../koneksi.php";
    $data_kelas = $con_pdo->prepare("SELECT * FROM siswa");
    $data_kelas->execute();
    $count = 0;
    foreach ($data_kelas as $key => $value) {
      $count++;
      ?>
      <tr>
        <th scope="row"><?php echo $count ?></th>
        <td><?php echo $value["nisn"] ?></td>
        <td><?php echo $value["nama"] ?></td>
        <td><?php echo $value["Eeail"] ?></td>
        <td><?php echo $value["kelas_siswa"] ?></td>
        <td><?php echo $value["jurusan"] ?></td>
        <td><?php echo $value["orang_tua"] ?></td>
        <td><?php echo $value["alamat"] ?></td>
        <td><?php echo $value["kontak"] ?></td>
        <td><?php
        echo '<a class="btn btn-warning badge" href="editDataSiswa.php?nisn=' . $value["nisn"] . '"><i class="bi bi-pencil-fill"></i></a>';
        ?><a class="btn btn-danger badge m-1" href="deleteDataSiswa.php?nisn='<?php echo $value["nisn"] ?>'" onclick="return confirm('yakin ingin dihapus?')"><i class="bi bi-trash-fill"></i></a>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>