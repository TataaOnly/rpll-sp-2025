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

$sql = "SELECT * FROM produk ORDER BY created_at DESC";
$result = $conn->query($sql);
$products = [];
if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}
$conn->close();
echo json_encode($products);
