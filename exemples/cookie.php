<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
</head>
<body>

    <?php if(isset($_COOKIE['is_logged'])):?>

        <h1>Xin chào <?= $_COOKIE['username'];?> </h1>
    <?php else:?>

    <h1>Đăng nhập</h1>
    <form action="" method="post" name="frmLogin">
        <label>Username: </label>
        <input type="text" name="username"> <br>
        <label>Password: </label>
        <input type="password" name="password"> <br>
        <input type="checkbox" name="remember_me" id="remember_me" value="1"> Remember me <br>
        <button name="btnLogin">Login</button>
    </form>

    <?php endif;?>
    <?php
    if(isset($_POST['btnLogin'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $remember_me = isset($_POST['remember_me']) ? $_POST['remember_me'] : 0;
        if ($username == 'admin' && $password == 'admin'){
            
            if($remember_me == 1){
                echo 'Đăng nhập thành công!';
                setcookie('is_logged',true,time()+30,'/');
                setcookie('username', $username,time()+30,'/');  
            } 

        } else echo 'Đăng nhập thất bại';
    }
    ?>
</body>
</html>