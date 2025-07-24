<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
if (!isset($_SESSION['login'])) {
    header('Location: ../index.php');
    exit();
}   
include_once '../Model/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $produk_id = $_POST['produk_id'] ?? null;
    if(isset($_FILES['file-upload']) && !empty($_FILES['file-upload']['name'][0])) {
        $upload_dir = '../../uploads/';
        for($i = 0; $i < count($_FILES['file-upload']['name']); $i++) {
            if ($_FILES['file-upload']['error'][$i] === UPLOAD_ERR_OK) {
                $file_type = $_FILES['file-upload']['type'][$i];
                $file_size = $_FILES['file-upload']['size'][$i];

                $filename = explode('.', $_FILES['file-upload']['name'][$i])[0];
                $file_extension = pathinfo($_FILES['file-upload']['name'][$i], PATHINFO_EXTENSION);
                $file_name = $filename . '_' . uniqid() . '.' . $file_extension;
                $upload_path = $upload_dir . $file_name;
                    
                    // Move uploaded file to target directory
                    if (move_uploaded_file($_FILES['file-upload']['tmp_name'][$i], $upload_path)) {
                        // Insert into database
                        $sql = "INSERT INTO gambar (produk_id, file) VALUES ('$produk_id', '$file_name')";
                        if (!mysqli_query($conn, $sql)) {
                            $_SESSION['errors'][] = "Failed to save image record: " . mysqli_error($conn);
                        } 
                    } else {
                        $_SESSION['errors'][] = "Failed to upload file: " . $_FILES['file-upload']['name'][$i];
                    }
                }
            }
        }
        header('Location: ../View/layout.php?page=ubah-galeri');
    } else {
         $_SESSION['errors'][] = "Failed to upload file: " . $_FILES['file-upload']['name'][$i];
        exit();
    }

?>