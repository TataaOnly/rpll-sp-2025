<?php
//delete gambar
require_once '../Middleware/AuthMiddleware.php';
AuthMiddleware::handle(); 

require_once '../Service/GambarService.php';
require_once '../Service/ProdukService.php';

if(isset($_POST['produk_id'])) {
    $produkService = new ProdukService();
    $gambarService = new GambarService();

    $produk_id = intval($_POST['produk_id']);
    
    //delete assoicated images
    $deleted_images = $gambarService->deleteImagesByProductId($produk_id);
    if ($deleted_images) {
        foreach ($deleted_images as $filename) {
            $file_path = '../../uploads/' . $filename;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
    }

    //delete produk
    if ($produkService->deleteProduct($produk_id)) {
        $_SESSION['success'] = 'Product and associated images deleted successfully';
    } else {
        $_SESSION['errors'][] = 'Failed to delete product';
    }

    header('Location: ../View/layout.php?page=ubah-produk');
    exit;
}
?>