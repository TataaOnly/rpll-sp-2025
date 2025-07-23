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
    if(!isset($_POST['produk_id']) || empty($_POST['produk_id'])) {
        $sql = "INSERT INTO produk (nama, harga, stok, deskripsi) VALUES ('', '', '', '')";
        if (mysqli_query($conn, $sql)) {
            $produk_id = mysqli_insert_id($conn);
        }
    } else {
        $produk_id = mysqli_real_escape_string($conn, $_POST['produk_id']);
    }
    $nama = mysqli_real_escape_string($conn, $_POST['nama-produk']);
    $harga = mysqli_real_escape_string($conn, $_POST['harga-produk']);
    $stok = mysqli_real_escape_string($conn, $_POST['stok-produk']);
    $deskripsi = mysqli_real_escape_string($conn, $_POST['deskripsi']);
    
    // Handle deleted images array
    if (!empty($_POST['deleted_images'])) {
        $deleted_ids = explode(',', $_POST['deleted_images']);
        foreach ($deleted_ids as $image_id) {
            if (is_numeric($image_id)) {
                // Get file path before deletion
                $query = "SELECT file FROM gambar WHERE gambar_id = '$image_id'";
                $result = mysqli_query($conn, $query);
                if ($result && mysqli_num_rows($result) > 0) {
                    $image = mysqli_fetch_assoc($result);
                    $file_path = '../../uploads/' . $image['file'];
                    
                    // Delete from database
                    $delete_query = "DELETE FROM gambar WHERE gambar_id = '$image_id'";
                    if (mysqli_query($conn, $delete_query)) {
                        // Delete physical file
                        if (file_exists($file_path)) {
                            unlink($file_path);
                        }
                    }
                }
            }
        }
    }
    
    // Handle new image uploads with validation
    if (isset($_FILES['file-upload']) && !empty($_FILES['file-upload']['name'][0])) {
        $upload_dir = '../../uploads/';
        $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
        $max_size = 10 * 1024 * 1024; // 10MB
        
        for ($i = 0; $i < count($_FILES['file-upload']['name']); $i++) {
            if ($_FILES['file-upload']['error'][$i] === UPLOAD_ERR_OK) {
                $file_type = $_FILES['file-upload']['type'][$i];
                $file_size = $_FILES['file-upload']['size'][$i];
                
                // Validate file type
                if (!in_array($file_type, $allowed_types)) {
                    $_SESSION['errors'][] = "File " . $_FILES['file-upload']['name'][$i] . " is not a valid image type.";
                    continue;
                }
                
                // Validate file size
                if ($file_size > $max_size) {
                    $_SESSION['errors'][] = "File " . $_FILES['file-upload']['name'][$i] . " is too large. Maximum size is 10MB.";
                    continue;
                }
                
                // Generate unique filename
                $file_extension = pathinfo($_FILES['file-upload']['name'][$i], PATHINFO_EXTENSION);
                $filename = time() . '_' . uniqid() . '.' . $file_extension;
                $upload_path = $upload_dir . $filename;
                
                if (move_uploaded_file($_FILES['file-upload']['tmp_name'][$i], $upload_path)) {
                    $insert_query = "INSERT INTO gambar (file, produk_id) VALUES ('$filename', '$produk_id')";
                    if (!mysqli_query($conn, $insert_query)) {
                        $_SESSION['errors'][] = "Failed to save image record: " . mysqli_error($conn);
                    }
                } else {
                    $_SESSION['errors'][] = "Failed to upload file: " . $_FILES['file-upload']['name'][$i];
                }
            }
        }
    }
    
    // Update product details
    $update_query = "UPDATE produk SET 
                     nama = '$nama',
                     harga = '$harga',
                     stok = '$stok',
                     deskripsi = '$deskripsi'
                     WHERE produk_id = '$produk_id'";
                     
    if (mysqli_query($conn, $update_query)) {
        $_SESSION['success'] = 'Product updated successfully';
        header('Location: ../View/layout.php?page=ubah-produk');
        exit;
    } else {
        $_SESSION['errors'][] = 'Database error: ' . mysqli_error($conn);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
mysqli_close($conn);
?>