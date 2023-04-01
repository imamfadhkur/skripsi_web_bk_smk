<?php
include "../koneksi.php";
if (isset($_SESSION['guru'])) {
    header('Location: /desi/admin/index.php');
    exit();
}
else {
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
    <title>home | siswa</title>
</head>
<body>
    <?php include "../navbar.php" ?>
    <h1>Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus ad sint eius, provident repudiandae beatae fugit assumenda id reprehenderit temporibus natus dolore quae aspernatur, libero doloribus repellat tenetur perferendis voluptatem recusandae maxime optio in cum deleniti eaque. Ipsum minus saepe dignissimos consequatur, libero, voluptates temporibus soluta mollitia molestias officia dolorum blanditiis rerum, veniam facilis modi necessitatibus facere obcaecati est totam sapiente numquam quas repellat sunt magnam. Natus nostrum sed fugit rem eos facilis ea reiciendis, officia totam sapiente aliquam neque iusto maxime repellat veniam quia ipsam a doloremque corporis doloribus. Nesciunt consectetur enim culpa quasi quis at recusandae earum vitae, perspiciatis facere voluptas delectus suscipit numquam deserunt illum dolor sint qui! Magnam quibusdam quae sed accusantium ullam repellendus, sit autem! Aut delectus libero expedita quidem, consequuntur blanditiis officia numquam doloribus. Quia iusto hic odit maxime enim atque natus ipsa eligendi dicta, asperiores minus inventore fuga quas aliquid modi ratione laudantium aspernatur ullam perferendis quos? Similique, quibusdam! Recusandae explicabo animi est accusantium quasi magnam excepturi, voluptates iste ab nemo vero, velit mollitia pariatur nam tempore ex, hic in porro natus ea? Ipsum similique minus voluptatibus nam, cumque est nihil, id sed iusto, odio suscipit autem architecto accusantium magnam alias ducimus quos!</h1>
</body>
</html>