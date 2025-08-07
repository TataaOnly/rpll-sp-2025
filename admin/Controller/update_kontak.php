<?php
require_once '../Middleware/AuthMiddleware.php';
AuthMiddleware::handle();

require_once '../Helpers/KontakHelper.php';
require_once '../Helpers/ErrorHandler.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $update_data = [
        'nama' => trim($_POST['nama'] ?? ''),
        'email' => trim($_POST['email'] ?? ''),
        'no_telp' => trim($_POST['no_telp'] ?? ''),
        'no_wa' => trim($_POST['no_wa'] ?? ''),
        'map' => trim($_POST['map'] ?? ''),
        'alamat' => trim($_POST['alamat'] ?? '')
    ];

    //validate
    $errors = [];

    if(empty($update_data['nama'])) {
        $errors[] = 'Nama is required';
    }

    if (empty($update_data['email'])) {
        $errors[] = 'Email address is required';
    } elseif (!filter_var($update_data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email address format';
    }

    if (!empty($update_data['no_telp']) && !preg_match('/^[0-9]{10,13}$/', $update_data['no_telp'])) {
        $errors[] = 'Phone number must be 10-13 digits';
    }

    if (!empty($update_data['no_wa']) && !preg_match('/^[0-9]{10,13}$/', $update_data['no_wa'])) {
        $errors[] = 'WhatsApp number must be 10-13 digits';
    }

    if (!empty($update_data['map'])) {
    // Check if it's an iframe embed code
        if (strpos($update_data['map'], '<iframe') !== false) {
            // Basic iframe validation - check if it contains src attribute
            if (strpos($update_data['map'], 'src=') === false) {
                $errors[] = 'Invalid map embed code - missing src attribute';
            }
        } 
        else {
            $errors[] = 'Invalid map URL format';
        }
    }
    

    if(!empty($errors)) {
        ErrorHandler::addErrors($errors);
        header('Location: ../View/layout.php?page=ubah-kontak');
        exit;
    }

    try{
        if(KontakHelper::updateKontak($update_data)) {
            ErrorHandler::setSuccess('Contact information updated successfully');
        } else {
            ErrorHandler::addError('Failed to update contact information');
        }
    } catch (Exception $e) {
        ErrorHandler::addError('An error occurred while updating contact information');
    }

    header('Location: ../View/layout.php?page=ubah-kontak');
    exit;
} else {
    header('Location: ../View/layout.php?page=ubah-kontak');
    exit;
}

?>