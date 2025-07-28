<?php
require_once '../Middleware/AuthMiddleware.php';
AuthMiddleware::handle();

require_once '../Service/GambarService.php';
header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gambarService = new GambarService();
    $produk_id = intval($_POST['produk_id'] ?? 0);
    $image_ids = [];

    //bulk delete images
    if(isset($_POST['image_ids']) && is_array($_POST['image_ids'])) {
        $image_ids = array_map('intval', $_POST['image_ids']);
    } else if(isset($_POST['image_id'])) {
        //single delete image
        $image_ids = [intval($_POST['image_id'])];
    }

    if(empty($image_ids)) {
        echo json_encode([
            'success' => false, 
            'message' => 'No images specified for deletion'
        ]);
        exit;
    }

    if(count($image_ids) === 1) {
        //single delete
        $filename = $gambarService->deleteImage($image_ids[0]);
        if ($filename) {
            $file_path = '../../uploads/' . $filename;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            echo json_encode(['success' => true, 'message' => 'Image deleted successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete image']);
        }
    } else {
        //bulk delete
        $deleted_files = $gambarService->deleteImages($image_ids);
        if ($deleted_files) {
            foreach ($deleted_files as $filename) {
                $file_path = '../../uploads/' . $filename;
                if (file_exists($file_path)) {
                    unlink($file_path);
                }
            }
            echo json_encode(['success' => true, 'message' => 'Images deleted successfully']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete images']);
        }
    }    
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>