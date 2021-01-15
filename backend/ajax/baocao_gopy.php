<?php
// 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
include_once(__DIR__.'/../../dbconnect.php');

// 2. Chuẩn bị câu truy vấn $sql
$sqlSoLuongGopY = "SELECT COUNT(*) AS soLuongGopY FROM gopy";

// 3. Thực thi câu truy vấn SQL để lấy về dữ liệu
$resultSoLuongGopY = mysqli_query($conn, $sqlSoLuongGopY);

$dataSoLuongGopY = [];
while($row = mysqli_fetch_array($resultSoLuongGopY, MYSQLI_ASSOC))
{
    $dataSoLuongGopY[] = array(
        'soLuongGopY' => $row['soLuongGopY']
    );
}
// 5. Chuyển đổi dữ liệu về định dạng JSON
// Dữ liệu JSON, từ array PHP -> JSON 
echo json_encode($dataSoLuongGopY[0]);
?>