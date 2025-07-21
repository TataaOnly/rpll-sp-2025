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
if ($_POST) {
    $produk_id = $_POST['produk_id'];
    $status = $_POST['status'];
    
    $sql = "UPDATE produk SET `status` = ? WHERE produk_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'si', $status, $produk_id);
    
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}
mysqli_close($conn);
?>