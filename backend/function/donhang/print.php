<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>In đơn hàng</title>
    <link rel="stylesheet" href="/Salomon/assets/vendor/paper-css/paper.css">
    <style>@page { size: A4 }</style>
</head>
<body class="A4">

    <?php
        // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
        include_once(__DIR__ . '/../../../dbconnect.php');

        $dh_ma = $_GET['dh_ma'];
        // 2. Chuẩn bị câu truy vấn $sql
        $sql =  <<<EOT
            SELECT 
                    dh.dh_ma,dh.dh_ngaylap,dh.dh_ngaygiao,dh.dh_noigiao,dh.dh_trangthaithanhtoan,
                    httt.httt_ten,
                    kh.kh_ten,
                    SUM(ctdh.sp_dh_soluong * ctdh.sp_dh_dongia) AS TongThanhTien
            FROM dondathang dh
            JOIN sanpham_dondathang ctdh ON dh.dh_ma = ctdh.dh_ma
            JOIN khachhang kh ON dh.kh_tendangnhap = kh.kh_tendangnhap
            JOIN hinhthucthanhtoan httt ON dh.httt_ma = httt.httt_ma
            WHERE dh.dh_ma = $dh_ma
            GROUP BY dh.dh_ma             
EOT;

        // 3. Thực thi câu truy vấn SQL để lấy về dữ liệu
        $result = mysqli_query($conn, $sql);

        $row = mysqli_fetch_array($result, MYSQLI_ASSOC)
    ?>
    <section class="sheet padding-10mm">

    <!-- Write HTML just like a web page -->
        <table border="1" width="100%">
            <tr>
                <td width="150px"><img src="/Salomon/shared/default-image.jpg" alt="Logo" width="100%"></td>
                <td style="text-align: center; vertical-align: middle;"><h1>CÔNG TY SALOMON</h1></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center;"><h3>HÓA ĐƠN BÁN HÀNG</h3></td>
            </tr>
        </table>
        <p style="font-weight: bold;"><i><u>Thông tin đặt hàng:</u></i></p>
        <table>
            <tr>
                <th>Khách hàng: </th><td><?= $row['kh_ten']; ?></td>
            </tr>
        </table>

    </section>
</body>
</html>