<?php
require_once '../Middleware/AuthMiddleware.php';
AuthMiddleware::handle();
// Set JSON header
require_once '../Service/ProdukService.php';
header('Content-Type: application/json');


$input = filter_input_array(INPUT_POST);

if ($input && $input['action'] == 'edit') {	
    $produkService = new ProdukService();

    $produk_id = intval($input['produk_id'] ?? 0);
    $update_data = [];
    
    // Determine which field to update and sanitize the value
    if(isset($input['nama'])) {
        $update_data['nama'] = trim($input['nama']);
    } else if(isset($input['stok'])) {
        $update_data['stok'] = intval($input['stok']);
    } else if(isset($input['harga'])) {
        $update_data['harga'] = floatval($input['harga']);
    } 
    
    if(!empty($update_data) && $produk_id > 0) {

        $validation = $produkService->validateProductData($update_data);
        if ($validation !== true) {
            echo json_encode([
                'status' => 'error',
                'message' => implode(', ', $validation)
            ]);
            exit;
        }
        

        if($produkService->updateProduct($produk_id, $update_data)) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Product updated successfully'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to update product'
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
?>
