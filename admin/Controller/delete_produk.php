<?php
//delete gambar
include_once "../Model/config.php";
$sql = "SELECT * FROM gambar WHERE produk_id = ".$_POST['produk_id'].";";
$result = mysqli_query($conn,$sql);
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){
        $file_path = '../../uploads/'.$row['file'];
        if(file_exists($file_path)){
            unlink($file_path);
        }
    }
}
//delete PRODUK
$sql = "DELETE FROM produk WHERE produk_id = ".$_POST['produk_id'].";";
$result = mysqli_query($conn,$sql);


mysqli_close($conn);
?>