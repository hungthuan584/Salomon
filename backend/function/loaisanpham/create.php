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
                <h1>Thêm loại sản phẩm</h1>
                <form action="" method="post" name="frmLoaiSanPham" id="frmLoaiSanPham">
                  <div class="form-group">
                    <label for="">Tên loại sản phẩm</label> <br>
                    <input type="text" name="lsp_ten" id="lsp_ten" class="form-control" placeholder="Nhập tên loại sản phẩm">
                  </div>
                  <div class="form-group">
                    <label for="">Mô tả</label> <br>
                    <textarea name="lsp_mota" id="lsp_mota" cols="30" rows="10" class="form-control" placeholder="Nhập mô tả loại sản phẩm"></textarea>
                  </div>
                  <button class="btn btn-primary" name="btnSave">Lưu lại</button>
                </form>

                <?php
                if (isset($_POST['btnSave'])) {
                    // 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
                  include_once(__DIR__ . '/../../../dbconnect.php');

                    // 2. Chuẩn bị câu truy vấn $sql
                  $lsp_ten = $_POST['lsp_ten'];
                  $lsp_mota = $_POST['lsp_mota'];

                  // Kiểm tra ràng buộc dữ liệu (Validation)
                  // Tạo biến lỗi để chứa thông báo lỗi
                  $errors = [];

                  // Validate Tên loại Sản phẩm
                  // required
                  if (empty($lsp_ten)) {
                    $errors['lsp_ten'][] = [
                      'rule' => 'required',
                      'rule_value' => true,
                      'value' => $lsp_ten,
                      'msg' => 'Vui lòng nhập tên Loại sản phẩm'
                    ];
                  }

                  // minlength 3
                  if (!empty($lsp_ten) && strlen($lsp_ten) < 3) {
                    $errors['lsp_ten'][] = [
                      'rule' => 'minlength',
                      'rule_value' => 3,
                      'value' => $lsp_ten,
                      'msg' => 'Tên Loại sản phẩm phải có ít nhất 3 ký tự'
                    ];
                  }
                  // maxlength 50
                  if (!empty($lsp_ten) && strlen($lsp_ten) > 50) {
                    $errors['lsp_ten'][] = [
                      'rule' => 'maxlength',
                      'rule_value' => 50,
                      'value' => $lsp_ten,
                      'msg' => 'Tên Loại sản phẩm không được vượt quá 50 ký tự'
                    ];
                  }

                  // Validate Diễn giải
                  // required
                  if (empty($lsp_mota)) {
                    $errors['lsp_mota'][] = [
                      'rule' => 'required',
                      'rule_value' => true,
                      'value' => $lsp_mota,
                      'msg' => 'Vui lòng nhập mô tả Loại sản phẩm'
                    ];
                  }

                  // minlength 3
                  if (!empty($lsp_mota) && strlen($lsp_mota) < 3) {
                    $errors['lsp_mota'][] = [
                      'rule' => 'minlength',
                      'rule_value' => 3,
                      'value' => $lsp_mota,
                      'msg' => 'Mô tả loại sản phẩm phải có ít nhất 3 ký tự'
                    ];
                  }

                  // maxlength 255
                  if (!empty($lsp_mota) && strlen($lsp_mota) > 255) {
                    $errors['lsp_mota'][] = [
                      'rule' => 'maxlength',
                      'rule_value' => 255,
                      'value' => $lsp_mota,
                      'msg' => 'Mô tả loại sản phẩm không được vượt quá 255 ký tự'
                    ];
                  }
                }
                  
                  
                ?>

                <?php if (
                          isset($_POST['btnSave'])  // Nếu người dùng có bấm nút "Lưu dữ liệu"
                          && isset($errors)         // Nếu biến $errors có tồn tại
                          && (!empty($errors))      // Nếu giá trị của biến $errors không rỗng
                        ) :?>
                          <div id="errors-container" class="alert alert-danger face my-2" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                              <ul>
                                <?php foreach ($errors as $fields) : ?>
                                  <?php foreach ($fields as $field) : ?>
                                    <li><?php echo $field['msg']; ?></li>
                                  <?php endforeach; ?>
                                <?php endforeach; ?>
                              </ul>
                          </div>
                <?php endif; ?>

                <?php
                if (
                  isset($_POST['btnSave'])  // Nếu người dùng có bấm nút "Lưu dữ liệu"
                  && (!isset($errors) || (empty($errors))) // Nếu biến $errors không tồn tại Hoặc giá trị của biến $errors rỗng
                ) {
                  $sql = "INSERT INTO loaisanpham (lsp_ten, lsp_mota) VALUES ('$lsp_ten', '$lsp_mota')";

                  // 3. Thực thi câu truy vấn SQL để lấy về dữ liệu
                  $result = mysqli_query($conn, $sql);
                  mysqli_close($conn);

                  echo '<script>location.href = "index.php";</script>';
                }
                ?>
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
  <script>
    $(document).ready(function() {
      $("#frmLoaiSanPham").validate({
        rules: {
          lsp_ten: {
            required: true,
            minlength: 3,
            maxlength: 50
          },
          lsp_mota: {
            required: true,
            minlength: 3,
            maxlength: 255
          }
        },
        messages: {
          lsp_ten: {
            required: "Vui lòng nhập tên Loại sản phẩm",
            minlength: "Tên Loại sản phẩm phải có ít nhất 3 ký tự",
            maxlength: "Tên Loại sản phẩm không được vượt quá 50 ký tự"
          },
          lsp_mota: {
            required: "Vui lòng nhập mô tả cho Loại sản phẩm",
            minlength: "Mô tả cho Loại sản phẩm phải có ít nhất 3 ký tự",
            maxlength: "Mô tả cho Loại sản phẩm không được vượt quá 255 ký tự"
          },
        },
        errorElement: "em",
        errorPlacement: function(error, element) {
          // Thêm class `invalid-feedback` cho field đang có lỗi
          error.addClass("invalid-feedback");
          if (element.prop("type") === "checkbox") {
            error.insertAfter(element.parent("label"));
          } else {
            error.insertAfter(element);
          }
        },
        success: function(label, element) {},
        highlight: function(element, errorClass, validClass) {
          $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function(element, errorClass, validClass) {
          $(element).addClass("is-valid").removeClass("is-invalid");
        }
      });
    });
  </script>
</body>

</html>