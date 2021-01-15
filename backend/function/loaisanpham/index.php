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

                <!-- content -->
                <div class="text-center">
                    <h1 class="h2">Danh sách các loại sản phẩm</h1>
                </div>


                <?php
                    // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
                    include_once(__DIR__ . '/../../../dbconnect.php');

                    // 2. Chuẩn bị câu truy vấn $sql
                    $stt = 1;
                    $sql = "select * from `loaisanpham`";

                    // 3. Thực thi câu truy vấn SQL để lấy về dữ liệu
                    $result = mysqli_query($conn, $sql);


                    $ds_loaisanpham = [];
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $ds_loaisanpham[] = array(
                            'lsp_ma' => $row['lsp_ma'],
                            'lsp_ten' => $row['lsp_ten'],
                            'lsp_mota' => $row['lsp_mota'],
                        );
                    }
                ?>

                <!-- Thêm mới sản phẩm -->
                <a href="create.php" class="btn btn-primary">
                    Thêm mới
                </a>

                <table class="table table-dark">
                    <tr>
                        <th class="text-center">#</th>
                        <th>Mã loại</th>
                        <th>Tên loại</th>
                        <th>Mô tả</th>
                        <th>Hành động</th>
                    </tr>

                    <?php foreach ($ds_loaisanpham as $lsp) : ?>
                        <tr>
                            <td class="text-center"> <?= $stt; $stt+=1;?> </td>
                            <td> <?= $lsp['lsp_ma']; ?> </td>
                            <td> <?= $lsp['lsp_ten']; ?> </td>
                            <td> <?= $lsp['lsp_mota']; ?> </td>
                            <td>
                                <a href="edit.php?lsp_ma=<?= $lsp['lsp_ma']?>" class="btn btn-warning">
                                    <span data-feather="edit"></span> Sửa
                                </a>
                                <a href="delete.php?lsp_ma=<?= $lsp['lsp_ma']?>" class="btn btn-danger">
                                    <span data-feather="delete" ></span> Xóa
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
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

  <!-- Các file Javascript sử dụng riêng cho trang này, liên kết tại đây -->
  <!-- <script src="..."></script> -->
</body>

</html>