<?php
// 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
include_once(__DIR__.'/../../dbconnect.php');

// 2. Chuẩn bị câu truy vấn $sql
$sqlSoLuongSP = "SELECT COUNT(*) AS soLuongSP FROM sanpham";

// 3. Thực thi câu truy vấn SQL để lấy về dữ liệu
$resultSoLuongSP = mysqli_query($conn, $sqlSoLuongSP);

$dataSoLuongSP = [];
while($row = mysqli_fetch_array($resultSoLuongSP, MYSQLI_ASSOC))
{
    $dataSoLuongSP[] = array(
        'soLuongSP' => $row['soLuongSP']
    );
}
// 5. Chuyển đổi dữ liệu về định dạng JSON
// Dữ liệu JSON, từ array PHP -> JSON 
echo json_encode($dataSoLuongSP[0]);
?>