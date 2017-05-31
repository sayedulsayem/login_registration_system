<?php include_once "inc/header.php"; ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>User List <span class="pull-right"><strong>Welcome !</strong> Sayem</span></h2>
        </div>
        <div class="container">
            <form action="" method="POST">
                <div class="form-group">
                    <label for="name">Full Name:</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter full name" name="name">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                </div>
                <div class="form-group">
                    <label for="pwd">Passord :</label>
                    <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
                </div>
                <div class="checkbox">
                    <label><input type="checkbox" name="remember"> Remember me</label>
                </div>
                <button name="update" type="submit" class="btn btn-default">Update</button>
            </form>
        </div>
    </div>
<?php
include_once "inc/footer.php";
?>