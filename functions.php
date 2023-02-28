<?php
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

function upload()
{
    $photoName = $_FILES['photo']['name'];
    $photoTmpName = $_FILES['photo']['tmp_name'];
    $photoError = $_FILES['photo']['error'];
    $photoSize = $_FILES['photo']['size'];

    if ($photoError === 4) {
        echo "<script>alert('Silahkan pilih foto terlebih dahulu!')</script>";
        return false;
    }

    if ($photoSize > 1000000) {
        echo "<script>alert('Ukuran foto terlalu besar!')</script>";
        return false;
    }
    $extValid = ['png', 'jpg', 'jpeg'];
    $explode = explode('.', $photoName);
    $ext = strtolower(end($explode));
    if (!in_array($ext, $extValid)) {
        echo "<script>alert('Yang anda masukkan bukan foto!')</script>";
        return false;
    }

    $newPhotoName = time() . '.' . $ext;

    move_uploaded_file($photoTmpName, 'img/' . $newPhotoName);

    return $newPhotoName;
}

function add($data)
{
    global $conn;
    $name = $data['name'];
    $email = $data['email'];
    $prodi = $data['prodi'];

    if (!upload()) {
        return false;
    }

    $photo = upload();

    $query = "INSERT INTO students VALUES (NULL ,'$name', '$email', '$prodi', '$photo')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function update($data)
{
    global $conn;
    $id = $data['id'];
    $name = $data['name'];
    $email = $data['email'];
    $prodi = $data['prodi'];
    $oldPhoto = $data['oldPhoto'];

    if ($_FILES['photo']['error'] === 4) {
        $photo = $oldPhoto;
    } else {
        $photo = upload();
    }

    $query = "UPDATE students SET 
        name='$name', 
        email='$email', 
        prodi='$prodi', 
        photo='$photo' WHERE id = $id
        ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cari($keyword)
{
    $query = "SELECT * FROM students WHERE name LIKE '%$keyword%'";

    return query($query);
}
