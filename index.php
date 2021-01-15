<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trang chủ</title>
    <style>
        #box{
            background: yellow;
            color: red;
            font-size: 24px;
        }
    </style>
</head>
<body>
    <?php
        echo '<h1 style="color: Blue;">Xin chào PHP</h1>';

        $hoTen  = 'Thuận';
        $matKhau = '123456';

    ?>
    <a href="pages/about.php">Giới thiệu</a> <br>
    <a href="pages/contact.php">Liên hệ</a>

    <div id="box">
        Xin chào <b><?=$hoTen?></b> <br>
        Mật khẩu của bạn là <b><?=$matKhau?></b>
    </div>


    
</body>
</html>