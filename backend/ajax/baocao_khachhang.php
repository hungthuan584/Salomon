<?php
// 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
include_once(__DIR__.'/../../dbconnect.php');

// 2. Chuẩn bị câu truy vấn $sql
$sqlSoLuongKH = "SELECT COUNT(*) AS soLuongKH FROM khachhang";

// 3. Thực thi câu truy vấn SQL để lấy về dữ liệu
$resultSoLuongKH = mysqli_query($conn, $sqlSoLuongKH);

$dataSoLuongKH = [];
while($row = mysqli_fetch_array($resultSoLuongKH, MYSQLI_ASSOC))
{
    $dataSoLuongKH[] = array(
        'soLuongKH' => $row['soLuongKH']
    );
}
// 5. Chuyển đổi dữ liệu về định dạng JSON
// Dữ liệu JSON, từ array PHP -> JSON 
echo json_encode($dataSoLuongKH[0]);
?>