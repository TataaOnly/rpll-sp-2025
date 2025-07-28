<?php
require_once '../Middleware/AuthMiddleware.php';
AuthMiddleware::handle();
// Set JSON header
header('Content-Type: application/json');

include_once("../Model/config.php");

$input = filter_input_array(INPUT_POST);

if ($input && $input['action'] == 'edit') {	
    $update_field = '';
    $value = '';
    
    // Determine which field to update and sanitize the value
    if(isset($input['nama'])) {
        $update_field = "nama";
        $value = mysqli_real_escape_string($conn, $input['nama']);
    } else if(isset($input['stok'])) {
        $update_field = "stok";
        $value = intval($input['stok']); // Ensure it's an integer
    } else if(isset($input['harga'])) {
        $update_field = "harga";
        $value = floatval($input['harga']); // Ensure it's a number
    }
    
    if($update_field && $input['produk_id']) {
        $produk_id = intval($input['produk_id']); // Ensure it's an integer
        
        // Use prepared statement for maximum security
        $sql = "UPDATE produk SET $update_field = ? WHERE produk_id = ?";
        $stmt = mysqli_prepare($conn, $sql);
        
        if ($stmt) {
            // Bind parameters based on field type
            if ($update_field == 'nama') {
                mysqli_stmt_bind_param($stmt, "si", $value, $produk_id);
            } else {
                mysqli_stmt_bind_param($stmt, "di", $value, $produk_id); // d for double/float
            }
            
            if (mysqli_stmt_execute($stmt)) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Data berhasil diupdate'
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Database error: ' . mysqli_stmt_error($stmt)
                ]);
            }
            
            mysqli_stmt_close($stmt);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to prepare statement'
            ]);
        }
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Missing required fields'
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request'
    ]);
}

mysqli_close($conn);
?>
