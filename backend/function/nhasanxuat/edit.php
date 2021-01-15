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
              $nsx_ma = $_GET['nsx_ma'];

              include_once(__DIR__.'/../../../dbconnect.php');
              $sqlSelect = "SELECT * FROM `nhasanxuat` WHERE nsx_ma=$nsx_ma";

              $resultSelect = mysqli_query($conn, $sqlSelect);
              $nhasanxuatRow = mysqli_fetch_array($resultSelect, MYSQLI_ASSOC);
            ?>

            <!-- content -->
                <h1>Sửa nhà sản xuất</h1>
                <form action="" method="post" name="frmnhasanxuat" id="frmnhasanxuat">
                  <div class="form-group">
                    <label for="">Tên nhà sản xuất</label> <br>
                    <input type="text" name="nsx_ten" id="nsx_ten" class="form-control" placeholder="Nhập tên nhà sản xuất" value="<?= $nhasanxuatRow['nsx_ten']; ?>">
                  </div>
                  
                  <button class="btn btn-primary" name="btnSave">Lưu lại</button>
                </form>

                <?php
                if (isset($_POST['btnSave'])) {
                  // 2. Chuẩn bị câu truy vấn $sql
                  $nsx_ten = $_POST['nsx_ten'];
               

                  // Kiểm tra ràng buộc dữ liệu (Validation)
                  // Tạo biến lỗi để chứa thông báo lỗi
                  $errors = [];

                  // Validate Tên nhà sản xuất
                  // required
                  if (empty($nsx_ten)) {
                    $errors['nsx_ten'][] = [
                      'rule' => 'required',
                      'rule_value' => true,
                      'value' => $nsx_ten,
                      'msg' => 'Vui lòng nhập tên nhà sản xuất'
                    ];
                  }

                  // minlength 3
                  if (!empty($nsx_ten) && strlen($nsx_ten) < 3) {
                    $errors['nsx_ten'][] = [
                      'rule' => 'minlength',
                      'rule_value' => 3,
                      'value' => $nsx_ten,
                      'msg' => 'Tên nhà sản xuất phải có ít nhất 3 ký tự'
                    ];
                  }
                  // maxlength 50
                  if (!empty($nsx_ten) && strlen($nsx_ten) > 50) {
                    $errors['nsx_ten'][] = [
                      'rule' => 'maxlength',
                      'rule_value' => 50,
                      'value' => $nsx_ten,
                      'msg' => 'Tên nhà sản xuất không được vượt quá 50 ký tự'
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
                  $sqlEdit = <<<EOT
                  UPDATE nhasanxuat
                  SET
                    nsx_ten='$nsx_ten'
 
                  WHERE nsx_ma = $nsx_ma
EOT;

                  // 3. Thực thi câu truy vấn SQL để lấy về dữ liệu
                  $result = mysqli_query($conn, $sqlEdit);
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
      $("#frmnhasanxuat").validate({
        rules: {
          nsx_ten: {
            required: true,
            minlength: 3,
            maxlength: 50
          },
        
        },
        messages: {
          nsx_ten: {
            required: "Vui lòng nhập tên nhà sản xuất",
            minlength: "Tên nhà sản xuất phải có ít nhất 3 ký tự",
            maxlength: "Tên nhà sản xuất không được vượt quá 50 ký tự"
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