<?php
session_start();
if (!$_SESSION['login']) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Belajar PHP</title>

    <style>
        .loader {
            width: 100px;
            position: absolute;
            z-index: -1;
            top: 130px;
            left: 230px;
            display: none;
        }
    </style>
</head>
<?php
require 'functions.php';

$jumlahDataPerHalaman = 2;
$jumlahData = count(query("SELECT * FROM students"));
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET['halaman'])) ? $_GET['halaman'] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;
$mahasiswa = query("SELECT * FROM students LIMIT $awalData, $jumlahDataPerHalaman");
if (isset($_POST['cari'])) {
    $mahasiswa = cari($_POST['keyword']);
}
$j = 1;

?>

<body>
    <a href="logout.php">Logout</a> | <a href="cetak.php" target="_blank">Cetak</a>
    <h1><?= 'Data Mahasiswa'; ?></h1>
    <a href="add.php">Tambah Data Mahasiswa</a> <br><br>
    <?php if ($_GET['halaman'] > 1) : ?>
        <a href="?halaman=<?= $halamanAktif - 1 ?>">&laquo;</a>
    <?php endif; ?>

    <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
        <?php if ($halamanAktif == $i) : ?>
            <a href="?halaman=<?= $i; ?>" style="font-weight: bold; color:red;"><?= $i; ?></a>
        <?php else : ?>
            <a href="?halaman=<?= $i; ?>"><?= $i; ?></a>
        <?php endif; ?>
    <?php endfor; ?>

    <?php if ($_GET['halaman'] < $jumlahHalaman) : ?>
        <a href="?halaman=<?= $halamanAktif + 1 ?>">&raquo;</a>
    <?php endif; ?>
    <form action="" method="POST">
        <table>
            <tr>
                <td><input type="text" name="keyword" id="keyword"></td>
                <td><button type="submit" name="cari">Cari</button></td>
                <td><img src="img/loader.gif" class="loader"></td>
            </tr>
        </table>
    </form>

    <div id="container">
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Prodi</th>
                    <th>Gambar</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($mahasiswa) : ?>
                    <?php foreach ($mahasiswa as $mhs) : ?>
                        <tr>
                            <td>
                                <?php if (!$halamanAktif) : ?>
                                    <?= $j++ ?>
                                <?php else : ?>
                                    <?= $j++ + $jumlahDataPerHalaman * $halamanAktif - $jumlahDataPerHalaman ?>
                                <?php endif; ?>
                            </td>
                            <td><?= $mhs['name'] ?></td>
                            <td><?= $mhs['email'] ?></td>
                            <td><?= $mhs['prodi'] ?></td>
                            <td><img src="img/<?= $mhs['photo'] ?>" width="50px"></td>
                            <td>
                                <a href="update.php?id=<?= $mhs['id']; ?>">Ubah</a> |
                                <a href="hapus.php?id=<?= $mhs['id']; ?>" onclick="return confirm('Yakin?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="6" style="text-align: center;">Not Found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <script src="js/jquery-3.6.3.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>