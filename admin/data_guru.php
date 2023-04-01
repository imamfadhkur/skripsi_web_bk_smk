<a href="tambahDataGuru.php" class="btn btn-primary mt-4"><i class="bi bi-plus-circle"></i> tambah data guru</a>
<table class="table table-striped mt-1">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">NIP</th>
      <th scope="col">Nama</th>
      <th scope="col">Email</th>
      <th scope="col">Kategori</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    include "../koneksi.php";
    $data_guru = $con_pdo->prepare("SELECT * FROM guru");
    $data_guru->execute();
    $count = 0;
    foreach ($data_guru as $key => $value) {
      $count++;
      ?>
      <tr>
        <th scope="row"><?php echo $count ?></th>
        <td><?php echo $value["nip"] ?></td>
        <td><?php echo $value["nama"] ?></td>
        <td><?php echo $value["email"] ?></td>
        <td><?php echo $value["level"] ?></td>
        <td><?php
        echo '<a class="btn btn-warning badge" href="editDataGuru.php?nip=' . $value["nip"] . '"><i class="bi bi-pencil-fill"></i></a>';
        ?><a class="btn btn-danger badge m-1" href="deleteDataGuru.php?nip='<?php echo $value["nip"] ?>'" onclick="return confirm('yakin ingin dihapus?')"><i class="bi bi-trash-fill"></i></a>
        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>