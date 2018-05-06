<?php
SESSION_START();
include_once("function.php");

if (isset($_SESSION['username'])){
    unset($_SESSION['username']); 
    unset($_SESSION['role']); // xóa session login
    unset($_SESSION['userID']);

}
header("location: login.php");

?>