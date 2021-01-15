<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
</head>

<script>
    alert("Đăng nhập thành công")
</script>





<body>
    <div>
        <h1>Đăng nhập</h1>
        <form name="formLogin" method="GET" action="xu-ly-dang-nhap.php">
            <label for="">Tên đăng nhập: </label> <input type="text" id="username" name="username"/> <br>
            <label for="">Mật khẩu: </label> <input type="password" id="password" name="password"/> <br>
            <input type="submit" id="btnLogin" value="Đăng nhập">
        </form>
    </div>
</body>

</html>