<?php
    $tendangnhap = $_GET['username'];
    $matkhau = $_GET['password'];

    if ($tendangnhap == 'admin' && $matkhau =='admin'){
        echo '<script>
        alert("Đăng nhập thành công")
    </script>';
    }
    else{
        echo '<h1>Đăng nhập thất bại</h1>';
    }


    

?>