<a href="tambahDataKelas.php" class="btn btn-primary mt-4"><i class="bi bi-plus-circle"></i> tambah data kelas</a>
<table class="table table-striped mt-1">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nama Kelas</th>
      <th scope="col">Jurusan</th>
      <th scope="col">Wali Kelas</th>
      <th scope="col">Total Siswa</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    include "../koneksi.php";
    $data_kelas = $con_pdo->prepare("SELECT * FROM kelas");
    $data_kelas->execute();
    $count = 0;
    foreach ($data_kelas as $key => $value) {
      $count++;
      ?>
      <tr>
        <th scope="row"><?php echo $count ?></th>
        <td><?php echo $value["nama"] ?></td>
        <td><?php echo $value["jurusan"] ?></td>
        <td><?php echo $value["wali_kelas"] ?></td>
        <td><?php echo $value["total_siswa"] ?></td>
        <td><?php
        echo '<a class="btn btn-warning badge" href="editDataKelas.php?nama=' . $value["nama"] . '"><i class="bi bi-pencil-fill"></i></a>';
        ?><a class="btn btn-danger badge m-1" href="deleteDataKelas.php?nama='<?php echo $value["nama"] ?>'" onclick="return confirm('yakin ingin dihapus?')"><i class="bi bi-trash-fill"></i></a>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>