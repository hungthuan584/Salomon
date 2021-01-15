<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Học Session</title>
</head>
<body>
    <?php
    session_start();
    ?>

    <?php if(isset($_SESSION['dangnhap']) && $_SESSION['dangnhap']==true): ?>
    <h1>Chào mừng <?= $_SESSION['username']; ?> đã đăng nhập trang web!</h1>
    <a href="dangxuat.php">Đăng xuất</a>
    <?php else: ?>
    <a href="dangnhap.php">Bấm vào đây để đăng nhập</a>
    <?php endif; ?>
</body>
</html>