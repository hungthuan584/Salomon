<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
</head>
<body>
    <h1>Đăng nhập</h1>
    <?php session_start(); ?>
    <form action="" method="post" name="frmLogin">
        <label>Username: </label>
        <input type="text" name="username"> <br>
        <label>Password: </label>
        <input type="password" name="password"> <br>
        <button name="btnLogin">Login</button>
    </form>
    <?php 
    if (isset($_POST['btnLogin'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        if($username == 'admin' && $password=='admin'){
            echo('Đăng nhập thành công');
            $_SESSION['dangnhap'] = true;
            $_SESSION['username'] = $username;
            echo('<script>location.href = "session.php";</script>');
        }
    }
    ?>
</body>
</html>