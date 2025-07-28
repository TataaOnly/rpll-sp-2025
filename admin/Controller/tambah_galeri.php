<?php
require_once '../Middleware/AuthMiddleware.php';
AuthMiddleware::handle();

require_once '../Helpers/ErrorHandler.php';
require_once '../Service/GambarService.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $produk_id = intval($_POST['produk_id'] ?? 0);
    
    // Add product ID validation
    if ($produk_id <= 0) {
        ErrorHandler::addError('Invalid product ID');
        header('Location: ../View/layout.php?page=ubah-galeri');
        exit;
    }
    
    if(isset($_FILES['file-upload']) && !empty($_FILES['file-upload']['name'][0])) {
        $gambarService = new GambarService();
        $upload_dir = '../../uploads/';

        if(!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $success_count = 0;

        for($i = 0; $i < count($_FILES['file-upload']['name']); $i++) {
            if($_FILES['file-upload']['error'][$i] === UPLOAD_ERR_OK) {
                // UPDATE: Create proper file array for validation
                $file = [
                    'name' => $_FILES['file-upload']['name'][$i],
                    'type' => $_FILES['file-upload']['type'][$i],
                    'size' => $_FILES['file-upload']['size'][$i],
                    'tmp_name' => $_FILES['file-upload']['tmp_name'][$i],
                    'error' => $_FILES['file-upload']['error'][$i]
                ];

                // Validate file using service
                $validation = $gambarService->validateImageFile($file);
                if($validation !== true) {
                    ErrorHandler::addErrors($validation);
                    continue;
                }

                // Generate unique filename
                $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                $filename = time() . '_' . uniqid() . '.' . $file_extension;
                $upload_path = $upload_dir . $filename;

                // Move uploaded file
                if(move_uploaded_file($file['tmp_name'], $upload_path)) {
                    $image_data = [
                        'file' => $filename,
                        'produk_id' => $produk_id
                    ];

                    // Use service to save image record
                    if($gambarService->addImage($image_data)) {
                        $success_count++;
                    } else {
                        ErrorHandler::addError("Failed to save image record: " . $file['name']);
                        unlink($upload_path); // Clean up uploaded file
                    }
                } else {
                    ErrorHandler::addError("Failed to upload file: " . $file['name']);
                }
            } else {
                // Handle upload errors
                $error_message = "Upload error for file " . ($_FILES['file-upload']['name'][$i] ?? 'unknown');
                switch($_FILES['file-upload']['error'][$i]) {
                    case UPLOAD_ERR_INI_SIZE:
                    case UPLOAD_ERR_FORM_SIZE:
                        $error_message .= ": File too large";
                        break;
                    case UPLOAD_ERR_PARTIAL:
                        $error_message .= ": File partially uploaded";
                        break;
                    case UPLOAD_ERR_NO_FILE:
                        $error_message .= ": No file uploaded";
                        break;
                    case UPLOAD_ERR_NO_TMP_DIR:
                        $error_message .= ": Missing temporary folder";
                        break;
                    case UPLOAD_ERR_CANT_WRITE:
                        $error_message .= ": Failed to write file";
                        break;
                    default:
                        $error_message .= ": Unknown error";
                }
                ErrorHandler::addError($error_message);
            }
        }
        
        // UPDATE: Better success/error handling
        if ($success_count > 0) {
            ErrorHandler::setSuccess("$success_count image(s) uploaded successfully");
        }
        
        if (!ErrorHandler::hasErrors() && $success_count === 0) {
            ErrorHandler::addError('No files were processed successfully');
        }
        
        header('Location: ../View/layout.php?page=ubah-galeri');
        exit;
    } else {
        ErrorHandler::addError("No files were uploaded");
        header('Location: ../View/layout.php?page=ubah-galeri');
        exit;
    }
} else {
    // UPDATE: Handle non-POST requests
    header('Location: ../View/layout.php?page=ubah-galeri');
    exit;
}
?>