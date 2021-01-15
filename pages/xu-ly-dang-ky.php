<?php
    $tenDangNhap = $_POST['username'];
    $matKhau = $_POST['password'];
    $hoTen = $_POST['fullname'];

?>




<ul>
    <li>Tên tài khoản: <?= $tenDangNhap?> </li>
    <li>Mật khẩu: <?= $matKhau?> </li>
    <li>Họ và tên: <?= $hoTen ?> </li>
</ul>