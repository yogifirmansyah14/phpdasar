<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
</head>
<?php
require 'functions.php';
$id = $_GET['id'];
$mhs = query("SELECT * FROM students WHERE id=$id")[0];
// print_r($mhs);
if (isset($_POST['update'])) {
    // print_r($_POST);
    // print_r($_FILES);
    // die;
    if (update($_POST) > 0) {
        echo
        "<script>
            alert('Data berhasil diubah');
            document.location.href = 'index.php';
        </script>";
    } else {
        echo
        "<script>
            alert('Data gagal diubah');
            // document.location.href = 'index.php';
        </script>";
    }
}
?>

<body>
    <h1>Tambah Data</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $mhs['id'] ?>">
        <input type="hidden" name="oldPhoto" value="<?= $mhs['photo'] ?>">
        <table cellpadding="10" cellspacing="0">
            <tr>
                <td><label for="name">Nama</label></td>
                <td><input type="text" name="name" id="name" value="<?= $mhs['name'] ?>"></td>
            </tr>
            <tr>
                <td><label for="email">Emails</label></td>
                <td><input type="text" name="email" id="email" value="<?= $mhs['email'] ?>"></td>
            </tr>
            <tr>
                <td><label for="prodi">Prodi</label></td>
                <td><input type="text" name="prodi" id="prodi" value="<?= $mhs['prodi'] ?>"></td>
            </tr>
            <tr>
                <td><label for="photo">Gambar</label></td>
                <td><input type="file" name="photo" id="photo"></td>
                <td><img src="img/<?= $mhs['photo'] ?>" width="100px"></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit" name="update">Ubah</button></td>
            </tr>
        </table>
    </form>
</body>

</html>