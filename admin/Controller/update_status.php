<?php
require_once __DIR__ . '/../Middleware/AuthMiddleware.php';
AuthMiddleware::handle();

// UPDATE: Use ErrorHandler and services
require_once __DIR__ . '/../Helpers/ErrorHandler.php';
require_once __DIR__ . '/../Service/ProdukService.php';

header('Content-Type: application/json');

if ($_POST) {
    $produk_id = intval($_POST['produk_id'] ?? 0);
    $status = $_POST['status'] ?? '';
    
    if ($produk_id <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid product ID']);
        exit;
    }
    
    if (!in_array($status, ['Aktif', 'Non-Aktif'])) {
        echo json_encode(['success' => false, 'message' => 'Invalid status']);
        exit;
    }
    
    $produkService = new ProdukService();
    
    if ($produkService->updateProductStatus($produk_id, $status)) {
        echo json_encode(['success' => true, 'message' => 'Status updated successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update status']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>