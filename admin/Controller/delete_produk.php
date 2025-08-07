<?php
//delete gambar
require_once '../Middleware/AuthMiddleware.php';
AuthMiddleware::handle(); 

require_once '../Service/GambarService.php';
require_once '../Service/ProdukService.php';

header('Content-Type: application/json');

if(isset($_POST['produk_id'])) {
    $produkService = new ProdukService();
    $gambarService = new GambarService();

    $produk_id = intval($_POST['produk_id']);

    // Validate produk_id
        if ($produk_id <= 0) {
            echo json_encode(['success' => false, 'message' => 'Invalid product ID']);
            exit;
        }
        
        //Check if product exists before deleting
        $product = $produkService->findProductById($produk_id);
        if (!$product) {
            echo json_encode(['success' => false, 'message' => 'Product not found']);
            exit;
        }
        
    
    //delete assoicated images
    $deleted_images = $gambarService->deleteImagesByProductId($produk_id);
    if ($deleted_images) {
        foreach ($deleted_images as $filename) {
            $file_path = '../../uploads/' . $filename;
            if (file_exists($file_path)) {
                if(!unlink($file_path)){
                    error_log("Failed to delete file: " . $file_path);
                }
            }
        }
    }

    //delete produk
    if ($produkService->deleteProduct($produk_id)) {
        echo json_encode(['success' => true, 'message' => 'Product deleted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete product']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>