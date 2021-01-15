<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh toán</title>
</head>
<body>
    <?php session_start(); ?>
    <?php if(!(isset($_SESSION['dangnhap']) && $_SESSION['dangnhap'] == true)): echo('Vui lòng đăng nhập để thực hiện chức năng này'); ?>
    <a href="dangnhap.php">Đăng nhập ngay</a>
    <?php else: ?>
    <h1>Thanh toán thành công!</h1>
    <?php endif; ?>

</body>
</html>