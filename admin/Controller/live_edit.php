<?php
include_once("../Model/config.php");

$input = filter_input_array(INPUT_POST);
if ($input['action'] == 'edit') {	
	$update_field='';
	if(isset($input['nama'])) {
		$update_field.= "nama='".$input['nama']."'";
	} else if(isset($input['stok'])) {
		$update_field.= "stok='".$input['stok']."'";
	} else if(isset($input['harga'])) {
		$update_field.= "harga='".$input['harga']."'";
    }
	if($update_field && $input['produk_id']) {
		$sql = "UPDATE produk SET $update_field WHERE produk_id='" . $input['produk_id'] . "'";	
        mysqli_query($conn, $sql);
		echo json_encode([
                'status' => 'success',
                'message' => 'Data berhasil diupdate'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Database error: ' . mysqli_error($conn)
            ]);
        }
    mysqli_close($conn);
	
}
?>
