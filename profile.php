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
}
?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2> User Profile <span class="pull-right"><strong> Welcome !</strong> <?php echo $userData->full_name; ?> </span></h2>
        </div>
        <div class="container">
            <?php
            if ($userData){
            ?>
            <form action="tools/update.php" method="POST">
                <div class="form-group">
                    <input name="id" value="<?php echo $userData->id; ?>" type="hidden" class="form-control" id="id">
                </div>
                <div class="form-group">
                    <label for="full_name">Full Name:</label>
                    <input name="full_name" value="<?php echo $userData->full_name; ?>" type="text" class="form-control" id="full_name">
                </div>
                <div class="form-group">
                    <label for="user_name">User Name:</label>
                    <input name="user_name" value="<?php echo $userData->user_name; ?>" type="text" class="form-control" id="user_name">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input name="email" value="<?php echo $userData->email; ?>" type="email" class="form-control" id="email">
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="remember"> Remember me</label>
                </div>
                <?php
                $sesID=session::get('id');
                if ($userId == $sesID){ ?>
                    <button name="update" type="submit" class="btn btn-default"> Update </button>
                    <a class="btn btn-default" href="changePassword.php?id=<?php echo $userId; ?>">Change password</a>
               <?php }
                ?>

            </form>
            <?php } ?>
        </div>
    </div>
<?php
include_once "inc/footer.php";
?>