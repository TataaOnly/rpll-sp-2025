<?php
class ErrorHandler {
    public static function addError($message) {
        if (!isset($_SESSION['errors'])) {
            $_SESSION['errors'] = [];
        }
        $_SESSION['errors'][] = $message;
    }
    
    public static function addErrors($errors) {
        if (!isset($_SESSION['errors'])) {
            $_SESSION['errors'] = [];
        }
        $_SESSION['errors'] = array_merge($_SESSION['errors'], $errors);
    }
    
    public static function setSuccess($message) {
        $_SESSION['success'] = $message;
    }
    
    public static function hasErrors() {
        return isset($_SESSION['errors']) && !empty($_SESSION['errors']);
    }
    
    public static function hasSuccess() {
        return isset($_SESSION['success']);
    }
    
    public static function displayErrors() {
        if (self::hasErrors()) {
            echo '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">';
            echo '<ul class="list-disc list-inside">';
            foreach ($_SESSION['errors'] as $error) {
                echo '<li>' . htmlspecialchars($error) . '</li>';
            }
            echo '</ul></div>';
            unset($_SESSION['errors']);
        }
    }
    
    public static function displaySuccess() {
        if (self::hasSuccess()) {
            echo '<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">';
            echo htmlspecialchars($_SESSION['success']);
            echo '</div>';
            unset($_SESSION['success']);
        }
    }
}
?>