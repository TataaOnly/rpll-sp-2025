<?php
require_once '../Middleware/AuthMiddleware.php';
AuthMiddleware::handle(); 

require_once '../Helpers/ErrorHandler.php';
require_once '../Service/ProdukService.php';
require_once '../Service/GambarService.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Initialize services
    $produkService = new ProdukService();
    $gambarService = new GambarService();
    
    // Handle product creation/retrieval
    if(!isset($_POST['produk_id']) || empty($_POST['produk_id'])) {
        // Create new product with initial empty data
        $initial_data = [
            'nama' => '',
            'harga' => 0,
            'stok' => 0,
            'deskripsi' => ''
        ];
        
        $produk_id = $produkService->addProduct($initial_data);
        
        if (!$produk_id) {
            ErrorHandler::addError('Failed to create new product');
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }
    } else {
        $produk_id = intval($_POST['produk_id']);
        
        // Verify product exists using service
        if (!$produkService->findProductById($produk_id)) {
            ErrorHandler::addError('Product not found');
            header('Location: ../View/layout.php?page=ubah-produk');
            exit;
        }
    }

    // Prepare and validate update data
    $update_data = [
        'nama' => trim($_POST['nama-produk'] ?? ''),
        'harga' => floatval($_POST['harga-produk'] ?? 0),
        'stok' => intval($_POST['stok-produk'] ?? 0),
        'deskripsi' => trim($_POST['deskripsi'] ?? '')
    ];

    // Use service validation
    $validation = $produkService->validateProductData($update_data);
    if ($validation !== true) {
        ErrorHandler::addErrors($validation);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    // Handle deleted images using service
    if (!empty($_POST['deleted_images'])) {
        $deleted_ids = explode(',', $_POST['deleted_images']);
        $deleted_ids = array_map('intval', array_filter($deleted_ids, 'is_numeric'));
        
        if (!empty($deleted_ids)) {
            $deleted_files = $gambarService->deleteImages($deleted_ids);
            
            if ($deleted_files) {
                foreach ($deleted_files as $filename) {
                    $file_path = '../../uploads/' . $filename;
                    if (file_exists($file_path)) {
                        unlink($file_path);
                    }
                }
            }
        }
    }

    // Handle new image uploads
    if (isset($_FILES['file-upload']) && !empty($_FILES['file-upload']['name'][0])) {
        $upload_dir = '../../uploads/';
        
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        
        for ($i = 0; $i < count($_FILES['file-upload']['name']); $i++) {
            if ($_FILES['file-upload']['error'][$i] === UPLOAD_ERR_OK) {
                $file = [
                    'name' => $_FILES['file-upload']['name'][$i],
                    'type' => $_FILES['file-upload']['type'][$i],
                    'size' => $_FILES['file-upload']['size'][$i],
                    'tmp_name' => $_FILES['file-upload']['tmp_name'][$i]
                ];
                
                $validation = $gambarService->validateImageFile($file);
                if ($validation !== true) {
                    ErrorHandler::addErrors($validation);
                    continue;
                }
                
                $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                $filename = time() . '_' . uniqid() . '.' . $file_extension;
                $upload_path = $upload_dir . $filename;
                
                if (move_uploaded_file($file['tmp_name'], $upload_path)) {
                    $image_data = [
                        'file' => $filename,
                        'produk_id' => $produk_id
                    ];
                    
                    if (!$gambarService->addImage($image_data)) {
                        ErrorHandler::addError("Failed to save image record: " . $file['name']);
                        unlink($upload_path);
                    }
                } else {
                    ErrorHandler::addError("Failed to upload file: " . $file['name']);
                }
            }
        }
    }

    // Update product using service
    if ($produkService->updateProduct($produk_id, $update_data)) {
        ErrorHandler::setSuccess('Product updated successfully');
        header('Location: ../View/layout.php?page=ubah-produk');
        exit;
    } else {
        ErrorHandler::addError('Failed to update product details');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
?>