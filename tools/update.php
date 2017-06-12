<?php
include_once "../lib/user.php";

$user= new user();

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['update'])){
    $userLogin= $user->updateUserData($_POST);
    echo $userLogin;
}
header('Location: ../index.php');

?>