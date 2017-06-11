<?php
include_once "inc/header.php";
include_once "lib/user.php";
session::checkLogin();
?>
<?php
$user = new user();
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['login'])){
    $userLogin= $user->userLogin($_POST);
}
?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>User Login</h2>
        </div>
    <div class="container">
        <?php
        if (isset($userLogin)){
        echo $userLogin;
        }
        ?>
        <form action="" method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
            </div>
            <div class="checkbox">
                <label><input type="checkbox" name="remember"> Remember me</label>
            </div>
            <button type="submit" name="login" class="btn btn-default">Submit</button>
        </form>
    </div>
    </div>
<?php
include_once "inc/footer.php";
?>