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
            $sqlSelect = "SELECT * FROM sanpham";
            // 
            $resultSelect = mysqli_query($conn, $sqlSelect);
            $ds_sanpham = [];
            while($row1 = mysqli_fetch_array($resultSelect, MYSQLI_ASSOC)){
                $ds_sanpham[]=array(
                    'sp_ma' => $row1['sp_ma'],
                    'sp_ten' => $row1['sp_ten']
                );
            }
            ?>

            <!-- content -->
                <h1>Thêm hình sản phẩm</h1>
                <form action="" method="post" name="frmHinhSanPham" enctype="multipart/form-data">
                  <div class="form-group">
                    <label>Sản phẩm</label> <br>
                    <select name="sp_ma" id="sp_ma" class="form-control">
                        <?php foreach($ds_sanpham as $sp) : ?>
                        <option value="<?= $sp['sp_ma'];?>"><?= $sp['sp_ten'];?></option>
                        <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <img src="/Salomon/shared/default-image.jpg" id="preview-img" width="200px">
                  </div>
                  <div class="form-group">
                    <label>Hình ảnh</label> <br>
                   <input type="file" name="hsp_tentaptin" id="hsp_tentaptin" class="form-control">
                  </div>
                  <button class="btn btn-primary" name="btnSave">Lưu lại</button>
                </form>
            <!-- endcontent -->
            <?php
            if (isset($_POST['btnSave'])){
                $sp_ma = $_POST['sp_ma'];
                
                $upload_dir = __DIR__.'/../../../assets/uploads/';
                $subdir = 'products/';

                if ($_FILES['hsp_tentaptin']['error'] > 0){
                    echo 'File Upload Bị Lỗi'; die;
                }
                else{
                    $hsp_tentaptin = $_FILES['hsp_tentaptin']['name'];
                    $tentaptin = date('Ymd') . '_' . $hsp_tentaptin;
                    move_uploaded_file($_FILES['hsp_tentaptin']['tmp_name'], $upload_dir.$subdir.$tentaptin);
                }
                $sqlInsert = "INSERT INTO `hinhsanpham` (hsp_tentaptin, sp_ma) VALUES ('$tentaptin',$sp_ma)";
                $resultInsert = mysqli_query($conn,$sqlInsert);
                echo "<script>location.href = 'index.php';</script>";
            }

            

            ?>
        </div>
    </div>
  </div>

  <!-- footer -->
  <?php include_once(__DIR__ . '/../../layouts/partials/footer.php'); ?>
  <!-- end footer -->

  <!-- Nhúng file quản lý phần SCRIPT JAVASCRIPT -->
  <?php include_once(__DIR__ . '/../../layouts/scripts.php'); ?>

  <!-- Các file Javascript sử dụng riêng cho trang này, liên kết tại đây -->
  <script>
    // Hiển thị ảnh preview (xem trước) khi người dùng chọn Ảnh
    const reader = new FileReader();
    const fileInput = document.getElementById("hsp_tentaptin");
    const img = document.getElementById("preview-img");
    reader.onload = e => {
      img.src = e.target.result;
    }
    fileInput.addEventListener('change', e => {
      const f = e.target.files[0];
      reader.readAsDataURL(f);
    })
  </script>
</body>

</html>