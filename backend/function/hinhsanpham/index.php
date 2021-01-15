<!-- Nhúng file cấu hình để xác định được Tên và Tiêu đề của trang hiện tại người dùng đang truy cập -->
<?php include_once(__DIR__ . '/../../layouts/config.php'); ?>

<!DOCTYPE html>
<html>

<head>
  <!-- Nhúng file quản lý phần HEAD -->
    <?php include_once(__DIR__ . '/../../layouts/head.php'); ?>
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
            <?php 
            //
            include_once(__DIR__.'/../../../dbconnect.php');
            //
            $sqlSelect = <<<EOT
            SELECT * FROM hinhsanpham hsp JOIN sanpham sp
            ON hsp.sp_ma = sp.sp_ma
EOT;
            //
            $resultSelect = mysqli_query($conn, $sqlSelect);
            $ds_hinhsanpham = [];
            while($row1 = mysqli_fetch_array($resultSelect, MYSQLI_ASSOC)){
                $ds_hinhsanpham[]=array(
                    'hsp_ma' => $row1['hsp_ma'],
                    'sp_ten' => $row1['sp_ten'],
                    'hsp_tentaptin' => $row1['hsp_tentaptin']
                );
            }
            ?>

            <!-- content -->
                <h1>Danh sách hình</h1>

                <a href="create.php" class="btn btn-primary">Thêm mới</a>
                <table id="tblHinhSP" name="tblHinhSP" class="table table-dark">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Hình ảnh</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($ds_hinhsanpham as $ds): ?>
                            <tr>
                                <td>
                                    <a href="edit.php?hsp_ma=<?= $ds['hsp_ma']?>" class="btn btn-warning">
                                        <span data-feather="edit"></span> Sửa
                                    </a>
                                    <a href="delete.php?hsp_ma=<?= $ds['hsp_ma']?>" class="btn btn-danger">
                                        <span data-feather="delete" ></span> Xóa
                                    </a>
                                </td>
                                <td><?= $ds['hsp_ma']; ?></td>
                                <td><?= $ds['sp_ten'];?></td>
                                <td><img src="/Salomon/assets/uploads/products/<?= $ds['hsp_tentaptin'];?>" width="100px"></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <!-- endcontent -->
            
        </div>

    </div>
  </div>

  <!-- footer -->
  <?php include_once(__DIR__ . '/../../layouts/partials/footer.php'); ?>
  <!-- end footer -->

  <!-- Nhúng file quản lý phần SCRIPT JAVASCRIPT -->
  <?php include_once(__DIR__ . '/../../layouts/scripts.php'); ?>

  <!-- Các file Javascript sử dụng riêng cho trang này, liên kết tại đây -->
</body>

</html>