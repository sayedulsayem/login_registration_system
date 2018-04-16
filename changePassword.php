<?php
include_once "lib/user.php";
include_once "inc/header.php";
session::checkSession();
?>
<?php
if(isset($_GET['id'])){
    $userId=(int)($_GET['id']);
    $user=new user();
    $userData=$user->getUserDataById($userId);
    $sesID=session::get('id');
    if ($userId != $sesID){
        header("Location: index.php");
    }
}
?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2> User Profile <span class="pull-right"><strong> Welcome !</strong> <?php echo $userData->full_name; ?> </span></h2>
        </div>
        <div class="container">
            <?php

            $user= new user();

            if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['updatepass'])){
                $userPass= $user->updatepassword($userId,$_POST);
                echo $userPass;
            }
            ?>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="old_pass">Old Password: </label>
                    <input name="old_pass"  type="password" class="form-control" id="old_pass">
                </div>
                <div class="form-group">
                    <label for="new_pass">New Password:</label>
                    <input name="new_pass" type="password" class="form-control" id="new_pass">
                </div>
                <button name="updatepass" type="submit" class="btn btn-default"> Update </button>
            </form>
        </div>
    </div>
<?php
include_once "inc/footer.php";
?>