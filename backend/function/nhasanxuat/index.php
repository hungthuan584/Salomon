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
                    <h1>Danh sách nhà sản xuất</h1>
                </div>
                
                <?php
                     // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn

                    include_once(__DIR__.'/../../../dbconnect.php');

                    // 2. Chuẩn bị câu truy vấn $sql

                    $stt =1;
                    $sql = "SELECT nsx_ma, nsx_ten FROM nhasanxuat";

                    //
                    $result = mysqli_query($conn,$sql);

                    $ds_nhasanxuat = [];
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                        $ds_nhasanxuat[] = array(
                            'nsx_ma' => $row['nsx_ma'],
                            'nsx_ten' => $row['nsx_ten'],
                        );
                    }
                ?>

                <!-- Them moi nha san xuat -->
                <a href="create.php" class="btn btn-primary">
                    Thêm mới
                </a>

                <table class="table table-dark">
                    <tr>
                        <th class="text-center">#</th>
                        <th>Mã nhà sản xuất</th>
                        <th>Tên nhà sản xuất</th>
                    </tr>

                    <?php foreach ($ds_nhasanxuat as $nsx): ?>
                    <tr>
                        <td class="text-center"><?= $stt; $stt+=1; ?></td>
                        <td class="text-center"><?= $nsx['nsx_ma']; ?></td>
                        <td><?= $nsx['nsx_ten']; ?></td>
                        <td>
                            <a href="edit.php?nsx_ma=<?=$nsx['nsx_ma']?>" class="btn btn-warning">
                            <span data-feather="edit"></span> Sửa
                            </a>
                            <a href="edit.php?nsx_ma=<?=$nsx['nsx_ma']?>" class="btn btn-danger">
                            <span data-feather="delete" ></span> Xóa
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
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
  <!-- <script src="..."></script> -->
</body>

</html>