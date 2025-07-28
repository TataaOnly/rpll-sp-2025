<?php
require_once '../Middleware/AuthMiddleware.php';
AuthMiddleware::handle();

require_once '../Service/GambarService.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gambarService = new GambarService();

    $produk_id = intval($_POST['produk_id'] ?? 0);
    
    if(isset($_FILES['file-upload']) && !empty($_FILES['file-upload']['name'][0])) {
        $upload_dir = '../../uploads/';

        if(!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $files = $_FILES['file-upload'];
        $success_count = 0;

        foreach($files as $file){
            if($file['error'] === UPLOAD_ERR_OK) {
                $tmp_name = $file['tmp_name'];
                $name = basename($file['name']);
                $target_file = $upload_dir . $name;

                // Validate file using service
                $validation = $gambarService->validateImageFile($file);
                if($validation !== true) {
                    $_SESSION['errors'] = array_merge($_SESSION['errors'] ?? [], $validation);
                    continue;
                }

                // Generate unique filename
                $file_extension = pathinfo($name, PATHINFO_EXTENSION);
                $filename = time() . '_' . uniqid() . '.' . $file_extension;
                $upload_path = $upload_dir . $filename;

                // Move uploaded file
                if(move_uploaded_file($tmp_name, $upload_path)) {
                    $image_data = [
                        'file' => $filename,
                        'produk_id' => $produk_id
                    ];

                    // Use service to save image record
                    if(!$gambarService->addImage($image_data)) {
                        $_SESSION['errors'][] = "Failed to save image record: " . $name;
                        unlink($upload_path);
                    } else {
                        $success_count++;
                    }
                } else {
                    $_SESSION['errors'][] = "Failed to upload file: " . $name;
                }
            }
        }
        
        if ($success_count > 0) {
            $_SESSION['success'] = "$success_count image(s) uploaded successfully";
        }
        header('Location: ../View/layout.php?page=ubah-galeri');
        exit();
    } else {
         $_SESSION['errors'][] = "Failed to upload file: " . $_FILES['file-upload']['name'][$i];
        exit();
    }

?>