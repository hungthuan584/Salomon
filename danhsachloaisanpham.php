<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Danh sách loại sản phẩm</title>
</head>
<body>
    <h1>Danh sách loại sản phẩm</h1>
    <form name="frmThemLoaiSP" action="" method="POST">
    <label for="">Mã loại:</label> <input name="lsp_ma" id="lsp_ma" type="text"> <br>
    <!-- <label for="">Tên loại:</label> <input name="lsp_ten" id="lsp_ten" type="text"> <br>
    <label for="">Mô tả: </label> <textarea name="lsp_mota" id="lsp_mota" cols="30" rows="10"></textarea> <br> -->
    <button name="btnSave">Lưu</button>
    </form>
    <?php
    //Kiểm tra có submit chưa
    if (isset($_POST['btnSave'])){
        //Kết nối db
        include_once'dbconnect.php';
        //Chuẩn bị câu lệnh
        $maloai = $_POST['lsp_ma'];
        // $ten = $_POST['lsp_ten'];
        // $mota = $_POST['lsp_mota'];

        // $sql = "INSERT INTO loaisanpham(lsp_ten, lsp_mota) VALUES ('$ten', '$mota');";
//         $sql = <<<EOT
//         UPDATE loaisanpham
//         SET
//             lsp_ten='$ten',
//             lsp_mota='$mota'
//         WHERE lsp_ma='$maloai';
// EOT;

        $sql = <<<EOT
        DELETE FROM loaisanpham WHERE lsp_ma = '$maloai'
EOT;

        //Thực thi
        mysqli_query($conn,$sql);
    }
    ?>
</body>
</html>