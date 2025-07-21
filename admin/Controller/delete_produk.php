<?php
//delete produk
include_once "../Model/config.php";
$sql = "DELETE FROM produk WHERE produk_id = ".$_POST['produk_id'].";";
$result = mysqli_query($conn,$sql);
mysqli_close($conn);

?>