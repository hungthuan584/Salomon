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
                    <h1 class="h2">Thêm đơn hàng</h1>
                </div>
                <?php
                    
                ?>

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
        $('#tblDH').DataTable({
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