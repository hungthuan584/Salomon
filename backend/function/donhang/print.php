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
    $sqlThongTinDatHang = <<<EOT
            SELECT 
                    dh.dh_ma,dh.dh_ngaylap,dh.dh_ngaygiao,dh.dh_noigiao,
                    httt.httt_ten,
                    kh.kh_ten,kh_dienthoai
            FROM dondathang dh
            JOIN sanpham_dondathang ctdh ON dh.dh_ma = ctdh.dh_ma
            JOIN khachhang kh ON dh.kh_tendangnhap = kh.kh_tendangnhap
            JOIN hinhthucthanhtoan httt ON dh.httt_ma = httt.httt_ma
            WHERE dh.dh_ma = $dh_ma
            GROUP BY dh.dh_ma             
EOT;

        // 3. Thực thi câu truy vấn SQL để lấy về dữ liệu
    $resultThongTinDatHang = mysqli_query($conn, $sqlThongTinDatHang);

    $rowThongTinDatHang = mysqli_fetch_array($resultThongTinDatHang, MYSQLI_ASSOC)
    ?>
    <section class="sheet padding-10mm">

    <!-- Write HTML just like a web page -->
        <table width="100%">
            <tr>
                <td width="100px"><img src="/Salomon/shared/default-image.jpg" alt="Logo" width="100%"></td>
                <td style="text-align: center; vertical-align: middle;"><h1>CÔNG TY SALOMON</h1></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center;"><h2>HÓA ĐƠN BÁN HÀNG</h2></td>
            </tr>
        </table>
        <p style="font-weight: bold;"><i><u>Thông tin đặt hàng:</u></i></p>
        <table>
            <tr>
                <td>Khách hàng: </td>
                <td><?= $rowThongTinDatHang['kh_ten']; ?> (<?= $rowThongTinDatHang['kh_dienthoai'] ?>) </td>
            </tr>
            <tr>
                <td>Ngày lập: </td>
                <td><?= $rowThongTinDatHang['dh_ngaylap']; ?></td>
            </tr>
            <tr>
                <td>Nơi giao: </td>
                <td><?= $rowThongTinDatHang['dh_noigiao']; ?></td>
            </tr>
            <tr>
                <td>Hình thức thanh toán: </td>
                <td><?= $rowThongTinDatHang['httt_ten']; ?></td>
            </tr>
        </table>
        
        <?php

        $sqlChiTietDonHang = <<<EOT
            SELECT 
                sp.sp_ten,
                lsp.lsp_ten,
                nsx.nsx_ten,
                spddh.sp_dh_soluong, spddh.sp_dh_dongia, (spddh.sp_dh_soluong * spddh.sp_dh_dongia) AS ThanhTien
            FROM sanpham_dondathang spddh
            JOIN sanpham sp ON spddh.sp_ma = sp.sp_ma
            JOIN loaisanpham lsp ON lsp.lsp_ma = sp.lsp_ma
            JOIN nhasanxuat nsx ON nsx.nsx_ma = sp.nsx_ma
            WHERE spddh.dh_ma = $dh_ma
EOT;

        $resultChiTietDonHang = mysqli_query($conn, $sqlChiTietDonHang);
        $ChiTiet = [];
        while ($rowChiTietDonHang = mysqli_fetch_array($resultChiTietDonHang, MYSQLI_ASSOC)) {
            $ChiTiet[] = array(
                'sp_ten' => $rowChiTietDonHang['sp_ten'],
                'lsp_ten' => $rowChiTietDonHang['lsp_ten'],
                'nsx_ten' => $rowChiTietDonHang['nsx_ten'],
                'sp_dh_soluong' => $rowChiTietDonHang['sp_dh_soluong'],
                'sp_dh_dongia' => $rowChiTietDonHang['sp_dh_dongia'],
                'ThanhTien' => $rowChiTietDonHang['ThanhTien']
            );
        }
        $stt = 1;
        $tongThanhTien = 0;
        ?>

        <p style="font-weight: bold;"><i><u>Chi tiết đơn hàng:</u></i></p>
        <table width="100%" border="1" cellspacing="0">
            <thead>
            <tr>
                <th>STT</th>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($ChiTiet as $ct) : ?>
                <tr>
                    <td style="text-align: center;"><?= $stt;
                                                    $stt += 1; ?></td>
                    <td style="padding: 5px;">
                        <b><?= $ct['sp_ten']; ?></b> <br>
                        <i><?= $ct['lsp_ten']; ?></i> <br>
                        <i><?= $ct['nsx_ten']; ?></i>
                    </td>
                    <td style="text-align: center;padding: 5px;"><?= $ct['sp_dh_soluong']; ?></td>
                    <td style="text-align: right;padding: 5px;"><?= number_format($ct['sp_dh_dongia'], "0", ".", ",") . ' VND'; ?></td>
                    <td style="text-align: right;padding: 5px;"><?= number_format($ct['ThanhTien'], "0", ".", ",") . ' VND';
                                                    $tongThanhTien += $ct['ThanhTien']; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            <tfoot>
                <tr style="font-weight: bold;">
                    <td colspan="4" style="text-align: right; padding: 5px; font-size: 20px;">Tổng thành tiền: </td>
                    <td style="text-align: right; padding: 5px; font-size: 20px;"><?= number_format($tongThanhTien, "0", ".", ",") . ' VND'; ?></td>
                </tr>
            </tfoot>
        </table>
    </section>
</body>
</html>