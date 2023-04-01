<?php
include "koneksi.php";
session_start();

// echo hash("sha256", "admin");
// exit();
if (isset($_POST["submit_login"])) {
    $pw = $_POST["password"];
    $password = hash("sha256", $pw);
    $koneksi = $con_pdo->prepare("SELECT * FROM user WHERE username LIKE :username AND password LIKE :password");
    $koneksi->bindValue(':username', $_POST['username']);
    $koneksi->bindValue(':password', $password);
    $koneksi->execute();

    foreach ($koneksi as $key => $value) {
        // echo $key."|".$value["level"]."<br>";
    }
    if ($koneksi->rowCount() > 0) {
        $_SESSION["username"] = $value["username"];
        $_SESSION["level"] = $value["level"];

        // get data who logged
        if ($value["level"] == "siswa") {
            $sql = "SELECT * FROM siswa WHERE siswa.nisn = ".$_POST["username"];
            $result = mysqli_query($con_mysqli, $sql);
            $row = mysqli_fetch_assoc($result);
            // echo $row["nama"]."|".$row["email"]."|".$row["nisn"];
            // exit();
            $data = array(
                'nama' => $row["nama"],
                'email' => $row["email"],
                'kelas' => $row["kelas"],
                'jurusan' => $row["jurusan"],
                'orang_tua' => $row["orang_tua"],
                'alamat' => $row["alamat"],
                'kontak' => $row["kontak"]
            );
            $_SESSION["siswa"] = $data;
            header('Location: /desi/siswa/index.php');
            exit();
        }
        elseif ($value["level"] == "admin") {
            $sql = "SELECT * FROM guru WHERE guru.nip = ".$_POST["username"];
            $result = mysqli_query($con_mysqli, $sql);
            $row = mysqli_fetch_assoc($result);
            $data = array(
                'nama' => $row["nama"],
                'email' => $row["email"],
                'level' => $row["level"]
            );
            $_SESSION["admin"] = $data;
            header('Location: /desi/admin/index.php');
            exit();
        }
        elseif ($value["level"] == "guru") {
            $sql = "SELECT * FROM guru WHERE guru.nip = ".$_POST["username"];
            $result = mysqli_query($con_mysqli, $sql);
            $row = mysqli_fetch_assoc($result);
            $data = array(
                'nama' => $row["nama"],
                'email' => $row["email"],
                'level' => $row["level"]
            );
            $_SESSION["guru"] = $data;
            header('Location: /desi/guru/index.php');
            exit();
        }
        
    }
    else {
        header('Location: login.php?message=NISN/NIP atau password anda salah!');
        exit();
    }
}
// echo "leveldd= ".$value["level"];
// exit();

if (isset($_SESSION['guru'])) {
    header('Location: /desi/admin/index.php');
    exit();
}
elseif (isset($_SESSION['admin'])) {
    header('Location: /desi/admin/index.php');
    exit();
}
elseif (isset($_SESSION['siswa'])) {
    header('Location: /desi/siswa/index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
    <?php include "navbar.php" ?>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <img width="80%" src="assets/img/login_img.avif" alt="temporary">
            </div>
            <div class="col-6">
            <form method="POST" action="login.php" class="mt-5 bg-primary-subtle p-3 rounded-3">
            <?php
                if (isset($_GET["message"])) {
                    echo '<div class="p-3 text-primary-emphasis bg-danger-subtle border border-danger-subtle rounded-3">';
                    echo $_GET["message"];
                    echo '</div>';
                }
            ?>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">NISN / NIP</label>
                <input type="text" name="username" class="form-control">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">PASSWORD</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1">
            </div>
            <button type="submit" name="submit_login" class="btn btn-primary">Login</button>
            </form>
            </div>
        </div>
    </div>
</body>
</html>