<?php
header('Content-Type: application/json');
$host = 'localhost';
$user = 'root'; // Ganti sama username db (if needed)
$pass = '';
$db = 'plastik'; // Ganti sama nama db

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(['error' => 'Koneksi gagal: ' . $conn->connect_error]);
    exit;
}

// Get all products
$sql = "SELECT * FROM produk ORDER BY created_at DESC";
$result = $conn->query($sql);
$products = [];
if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $row['images'] = [];
        $products[$row['produk_id']] = $row;
    }
}

// Get all images for all products
if (count($products) > 0) {
    $ids = implode(',', array_map('intval', array_keys($products)));
    $imgSql = "SELECT * FROM gambar WHERE produk_id IN ($ids) ORDER BY gambar_id ASC";
    $imgResult = $conn->query($imgSql);
    if ($imgResult && $imgResult->num_rows > 0) {
        while($img = $imgResult->fetch_assoc()) {
            $pid = $img['produk_id'];
            if (isset($products[$pid])) {
                $products[$pid]['images'][] = $img;
            }
        }
    }
}

// Output as indexed array
$conn->close();
echo json_encode(array_values($products));
