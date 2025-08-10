<?php
header('Content-Type: application/json');
$host = 'localhost';
$user = 'root'; // Ganti sesuai user database Anda
$pass = '';
$db = 'plastik'; // Ganti sesuai nama database Anda

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['error' => 'Koneksi gagal: ' . $conn->connect_error]);
    exit;
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    http_response_code(400);
    echo json_encode(['error' => 'ID produk tidak valid']);
    exit;
}

$sql = "SELECT * FROM produk WHERE produk_id = $id LIMIT 1";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    // Get all images for this product
    $imgSql = "SELECT file FROM gambar WHERE produk_id = $id ORDER BY gambar_id ASC";
    $imgResult = $conn->query($imgSql);
    $images = [];
    if ($imgResult && $imgResult->num_rows > 0) {
        while($img = $imgResult->fetch_assoc()) {
            $images[] = $img['file'];
        }
    }
    $row['images'] = $images;
    echo json_encode($row);
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Produk tidak ditemukan']);
}
$conn->close();
