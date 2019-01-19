<?php
include_once "inc/header.php";
include_once "lib/user.php";
session::checkSession();
?>
<?php
$loginmsg= session::get("loginmsg");
if (isset($loginmsg)){
    echo $loginmsg;
}
session::set("loginmsg","");
?>

<section class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>User List <span class="pull-right"><strong>Welcome !</strong>
                    <?php
                    $name=session::get("full_name");
                    if (isset($name)){
                        echo $name;
                    }
                    ?>
                </span></h2>
        </div>
    </div>
    <div class="container">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Seriel</th>
                <th>User ID</th>
                <th>Full Name</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $user = new user();
            $userData=$user->getUserData();
            if ($userData){
                $i=0;
                foreach ($userData as $sData){
                    $i++;
                    ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $sData['id']; ?></td>
                        <td><?php echo $sData['full_name']; ?></td>
                        <td><?php echo $sData['user_name']; ?></td>
                        <td><?php echo $sData['email']; ?></td>
                        <td><a class="btn btn-primary" href="profile.php?id=<?php echo $sData['id']; ?>">View</a></td>
                    </tr>
                    <?php
                }
            }else{
                ?>
                <tr><td colspan="5"><h1>No User Data Found.........</h1></td></tr>
                <?php
            }
            ?>

            </tbody>
        </table>
    </div>
</section>

<?php
include_once "inc/footer.php";
?>