<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password ='$password'");
    $cek = mysqli_num_rows($query);

    if ($cek > 0) {
        $_SESSION['username'] = $username;
        $_SESSION['status'] = "login";
        header("Location:dashboard.php");
    } else {
        echo "Username atau password salah!";
    }

}
?>
<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTP-8">
        <title>Login</title>
        <link rel="stylesheet" href="login.css">
    </head>
    <body>
        <h2>Login</h2>
        <form method="POST">
        Username <input type="text" name="username"><br><br>
        Password <input type="password" name="password"><br><br>
        <button type="submit" name="login">Login</button>
        </form>
    </body>
</html>

