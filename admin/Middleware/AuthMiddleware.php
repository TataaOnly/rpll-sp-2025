<?php
class AuthMiddleware {
    public static function handle(){
        if(!isset($_SESSION)){
            session_start();
        }

        if (!isset($_SESSION['login'])) {
            header('Location: ../index.php');
            exit();
        }
    }
}
?>