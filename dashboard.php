<?php
session_start();
require "db.php";

/* 1. چک لاگین بودن کاربر */
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

/* 2. گرفتن id کاربر */
$user_id = $_SESSION['user_id'];

/* 3. گرفتن اطلاعات از دیتابیس */
$sql = "
SELECT 
    users.firstname,
    users.lastname,
    users.profile_pic,
    moavenat.title AS moavenat_title,
    edare.title AS edare_title
FROM users
LEFT JOIN moavenat ON users.moavenat_id = moavenat.id
LEFT JOIN edare ON users.edare_id = edare.id
WHERE users.id = :id
";

$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

/* اگر کاربر پیدا نشد */
if (!$user) {
    echo "کاربر پیدا نشد";
    exit;
}
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
<meta charset="UTF-8">
<title>Dashboard</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

    <!-- لوگو -->
    <div class="logo-box">
        <img src="img/logo-removebg-preview.png" class="logo">
    </div>

    <!-- پروفایل -->
    <div class="user-box">

        <?php
        if(!empty($user['profile_pic']) && file_exists("uploads/".$user['profile_pic'])){
        ?>
        <img src ="uploads/<?php echo $user['profile_pic'];?>" class ="profile_img">
        <?php
        }else{}
        ?>

        <div class="profile-circle">

            <?php
            echo mb_substr($user['firstname'],0,1,'UTF-8');
            echo mb_substr($user['lastname'],0,1,'UTF-8');
            ?>

        </div>
        <div class="user-info">

            <h2>
                <?php
                echo $user['firstname']." ".$user['lastname'];
                ?>
            </h2>
          
            <p><?php echo $user['moavenat_title'];?></p>
            <p><?php echo $user['edare_title'];?></p>
        </div>

    </div>

    <h1 class="title"> سامانه درخواست خرید، خدمت و تعمیر تجهیزات فناوری </h1>
    <div class="green-box"></div>
    <a href="logout.php" class="logout"> خروج </a>
</div>
</body>
</html>