<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cấu hình giao diện</title>
    <style>
    .light-theme{
        background: #fff;
        color: #000;
    }
    .dark-theme{
        background: #000;
        color: yellow;
    }
    </style>
</head>
<?php
    $themeClass = 'light-theme';
    if(isset($_COOKIE['themeclass'])){
        $themeClass = isset($_COOKIE['themeclass']) ? $_COOKIE['themeclass']: 'light-theme';
    }
?>
<body class="<?= $themeClass ?>">
    <h1>Cấu hình Giao diện sử dụng Cookie trong PHP</h1>

    <!-- Form Login -->
    <form name="frmLogin" method="post" action="">

        <label><input type="radio" name="theme" id="theme-1" value="light-theme" checked />Giao diện nền Sáng</label><br />
        <label><input type="radio" name="theme" id="theme-2" value="dark-theme" />Giao diện nền Tối</label><br />
        <input type="submit" name="btnSave" value="Lưu" />
    </form>

    <?php
        if (isset($_POST['btnSave'])){
            $theme = $_POST['theme'];
            setcookie('themeclass', $theme,time()+90000000,'/');
            echo '<script>location.href = "giaodien.php";</script>';
        }
    ?>

</body>
</html>