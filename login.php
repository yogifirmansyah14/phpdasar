<?php
session_start();
require 'functions.php';

if (isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE id=$id");
    $row = mysqli_fetch_assoc($result);

    if ($key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
    }
}

if ($_SESSION['login']) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<?php
if (isset($_POST['login'])) {
    // print_r($_POST);
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
    if (mysqli_num_rows($result)) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['login'] = true;

            if (isset($_POST['remember'])) {
                setcookie('id', $row['id'], time() + 360);
                setcookie('key', hash('sha256', $row['username']), time() + 360);
            }
            header("Location: index.php");
            exit;
        }
    }

    $error = true;

    if ($error) {
        echo "
            <script>
                alert('Username/password salah!');
            </script>
        ";
    }
}
?>

<body>
    <form action="" method="POST">
        <table cellpadding="5">
            <tr>
                <td colspan="2">
                    <h2 style="text-align: center;">LOGIN</h2>
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
                <td></td>
                <td><input type="checkbox" name="remember" id="remember"><label for="remember">Remember me</label></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="2"><button type="submit" name="login">Login</button></td>
            </tr>
        </table>
    </form>
</body>

</html>