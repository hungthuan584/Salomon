<?php
// 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
include_once(__DIR__.'/../../dbconnect.php');

// 2. Chuẩn bị câu truy vấn $sql
$sqlSoLuongDH = "SELECT COUNT(*) AS soLuongDH FROM dondathang";

// 3. Thực thi câu truy vấn SQL để lấy về dữ liệu
$resultSoLuongDH = mysqli_query($conn, $sqlSoLuongDH);

$dataSoLuongDH = [];
while($row = mysqli_fetch_array($resultSoLuongDH, MYSQLI_ASSOC))
{
    $dataSoLuongDH[] = array(
        'soLuongDH' => $row['soLuongDH']
    );
}
// 5. Chuyển đổi dữ liệu về định dạng JSON
// Dữ liệu JSON, từ array PHP -> JSON 
echo json_encode($dataSoLuongDH[0]);
?>