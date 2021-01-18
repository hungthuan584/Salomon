<!-- Nhúng file cấu hình để xác định được Tên và Tiêu đề của trang hiện tại người dùng đang truy cập -->
<?php include_once(__DIR__ . '/../layouts/config.php'); ?>

<!DOCTYPE html>
<html>

<head>
  <!-- Nhúng file quản lý phần HEAD -->
  <?php include_once(__DIR__ . '/../layouts/head.php'); ?>
  <link rel="stylesheet" href="/Salomon/assets/vendor/DataTables/datatables.min.css" type="text/css">
  <link rel="stylesheet" href="/Salomon/assets/vendor/DataTables/Buttons-1.6.5/css/buttons.bootstrap4.min.css" type="text/css">
  <link rel="stylesheet" href="/Salomon/assets/vendor/chartJS/Chart.min.css" type="text/css">
</head>

<body class="d-flex flex-column h-100">
  <!-- header -->
  <?php include_once(__DIR__ . '/../layouts/partials/header.php'); ?>
  <!-- end header -->

  <div class="container-fluid">
        <div class="row">
                <!-- sidebar -->
                <?php include_once(__DIR__ . '/../layouts/partials/sidebar.php'); ?>
                <!-- end sidebar -->

            <div class="col-md-9">
                <!-- content -->
                <div class="row">
                    <div class="col-md-3 text-center">
                        <div id="baocao_SLSP" class="bg-primary">
                        <h1>0</h1>
                        <p>Tổng số lượng sản phẩm</p>
                        </div>
                        <button id="refresh_baocaoSLSP" class="btn btn-primary">Refresh số lượng sản phẩm</button>
                    </div>

                    <div class="col-md-3 text-center">
                        <div id="baocao_SLDH" class="bg-warning">
                        <h1>0</h1>
                        <p>Tổng số lượng đơn hàng</p>
                        </div>
                        <button id="refresh_baocaoSLDH" class="btn btn-primary">Refresh số lượng đơn hàng</button>
                    </div>

                    <div class="col-md-3 text-center">
                        <div id="baocao_SLKH" class="bg-success">
                        <h1>0</h1>
                        <p>Tổng số lượng khách hàng</p>
                        </div>
                        <button id="refresh_baocaoSLKH" class="btn btn-primary">Refresh số lượng khách hàng</button>
                    </div>

                    <div class="col-md-3 text-center">
                        <div id="baocao_SLGY" class="bg-danger">
                        <h1>0</h1>
                        <p>Tổng số lượng góp ý</p>
                        </div>
                        <button id="refresh_baocaoSLGY" class="btn btn-primary">Refresh số lượng góp ý</button>
                    </div>

                </div>
                <div class="row">
                <!-- Biểu đồ thống kê loại sản phẩm -->
                <div class="col-sm-6 col-lg-6">
                    <canvas id="chartOfobjChartThongKeLoaiSanPham"></canvas>
                    <button class="btn btn-outline-primary btn-sm form-control" id="refreshThongKeLoaiSanPham">Refresh dữ liệu</button>
                </div><!-- col -->
                </div>
                <!-- end content -->

            </div>

        </div>
  </div>

  <!-- footer -->
  <?php include_once(__DIR__ . '/../layouts/partials/footer.php'); ?>
  <!-- end footer -->

  <!-- Nhúng file quản lý phần SCRIPT JAVASCRIPT -->
  <?php include_once(__DIR__ . '/../layouts/scripts.php'); ?>
  <script src="/Salomon/assets/vendor/DataTables/datatables.min.js"></script>
  <script src="/Salomon/assets/vendor/DataTables/Buttons-1.6.5/js/buttons.bootstrap4.min.js"></script>
  <script src="/Salomon/assets/vendor/DataTables/pdfmake-0.1.36/pdfmake.js"></script>
  <script src="/Salomon/assets/vendor/DataTables/pdfmake-0.1.36/vfs_fonts.js"></script>
  <script src="/Salomon/assets/vendor/chartJS/Chart.min.js"></script>
  <script>
    $(document).ready( function () {
        // Hàm refresh SLSP
        function getDataSLSP(){
            $.ajax('/Salomon/backend/ajax/baocao_hanghoa.php',{
                success: function(data){
                    var dataObj = JSON.parse(data);
                    var htmlString = '<h1>'+ dataObj.soLuongSP +'</h1><p>Tổng số lượng sản phẩm</p>';
                    $('#baocao_SLSP').html(htmlString);
                    debugger;
                },
                error: function(jqXHR,textStatus,errorThrown){
                    alert('Có lỗi xảy ra, vui lòng thực hiện lại'+ errorThrown);
                }
            });
        }
        // Hàm refresh SLDH
        function getDataSLDH(){
            $.ajax('/Salomon/backend/ajax/baocao_donhang.php',{
                success: function(data){
                    var dataObj = JSON.parse(data);
                    var htmlString = '<h1>'+ dataObj.soLuongDH +'</h1><p>Tổng số lượng đơn hàng</p>';
                    $('#baocao_SLDH').html(htmlString);
                },
                error: function(jqXHR,textStatus,errorThrown){
                    alert('Có lỗi xảy ra, vui lòng thực hiện lại'+ errorThrown);
                }
            });
        }

        // Hàm refresh SLKH
        function getDataSLKH(){
            $.ajax('/Salomon/backend/ajax/baocao_khachhang.php',{
                success: function(data){
                    var dataObj = JSON.parse(data);
                    var htmlString = '<h1>'+ dataObj.soLuongKH +'</h1><p>Tổng số lượng khách hàng</p>';
                    $('#baocao_SLKH').html(htmlString);
                },
                error: function(jqXHR,textStatus,errorThrown){
                    alert('Có lỗi xảy ra, vui lòng thực hiện lại'+ errorThrown);
                }
            });
        }
        // Hàm refresh SLGY
        function getDataSLGY(){
            $.ajax('/Salomon/backend/ajax/baocao_gopy.php',{
                success: function(data){
                    var dataObj = JSON.parse(data);
                    var htmlString = '<h1>'+ dataObj.soLuongGopY +'</h1><p>Tổng số lượng góp ý</p>';
                    $('#baocao_SLGY').html(htmlString);
                },
                error: function(jqXHR,textStatus,errorThrown){
                    alert('Có lỗi xảy ra, vui lòng thực hiện lại'+ errorThrown);
                }
            });
        }


        // ------------------ Vẽ biểu đồ thống kê Loại sản phẩm -----------------
        // Vẽ biểu đổ Thống kê Loại sản phẩm sử dụng ChartJS
        var $objChartThongKeLoaiSanPham;
        var $chartOfobjChartThongKeLoaiSanPham = document.getElementById("chartOfobjChartThongKeLoaiSanPham").getContext("2d");

        function renderChartThongKeLoaiSanPham() {
            $.ajax({
                url: '/Salomon/backend/ajax/baocao_loaisanpham.php',
                type: "GET",
                success: function(response) {
                    var data = JSON.parse(response);
                    var myLabels = [];
                    var myData = [];
                    $(data).each(function() {
                        myLabels.push((this.tenLSP));
                        myData.push(this.SoLSP);
                    });
                    myData.push(0); // tạo dòng số liệu 0
                    if (typeof $objChartThongKeLoaiSanPham !== "undefined") {
                        $objChartThongKeLoaiSanPham.destroy();
                    }
                    $objChartThongKeLoaiSanPham = new Chart($chartOfobjChartThongKeLoaiSanPham, {
                    // Kiểu biểu đồ muốn vẽ. Các bạn xem thêm trên trang ChartJS
                        type: "bar",
                        data: {
                            labels: myLabels,
                            datasets: [{
                                data: myData,
                                borderColor: "#9ad0f5",
                                backgroundColor: "#9ad0f5",
                                borderWidth: 1
                            }]
                        },
                    // Cấu hình dành cho biểu đồ của ChartJS
                    options: {
                        legend: {
                            display: false
                        },
                        title: {
                            display: true,
                            text: "Thống kê Loại sản phẩm"
                        },
                        responsive: true
                    }
                    });
                }
            });
        };

        $('#refresh_baocaoSLSP').click(function(){
            getDataSLSP();
        });
        $('#refresh_baocaoSLDH').click(function(){
            getDataSLDH();
        });

        $('#refresh_baocaoSLKH').click(function(){
            getDataSLKH();
        });

        $('#refresh_baocaoSLGY').click(function(){
            getDataSLGY();
        });
        $('#refreshThongKeLoaiSanPham').click(function(event) {
            event.preventDefault();
            renderChartThongKeLoaiSanPham();
        });
        getDataSLSP();
        getDataSLDH();
        getDataSLKH();
        getDataSLGY();
        renderChartThongKeLoaiSanPham()
    });
  </script>

  <!-- Các file Javascript sử dụng riêng cho trang này, liên kết tại đây -->
  <!-- <script src="..."></script> -->
</body>

</html>