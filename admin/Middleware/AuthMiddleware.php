<?php
class AuthMiddleware {
    public static function handle(){
        session_start();
        if (!isset($_SESSION['login'])) {
            header('Location: ../index.php');
            exit();
        }
    }
}
?>