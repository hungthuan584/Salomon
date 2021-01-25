<!-- Nhúng file cấu hình để xác định được Tên và Tiêu đề của trang hiện tại người dùng đang truy cập -->
<?php include_once(__DIR__ . '/../../layouts/config.php'); ?>
<!DOCTYPE html>
<html>
<head>
    <!-- Nhúng phần file head.php -->
    <?php include_once(__DIR__.'/../../layouts/head.php'); ?>
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
                //Cau lệnh
                $sql = <<<EOT
                    SELECT * FROM khachhang
EOT;
                $result = mysqli_query($conn,$sql);
                $kh = [];
                while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                    $kh[] = array(
                        'kh_tendangnhap' => $row['kh_tendangnhap'],
                        'kh_ten' => $row['kh_ten'],
                        'kh_dienthoai' => $row['kh_dienthoai'],
                        'kh_diachi' => $row['kh_diachi']
                    );
                }


                $sql = <<<EOT
                    SELECT * FROM hinhthucthanhtoan
EOT;
                $result = mysqli_query($conn,$sql);
                $httt = [];
                while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
                    $kh[] = array(
                        'httt_ma' => $row['httt_ma'],
                        'httt_ten' => $row['httt_ten'],
                    );
                }
                ?>
                <h2>Thêm mới đơn hàng</h2>
                <form action="">
                    <h3>Thông tin đơn hàng</h3>
                    <div class="form-group">
                        <label for="">Khách hàng</label>
                        <select name="kh_tendangnhap" id="kh_tendangnhap" class="form-control">
                            <?php foreach($kh as $ct): ?>
                                <option value="<?= $ct['kh_tendangnhap'] ?>"><?= $ct['kh_ten']?></option>
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
                            <?php foreach($httt as $ct): ?>
                                <option value="<?= $ct['httt_ma'] ?>"><?= $ct['httt_ten']?></option>
                            <?php endforeach; ?>
                        </select>
                        </div>
                    </div>
                </form>
                
            </div>
            <!-- end Content -->
        </div>
    </div>

    <!-- footer -->
    <?php include_once(__DIR__ . '/../../layouts/partials/footer.php'); ?>
    <!-- end footer -->

    <!-- Nhúng file quản lý phần SCRIPT JAVASCRIPT -->
    <?php include_once(__DIR__ . '/../../layouts/script.php'); ?>

    <!-- Các file Javascript sử dụng riêng cho trang này, liên kết tại đây -->
    <!-- <script src="..."></script> -->
    <script src="/salomon/assets/vendor/DataTables/datatables.min.js"></script>
    <script src="/salomon/assets/vendor/DataTables/Buttons-1.6.5/js/buttons.bootstrap4.min.js"></script>
    <script src="/salomon/assets/vendor/DataTables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script src="/salomon/assets/vendor/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
</body>
</html>