<?php
session_start();
require "db.php";

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if($user){

       /* $user = $stmt->fetch(PDO::FETCH_ASSOC);*/

        if(trim($password) === trim($user['password'])){

            $_SESSION['user_id'] = $user['id'];

            header("Location: dashboard.php");
            exit;

        } else {
            echo "<p style='color:red;text-align:center'>رمز اشتباه است</p>";
        }

    } else {
        echo "<p style='color:red;text-align:center'>کاربر پیدا نشد</p>";
    }
}

?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> شهرداری </title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
<div class="header">
        <div class="logo-box">
            <img src="img/logo-removebg-preview.png" class="logo" alt="عکس بارگذاری نشد">
        </div>
        <h1 class="title"> سامانه درخواست خرید، خدمت و تعمیر تجهیزات فناوری </h1>
        <div class="green-box"></div>
    <!-- فرم ورود -->
    <div class="login-box">
        <form action="login.php" method="post">
            <div class="input-box">
                <input type="text" name="username" placeholder="نام کاربری">
                <input type="password" name="password" placeholder="رمز عبور">
                <button class="login-btn" type="submit" name="login"> ورود </button>
            </div>
        </form>

    </div>
    <a href="logout.php" class="logout"> خروج </a>
</body>
</html>

