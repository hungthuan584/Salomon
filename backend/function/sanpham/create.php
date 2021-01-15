<!-- Nhúng file cấu hình để xác định được Tên và Tiêu đề của trang hiện tại người dùng đang truy cập -->
<?php include_once(__DIR__ . '/../../layouts/config.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Nhúng file quản lý phần HEAD -->
    <?php include_once(__DIR__ . '/../../layouts/head.php'); ?>
</head>
<body class="container-fluid">
    <div class="row">
        <!-- sidebar -->
    <?php include_once(__DIR__ . '/../../layouts/partials/sidebar.php'); ?>
    <!-- end sidebar -->

    <div class="col-md-9">
        <?php
            // Kết nối csdl
        include_once(__DIR__ . '/../../../dbconnect.php');
            // Chuẩn bị câu truy vấn
        $sqlSelectLSP = "SELECT * FROM loaisanpham";
        $sqlSelectNSX = "SELECT * FROM nhasanxuat";
        $sqlSelectKM = "SELECT * FROM khuyenmai";
            // Thực thi câu truy vấn
        $resultSelectLSP = mysqli_query($conn, $sqlSelectLSP);
        $resultSelectNSX = mysqli_query($conn, $sqlSelectNSX);
        $resultSelectKM = mysqli_query($conn, $sqlSelectKM);

        $ds_loaisanpham = [];
        while ($row1 = mysqli_fetch_array($resultSelectLSP, MYSQLI_ASSOC)) {
            $ds_loaisanpham[] = array(
                'lsp_ma' => $row1['lsp_ma'],
                'lsp_ten' => $row1['lsp_ten']
            );
        }


        $ds_nhasanxuat = [];
        while ($row2 = mysqli_fetch_array($resultSelectNSX, MYSQLI_ASSOC)) {
            $ds_nhasanxuat[] = array(
                'nsx_ma' => $row2['nsx_ma'],
                'nsx_ten' => $row2['nsx_ten']
            );
        }

        $ds_khuyenmai = [];
        while ($row3 = mysqli_fetch_array($resultSelectKM, MYSQLI_ASSOC)) {
            $ds_khuyenmai[] = array(
                'km_ma' => $row3['km_ma'],
                'km_ten' => $row3['km_ten'],
                'km_noidung' => $row3['km_noidung']
            );
        }

        ?>
        <!-- Content -->
        <h1>Thêm sản phẩm</h1>
        <form method="post" name="frmThemSP" id="frmThemSP">
            <div class="form-group">
                <label>Tên sản phẩm</label>
                <input type="text" name="sp_ten" id="sp_ten" class="form-control">
            </div>
            <div class="form-group">
                <label>Giá sản phẩm</label>
                <input type="number" name="sp_gia" id="sp_gia" class="form-control">
            </div>
            <div class="form-group">
                <label>Giá cũ sản phẩm</label>
                <input type="number" name="sp_giacu" id="sp_giacu" class="form-control">
            </div>
            <div class="form-group">
                <label>Mô tả ngắn</label>
               <textarea name="sp_mota_ngan" id="sp_mota_ngan" class="form-control" rows="5"></textarea>
            </div>
            <div class="form-group">
                <label>Mô tả chi tiết</label>
                <textarea name="sp_mota_chitiet" id="sp_mota_chitiet" class="form-control" rows="10"></textarea>
            </div>
            <div class="form-group">
                <label>Ngày cập nhật</label>
                <input type="text" name="sp_ngaycapnhat" id="sp_ngaycapnhat" class="form-control">
            </div>
            <div class="form-group">
                <label>Số lượng</label>
                <input type="number" name="sp_soluong" id="sp_soluong" class="form-control">
            </div>
            <div class="form-group">
                <label>Loại sản phẩm</label>
                <select name="lsp_ma" id="lsp_ma" class="form-control">
                    <?php foreach ($ds_loaisanpham as $lsp) : ?>
                    <option value="<?= $lsp['lsp_ma']; ?>"><?= $lsp['lsp_ten']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label>Nhà sản xuất</label>
                <select name="nsx_ma" id="nsx_ma" class="form-control">
                    <?php foreach ($ds_nhasanxuat as $nsx) : ?>
                    <option value="<?= $nsx['nsx_ma']; ?>"><?= $nsx['nsx_ten']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
            <label>Khuyến mãi</label>
                <select name="nsx_ma" id="nsx_ma" class="form-control">
                    <option value="">Không áp dụng khuyến mãi</option>
                    <?php foreach ($ds_khuyenmai as $km) : ?>
                    <option value="<?= $km['km_ma']; ?>"><?= $km['km_noidung']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="from-control">
                <button name="btnSave" id="btnSave" class="btn btn-primary">Lưu</button>
            </div>
        </form>
        <?php
        if (isset($_POST['btnSave'])) {
            $sp_ten = $_POST['sp_ten'];
            $sp_gia = $_POST['sp_gia'];
            $sp_giacu = $_POST['sp_giacu'];
            $sp_mota_ngan = $_POST['sp_mota_ngan'];
            $sp_mota_chitiet = $_POST['sp_mota_chitiet'];
            $sp_ngaycapnhat = $_POST['sp_ngaycapnhat'];
            $sp_soluong = $_POST['sp_soluong'];
            $lsp_ma = $_POST['lsp_ma'];
            $nsx_ma = $_POST['nsx_ma'];
            $km_ma = (empty($_POST['km_ma']) ? 'NULL' : $_POST['km_ma']);


            $sql = <<<EOT
            INSERT INTO sanpham
            (sp_ten, sp_gia, sp_giacu, sp_mota_ngan, sp_mota_chitiet, sp_ngaycapnhat, sp_soluong, lsp_ma, nsx_ma, km_ma)
            VALUES ('$sp_ten',$sp_gia, $sp_giacu, '$sp_mota_ngan', '$sp_mota_chitiet', '$sp_ngaycapnhat', $sp_soluong, $lsp_ma, $nsx_ma, $km_ma)
EOT;
            $result = mysqli_query($conn, $sql);
            echo '<script>location.href ="index.php";</script>';
        }

        ?>


        <!-- Endcontent -->
    </div>
    </div>
</body>
</html>