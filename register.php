<?php
include_once "inc/header.php";
include_once "lib/user.php";
session::checkLogin();
?>
<?php
$user = new user();
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['register'])){
    $userReg= $user->userRegistration($_POST);
}
?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>User Registration</h2>
        </div>
        <div class="container">
            <?php
            if (isset($userReg)){
                echo $userReg;
            }
            ?>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="full_name">Full Name:</label>
                    <input type="text" class="form-control" id="full_name" placeholder="Enter full name" name="full_name">
                </div>
                <div class="form-group">
                    <label for="user_name">User Name:</label>
                    <input type="text" class="form-control" id="user_name" placeholder="Enter user name" name="user_name">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                </div>
                <div class="form-group">
                    <label for="password">Password :</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
                </div>
                <button type="submit" name="register" class="btn btn-default">Submit</button>
            </form>
        </div>
    </div>
<?php
include_once "inc/footer.php";
?>