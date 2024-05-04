<?php 
session_start();
if (isset($_SESSION["login"])) {
    header("Location: todolist.php");
    exit(); 
}
require 'function.php';

if (isset($_POST['regiss'])) {
    $_SESSION["regis"] = true;
    header("Location: register.php");
    exit();
} elseif(isset($_POST['loginbtn'])){
    login($_POST);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <form action="" method="post">
        <div class="container">
            <h6> LOGIN </h6>
            <div class="grup">
                <input type="text" id="username" name="username" placeholder="Username">
            </div>
            <div class="grup">
                <input type="text" id="password" name="password" placeholder="password">
            </div>
            <ul>
            <button class="regis" name="regiss">Registrasi</button>
            <button type="submit" class="Loginbtn" name="loginbtn"> Login </button>
            </ul>
        </div>
    </form>
</body>
</html>
