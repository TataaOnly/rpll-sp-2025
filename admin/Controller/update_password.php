<?php
require_once __DIR__ . '/../Middleware/AuthMiddleware.php';
AuthMiddleware::handle();

require_once __DIR__ . '/../Helpers/ErrorHandler.php';
require_once __DIR__ . '/../Helpers/KontakHelper.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current_password = $_POST['current_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Validation
    $errors = [];

    if (empty($current_password)) {
        $errors[] = 'Current password is required';
    }

    if (empty($new_password)) {
        $errors[] = 'New password is required';
    } elseif (strlen($new_password) < 6) {
        $errors[] = 'New password must be at least 6 characters long';
    }

    if (empty($confirm_password)) {
        $errors[] = 'Password confirmation is required';
    }

    if ($new_password !== $confirm_password) {
        $errors[] = 'New password and confirmation do not match';
    }

    if (!empty($errors)) {
        ErrorHandler::addErrors($errors);
        header('Location: ../View/layout.php?page=ubah-kontak');
        exit;
    }

    // Verify current password
    try {
        if (!KontakHelper::verifyAdminPassword($current_password)) {
            ErrorHandler::addError('Current password is incorrect');
            header('Location: ../View/layout.php?page=ubah-kontak');
            exit;
        }

        // Update password
        if (KontakHelper::updateAdminPassword($new_password)) {
            ErrorHandler::setSuccess('Password changed successfully');
            
            // Optional: Log out user to force re-login with new password
            // session_destroy();
            // header('Location: ../index.php');
            // exit;
        } else {
            ErrorHandler::addError('Failed to update password');
        }
    } catch (Exception $e) {
        error_log("Error updating password: " . $e->getMessage());
        ErrorHandler::addError('An error occurred while updating password');
    }

    header('Location: ../View/layout.php?page=ubah-kontak');
    exit;
} else {
    header('Location: ../View/layout.php?page=ubah-kontak');
    exit;
}
?>