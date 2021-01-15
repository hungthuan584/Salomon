<?php
// 1. Include file cấu hình kết nối đến database, khởi tạo kết nối $conn
include_once(__DIR__.'/../../dbconnect.php');

// 2. Chuẩn bị câu truy vấn $sql
$sqlSoLuongLSP =<<<EOT
    SELECT lsp.lsp_ten, COUNT(*) AS SoLSP
    FROM sanpham sp
    JOIN loaisanpham lsp
    ON sp.lsp_ma = lsp.lsp_ma
    GROUP BY lsp.lsp_ten
EOT;

// 3. Thực thi câu truy vấn SQL để lấy về dữ liệu
$resultSoLuongLSP = mysqli_query($conn, $sqlSoLuongLSP);

$dataSoLuongLSP = [];
while($row = mysqli_fetch_array($resultSoLuongLSP, MYSQLI_ASSOC))
{
    $dataSoLuongLSP[] = array(
        'tenLSP' => $row['lsp_ten'],
        'SoLSP' => $row['SoLSP']
    );
}
// 5. Chuyển đổi dữ liệu về định dạng JSON
// Dữ liệu JSON, từ array PHP -> JSON 
echo json_encode($dataSoLuongLSP);
?>