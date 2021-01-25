<!-- Nhúng file cấu hình để xác định được Tên và Tiêu đề của trang hiện tại người dùng đang truy cập -->
<?php include_once(__DIR__ . '/../../layouts/config.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <!-- Nhúng phần file head.php -->
    <?php include_once(__DIR__ . '/../../layouts/head.php'); ?>
    <link rel="stylesheet" type="text/css" href="/salomon/assets/vendor/DataTables/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="/salomon/assets/vendor/DataTables/Buttons-1.6.5/css/buttons.bootstrap4.min.css">
</head>

<body>
    <!-- Header -->
    <?php include_once(__DIR__ . '/../../layouts/partials/header.php'); ?>
    <!-- end header -->

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <!-- sidebar -->
                <?php include_once(__DIR__ . '/../../layouts/partials/sidebar.php'); ?>
                <!-- end sidebar -->
            </div>
            <!-- Content -->
            <div class="col-md-9">
                <?php
                //Ket noi du lieu
                include_once(__DIR__ . '/../../../dbconnect.php');
                // -------------------------------//
                // Truy van du lieu khach hang
                $sqlKhachHang = <<<EOT
                    SELECT * FROM khachhang
EOT;
                $resultKhachHang = mysqli_query($conn, $sqlKhachHang);
                $kh = [];
                while ($row1 = mysqli_fetch_array($resultKhachHang, MYSQLI_ASSOC)) {
                    $kh[] = array(
                        'kh_tendangnhap' => $row1['kh_tendangnhap'],
                        'kh_ten' => $row1['kh_ten'],
                        'kh_dienthoai' => $row1['kh_dienthoai'],
                        'kh_diachi' => $row1['kh_diachi']
                    );
                }

                // -------------------------------//
                // Truy van du lieu hinh thuc thanh toan
                $sqlHTTT = <<<EOT
                    SELECT * FROM hinhthucthanhtoan
EOT;
                $resultHTTT = mysqli_query($conn, $sqlHTTT);
                $httt = [];
                while ($row2 = mysqli_fetch_array($resultHTTT, MYSQLI_ASSOC)) {
                    $httt[] = array(
                        'httt_ma' => $row2['httt_ma'],
                        'httt_ten' => $row2['httt_ten'],
                    );
                }
                // --------------------------------//
                // Truy van du lieu san pham
                $sqlSanPham = <<<EOT
                    SELECT * FROM sanpham
EOT;
                $resultSanPham = mysqli_query($conn, $sqlSanPham);
                $ds_sanpham = [];
                while ($row3 = mysqli_fetch_array($resultSanPham, MYSQLI_ASSOC)) {
                    $ds_sanpham[] = array(
                        'sp_ma' => $row3['sp_ma'],
                        'sp_ten' => $row3['sp_ten'],
                        'sp_gia' => $row3['sp_gia']
                    );
                }

                ?>

                <h2>Thêm mới đơn hàng</h2>
                <form name="frmDonHang" method="POST" action="">
                    <h3>Thông tin đơn hàng</h3>
                    <div class="form-group">
                        <label for="">Khách hàng</label>
                        <select name="kh_tendangnhap" id="kh_tendangnhap" class="form-control">
                            <?php foreach ($kh as $ct) : ?>
                                <option value="<?= $ct['kh_tendangnhap'] ?>"><?= $ct['kh_ten'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="">Ngày lập</label>
                            <input type="date" name="dh_ngaylap" id="dh_ngaylap" class="form-control">
                        </div>
                        <div class="form-group col">
                            <label for="">Ngày giao</label>
                            <input type="date" name="dh_ngaygiao" id="dh_ngaygiao" class="form-control">
                        </div>
                        <div class="form-group col">
                            <label for="">Nơi giao</label>
                            <input type="text" name="dh_noigiao" id="dh_noigiao" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col">
                            <label for="">Trạng thái thanh toán</label> <br>
                            <input type="radio" value="0" name="dh_trangthaithanhtoan" checked> Chưa thanh toán
                            <input type="radio" vaule="1" name="dh_trangthaithanhtoan"> Đã thanh toán
                        </div>
                        <div class="form-group col">
                            <label for="">Hình thức thanh toán</label> <br>
                            <select name="kh_tendangnhap" id="kh_tendangnhap" class="form-control">
                                <?php foreach ($httt as $ct) : ?>
                                    <option value="<?= $ct['httt_ma'] ?>"><?= $ct['httt_ten'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <fieldset id="chiTietDonHangContainer">
                        <h3>Chi tiết đơn hàng</h3>
                        <div class="row">
                            <div class="col">
                                <label>Sản phẩm: </label>
                                <select class="form-control" name="sp_ma" id="sp_ma">
                                    <option value="">Vui lòng chọn sản phẩm</option>
                                    <?php foreach ($ds_sanpham as $sp) : ?>
                                        <option value="<?= $sp['sp_ma']; ?> " data-sp_gia="<?= $sp['sp_gia']; ?>"><?= $sp['sp_ten']; ?> - <?= $sp['sp_gia']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col">
                                <label> Số lượng:</label>
                                <input type="number" name="soluong" id="soluong" class="form-control">
                            </div>
                            <div class="col">
                                <label>Xử lý</label> <br>
                                <button type="button" class="btn btn-secondary" id="btnThemSP">Thêm vào đơn hàng</button>
                            </div>
                        </div>
                        <table id="tblChiTietDonHang" class="table table-bordered">
                            <thead>
                                <th>Sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Đơn giá</th>
                                <th>Thành tiền</th>
                                <th>Hành động</th>
                            </thead>
                            <tbody>
                            </tbody>

                        </table>
                    </fieldset>
                    <button name="btnSave" class="btn btn-primary">Lưu đơn hàng</button>
                </form>

            </div>
            <!-- end Content -->
        </div>
    </div>

    <!-- footer -->
    <?php include_once(__DIR__ . '/../../layouts/partials/footer.php'); ?>
    <!-- end footer -->

    <!-- Nhúng file quản lý phần SCRIPT JAVASCRIPT -->
    <?php include_once(__DIR__ . '/../../layouts/scripts.php'); ?>

    <!-- Các file Javascript sử dụng riêng cho trang này, liên kết tại đây -->
    <!-- <script src="..."></script> -->
    <script src="/salomon/assets/vendor/DataTables/datatables.min.js"></script>
    <script src="/salomon/assets/vendor/DataTables/Buttons-1.6.5/js/buttons.bootstrap4.min.js"></script>
    <script src="/salomon/assets/vendor/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script src="/salomon/assets/vendor/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script>
        $('#btnThemSP').click(function() {
            // Lấy thông tin sản phẩm
            var sp_ma = $('#sp_ma').val();
            var sp_gia = $('#sp_ma option:selected').data('sp_gia');
            var sp_ten = $('#sp_ma option:selected').text();
            var soluong = $('#soluong').val();
            var thanhtien = (soluong * sp_gia);

            // Tạo mẫu trong html table
            var htmlStr = '<tr>';
            htmlStr += '<td>' + sp_ten + '<input type="hidden" name="sp_ma[]" value="' + sp_ma + '" /></td>';
            htmlStr += '<td>' + soluong + '<input type="hidden" name="sp_dh_soluong[]" value="' + soluong + '" /></td>';
            htmlStr += '<td>' + sp_gia + '<input type="hidden" name="sp_dh_dongia[]" value="' + sp_gia + '" /></td>';
            htmlStr += '<td>' + thanhtien + '</td>';
            htmlStr += '<td><button type="button" class="btn btn-danger btn-delete-row">Xoá</button>';
            htmlStr += '</tr>';
            // Thêm vào table
            $('#tblChiTietDonHang tbody').append(htmlStr);

            //Clear
            $('#sp_ma').val('');
            $('#soluong').val('');

            // Đăng ký sự kiện xóa chi tiết đơn hàng
            $('#chiTietDonHangContainer').on('click', '.btn-delete-row', function() {
                $(this).parent().parent()[0].remove();
            });
        });
    </script>
</body>

</html>