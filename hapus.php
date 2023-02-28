<?php
require 'functions.php';
$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM students WHERE id=$id");

$result = mysqli_affected_rows($conn);

if ($result > 0) {
    echo
    "<script>
        alert('Data berhasil dihapus');
        document.location.href = 'index.php';
    </script>";
} else {
    echo
    "<script>
        alert('Data gagal dihapus');
        document.location.href = 'index.php';
    </script>";
}
