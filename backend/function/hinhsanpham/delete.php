<?php
// 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
include_once(__DIR__ . '/../../../dbconnect.php');

// Lấy giá trị khóa chính được truyền theo dạng QueryString Parameter key1=value1&key2=value2...
$hsp_ma = $_GET['hsp_ma'];

$sqlSelect = "SELECT * FROM hinhsanpham WHERE hsp_ma = $hsp_ma";
$resultSelect = mysqli_query($conn,$sqlSelect);
$row1 = mysqli_fetch_array($resultSelect,MYSQLI_ASSOC);

$upload_dir = __DIR__.'/../../../assets/uploads/';
$subdir = 'products/';
$old_file = $upload_dir . $subdir . $row1['hsp_tentaptin'];
if (file_exists($old_file)) {
    // Hàm unlink(filepath) dùng để xóa file trong PHP
    unlink($old_file);
}

$sqlDelete = "DELETE FROM hinhsanpham WHERE hsp_ma= $hsp_ma";

// Thực thi
$result = mysqli_query($conn,$sqlDelete);
echo '<script>location.href = "index.php";</script>';
//
?>