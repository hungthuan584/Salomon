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
                    <h1 class="h2">Danh sách sản phẩm</h1>
                </div>


                <?php
                    // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
                    include_once(__DIR__ . '/../../../dbconnect.php');

                    // 2. Chuẩn bị câu truy vấn $sql
                    $stt = 1;
                    $sql =  <<<EOT
                    SELECT *
                    FROM sanpham AS sp
                    JOIN loaisanpham AS lsp ON sp.lsp_ma = lsp.lsp_ma
                    JOIN nhasanxuat AS nsx ON sp.nsx_ma = nsx.nsx_ma
                    LEFT JOIN khuyenmai AS km ON sp.km_ma = km.km_ma                    
EOT;

                    // 3. Thực thi câu truy vấn SQL để lấy về dữ liệu
                    $result = mysqli_query($conn, $sql);


                    $ds_sanpham = [];
                    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                        $km_tomtat = '';
                        if (!empty($row['km_ten'])){
                            $km_tomtat = sprintf("Khuyến mãi %s, %s từ %s-%s",
                                $row['km_ten'],
                                $row['km_noidung'],
                                $row['km_tungay'],
                                $row['km_denngay']
                            );
                        }

                        $ds_sanpham[] = array(
                            'sp_ma' => $row['sp_ma'],
                            'sp_ten' => $row['sp_ten'],
                            'sp_gia' => number_format($row['sp_gia'],"2",".",",").'VND',
                            'sp_giacu' => number_format($row['sp_giacu'],"2",".",",").'VND',
                            'sp_mota_ngan' => $row['sp_mota_ngan'],
                            'sp_mota_chitiet' => $row['sp_mota_chitiet'],
                            'sp_ngaycapnhat' => date('d/m/Y H:i:s', strtotime($row['sp_ngaycapnhat'])),
                            'sp_soluong' => number_format($row['sp_soluong'],"0",".",",").'VND',
                            'lsp_ma' => $row['lsp_ma'],
                            'nsx_ma' => $row['nsx_ma'],
                            'km_ma' => $row['km_ma'],
                            'lsp_ten' => $row['lsp_ten'],
                            'nsx_ten' => $row['nsx_ten'],
                            'km_tomtat' => $km_tomtat
                        );
                    }
                ?>

                <!-- Thêm mới sản phẩm -->
                <a href="create.php" class="btn btn-primary">
                    Thêm mới
                </a>

                <table id="tblSP" width="100%" class="table table-dark">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Mã SP</th>
                            <th>Tên SP</th>
                            <th>Giá</th>
                            <th>Giá cũ</th>
                            <th>Mô tả ngắn</th>
                            <th>Ngày CN</th>
                            <th>SL</th>
                            <th>Loại SP</th>
                            <th>NSX</th>
                            <th>Khuyến mãi</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php foreach ($ds_sanpham as $sp) : ?>
                        <tr>
                            <td > <?= $stt; $stt+=1;?> </td>
                            <td> <?= $sp['sp_ma']; ?> </td>
                            <td> <?= $sp['sp_ten']; ?> </td>
                            <td> <?= $sp['sp_gia']; ?> </td>
                            <td> <?= $sp['sp_giacu']; ?> </td>
                            <td> <?= $sp['sp_mota_ngan']; ?> </td>
                            <td> <?= $sp['sp_ngaycapnhat']; ?> </td>
                            <td> <?= $sp['sp_soluong']; ?> </td>
                            <td><?= $sp['lsp_ten']; ?></td>
                            <td> <?= $sp['nsx_ten']; ?> </td>
                            <td> <?= $sp['km_tomtat']; ?> </td>
                            <td>
                                <a href="edit.php?sp_ma=<?= $sp['sp_ma']?>" class="btn btn-warning">
                                    <span data-feather="edit"></span> Sửa
                                </a>
                            </td>
                            <td>
                                <a href="delete.php?sp_ma=<?= $sp['sp_ma']?>" class="btn btn-danger">
                                        <span data-feather="delete" ></span> Xóa
                                </a>
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
    $(document).ready( function () {
        $('#tblSP').DataTable({
            dom: 'Blfrtip',
            buttons: [
            'copy', 'excel', 'pdf'
            ]
        });
    } );
  </script>

  <!-- Các file Javascript sử dụng riêng cho trang này, liên kết tại đây -->
  <!-- <script src="..."></script> -->
</body>

</html>