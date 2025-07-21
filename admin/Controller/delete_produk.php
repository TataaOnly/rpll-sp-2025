<?php
//delete gambar
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
if (!isset($_SESSION['login'])) {
    header('Location: ../index.php');
    exit();
}   
include_once "../Model/config.php";
$stmt = mysqli_prepare($conn, "SELECT * FROM gambar WHERE produk_id = ?");
mysqli_stmt_bind_param($stmt, "i", $_POST['produk_id']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
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