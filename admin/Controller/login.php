<?php
session_start();

require_once __DIR__ . '/../Helpers/ErrorHandler.php';
require_once __DIR__ . '/../Helpers/KontakHelper.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = $_POST['password'] ?? '';
    
    if (empty($password)) {
        ErrorHandler::addError('Password is required');
        header('Location: ../index.php');
        exit;
    }
    
    try {
        if (KontakHelper::verifyAdminPassword($password)) {
            $_SESSION['login'] = true;
            header('Location: ../View/layout.php?page=ubah-produk');
            exit;
        } else {
            ErrorHandler::addError('Invalid password');
        }
    } catch (Exception $e) {
        error_log("Login error: " . $e->getMessage());
        ErrorHandler::addError('System error occurred');
    }
    
    header('Location: ../index.php');
} else {
    header('Location: ../index.php');
}
?>