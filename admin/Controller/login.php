<?php
session_start();
include_once("../Model/config.php");
$sql = "SELECT admin_pass FROM kontak";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
if (password_verify($_POST['password'], $row['admin_pass'])) {
    $_SESSION['login'] = true;
    header('Location: ../View/layout.php?page=ubah-produk');
} else {
    $_SESSION['errors']['password'] = "Password salah";
    header('Location: ../index.php');
}
mysqli_close($conn);

?>