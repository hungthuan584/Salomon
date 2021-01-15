<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
</head>



<body>
    <div>
        <h1>Đăng ký tài khoản</h1>
        <form name="formSignUp" method="POST" action="xu-ly-dang-ky.php">
            <label for="">Tên đăng nhập: </label> <input type="text" id="username" name="username" /> <br>
            <label for="">Mật khẩu: </label> <input type="password" id="password" name="password" /> <br>
            <label for="">Họ tên: </label> <input type="text" id="fullname" name="fullname" /> <br>
            <input type="submit" id="btnLogin" value="Đăng nhập">
        </form>
    </div>
</body>

</html>