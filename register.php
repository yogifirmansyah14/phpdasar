<?php
session_start();
if ($_SESSION['login']) {
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<?php
require 'functions.php';
if (isset($_POST['register'])) {
    // print_r($_POST);
    $username = strtolower($_POST['username']);
    $password = $_POST['password'];
    $password_confirmation = $_POST['password_confirmation'];

    if ($password !== $password_confirmation) {
        echo "
            <script>
                alert('Password tidak sesuai');
                window.location.href = 'register.php';
            </script>
        ";
    } else {

        $password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO users VALUES (NULL, '$username', '$password')";
        mysqli_query($conn, $query);
        if (mysqli_affected_rows($conn) > 0) {
            echo "
            <script>
                alert('Registrasi Berhasil!');
                window.location.href = 'login.php';
            </script>
        ";
        }
    }
}
?>

<body>
    <form action="" method="POST">
        <table cellpadding="5">
            <tr>
                <td colspan="2">
                    <h2 style="text-align: center;">Register</h2>
                </td>
            </tr>
            <tr>
                <td><label for="username">Username</label></td>
                <td><input type="text" name="username" id="username"></td>
            </tr>
            <tr>
                <td><label for="password">Password</label></td>
                <td><input type="password" name="password" id="password"></td>
            </tr>
            <tr>
                <td><label for="password_confirmation">Password Confirmation</label></td>
                <td><input type="password" name="password_confirmation" id="password_confirmation"></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2"><button type="submit" name="register">Register</button></td>
            </tr>
        </table>
    </form>
</body>

</html>