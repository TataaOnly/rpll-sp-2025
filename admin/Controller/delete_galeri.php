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
    $produk_id = intval($_POST['produk_id'] ?? 0);
    
    // Get image IDs - either from bulk delete or single delete
    $image_ids = [];
    
    if (isset($_POST['image_ids']) && is_array($_POST['image_ids'])) {
        // Bulk delete
        $image_ids = array_map('intval', $_POST['image_ids']);
    } elseif (isset($_POST['image_id'])) {
        // Single delete
        $image_ids = [intval($_POST['image_id'])];
    }
    
    if (empty($image_ids)) {
        echo json_encode([
            'success' => false, 
            'message' => 'No images specified for deletion'
        ]);
        exit;
    }
    
    $deleted_count = 0;
    $error_count = 0;
    
    foreach ($image_ids as $image_id) {
        // Get file path before deletion
        $query = "SELECT file FROM gambar WHERE gambar_id = ?";
        $stmt = mysqli_prepare($conn, $query);
        
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "i", $image_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            
            if ($row = mysqli_fetch_assoc($result)) {
                $file_path = '../../uploads/' . $row['file'];
                
                // Delete from database
                $delete_query = "DELETE FROM gambar WHERE gambar_id = ?";
                $delete_stmt = mysqli_prepare($conn, $delete_query);
                
                if ($delete_stmt) {
                    mysqli_stmt_bind_param($delete_stmt, "i", $image_id);
                    
                    if (mysqli_stmt_execute($delete_stmt)) {
                        // Delete physical file
                        if (file_exists($file_path)) {
                            unlink($file_path);
                        }
                        $deleted_count++;
                    } else {
                        $error_count++;
                    }
                    
                    mysqli_stmt_close($delete_stmt);
                } else {
                    $error_count++;
                }
            } else {
                $error_count++;
            }
            
            mysqli_stmt_close($stmt);
        } else {
            $error_count++;
        }
    }
    
    // Return appropriate response
    if ($deleted_count > 0) {
        $total_requested = count($image_ids);
        $message = $total_requested === 1 
            ? 'Image deleted successfully'
            : "$deleted_count of $total_requested image(s) deleted successfully";
            
        if ($error_count > 0) {
            $message .= " ($error_count failed)";
        }
        
        echo json_encode([
            'success' => true, 
            'message' => $message,
            'deleted_count' => $deleted_count,
            'error_count' => $error_count
        ]);
    } else {
        echo json_encode([
            'success' => false, 
            'message' => 'Failed to delete any images'
        ]);
    }
    
} else {
    echo json_encode([
        'success' => false, 
        'message' => 'Invalid request method'
    ]);
}

mysqli_close($conn);
?>