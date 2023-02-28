<?php
require '../functions.php';
usleep(500000);

$keyword = $_GET['keyword'];
$query = $query = "SELECT * FROM students WHERE 
                        name LIKE '%$keyword%' OR
                        email LIKE '%$keyword%' OR
                        prodi LIKE '%$keyword%'                        
                        ";
$mahasiswa = query($query);
$j = 1;
?>
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