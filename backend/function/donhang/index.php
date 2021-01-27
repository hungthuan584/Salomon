<!-- Nhúng file cấu hình để xác định được Tên và Tiêu đề của trang hiện tại người dùng đang truy cập -->
<?php include_once(__DIR__ . '/../../layouts/config.php'); ?>

<!DOCTYPE html>
<html>

<head>
    <!-- Nhúng file quản lý phần HEAD -->
    <?php include_once(__DIR__ . '/../../layouts/head.php'); ?>
    <link rel="stylesheet" href="/Salomon/assets/vendor/DataTables/datatables.min.css" type="text/css">
    <link rel="stylesheet" href="/Salomon/assets/vendor/DataTables/Buttons-1.6.5/css/buttons.bootstrap4.min.css" type="text/css">
</head>

<body class="d-flex flex-column h-100">
    <!-- header -->
    <?php include_once(__DIR__ . '/../../layouts/partials/header.php'); ?>
    <!-- end header -->

    <div class="container-fluid">
        <div class="row">
            <!-- sidebar -->
            <?php include_once(__DIR__ . '/../../layouts/partials/sidebar.php'); ?>
            <!-- end sidebar -->

            <div class="col-md-9">

                <!-- content -->
                <div class="text-center">
                    <h1 class="h2">Danh sách đơn hàng</h1>
                </div>


                <?php
                // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
                include_once(__DIR__ . '/../../../dbconnect.php');

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
                    GROUP BY dh.dh_ma             
EOT;

                // 3. Thực thi câu truy vấn SQL để lấy về dữ liệu
                $result = mysqli_query($conn, $sql);


                $ds_donhang = [];
                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $ds_donhang[] = array(
                        'dh_ma' => $row['dh_ma'],
                        'dh_ngaylap' => date('d/m/Y H:i:s', strtotime($row['dh_ngaylap'])),
                        'dh_ngaygiao' => date('d/m/Y H:i:s', strtotime($row['dh_ngaygiao'])),
                        'dh_noigiao' => $row['dh_noigiao'],
                        'dh_trangthaithanhtoan' => $row['dh_trangthaithanhtoan'],
                        'httt_ten' => $row['httt_ten'],
                        'kh_ten' => $row['kh_ten'],
                        'TongThanhTien' => number_format($row['TongThanhTien'], "0", ".", ",") . ' VND'
                    );
                }
                ?>
                <a href="create.php" class="btn btn-primary">Thêm mới</a>

                <table id="tblDH" width="100%" class="table table-bodered">
                    <thead>
                        <tr>
                            <th>Mã ĐH</th>
                            <th>Tên KH</th>
                            <th>Ngày lập</th>
                            <th>Ngày giao</th>
                            <th>Nơi giao</th>
                            <th>Hình thức thanh toán</th>
                            <th>Trạng thái</th>
                            <th>Tổng thành tiền</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($ds_donhang as $dh) : ?>
                            <tr>
                                <td> <?= $dh['dh_ma']; ?> </td>
                                <td> <?= $dh['kh_ten']; ?> </td>
                                <td> <?= $dh['dh_ngaylap']; ?> </td>
                                <td> <?= $dh['dh_ngaygiao']; ?> </td>
                                <td> <?= $dh['dh_noigiao']; ?> </td>
                                <td> <span class="badge badge-primary"><?= $dh['httt_ten']; ?></span> </td>
                                <td>
                                    <?php if ($dh['dh_trangthaithanhtoan'] == 0) : ?>
                                        <span class="badge badge-danger">Chưa thanh toán</span>
                                    <?php else : ?>
                                        <span class="badge badge-success">Đã thanh toán</span>
                                    <?php endif; ?>
                                </td>
                                <td style="text-align: right;"> <?= $dh['TongThanhTien']; ?> </td>
                                <td>
                                    <a class="btn btn-primary" href="print.php?dh_ma=<?= $dh['dh_ma']; ?>">In</a>
                                    <a class="btn btn-danger" href="delete.php?dh_ma=<?= $dh['dh_ma']; ?>">Xóa</a>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>



                <!-- end content -->

            </div>

        </div>
    </div>

    <!-- footer -->
    <?php include_once(__DIR__ . '/../../layouts/partials/footer.php'); ?>
    <!-- end footer -->

    <!-- Nhúng file quản lý phần SCRIPT JAVASCRIPT -->
    <?php include_once(__DIR__ . '/../../layouts/scripts.php'); ?>
    <script src="/Salomon/assets/vendor/DataTables/datatables.min.js"></script>
    <script src="/Salomon/assets/vendor/DataTables/Buttons-1.6.5/js/buttons.bootstrap4.min.js"></script>
    <script src="/Salomon/assets/vendor/DataTables/pdfmake-0.1.36/pdfmake.js"></script>
    <script src="/Salomon/assets/vendor/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script>
        $(document).ready(function() {
            $('#tblDH').DataTable({
                dom: 'Blfrtip',
                buttons: [
                    'copy', 'excel', 'pdf'
                ]
            });
        });
    </script>

    <!-- Các file Javascript sử dụng riêng cho trang này, liên kết tại đây -->
    <!-- <script src="..."></script> -->
</body>

</html>