<?php include_once "inc/header.php"; ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>User Login</h2>
        </div>
    <div class="container">
        <form action="" method="POST">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
            </div>
            <div class="checkbox">
                <label><input type="checkbox" name="remember"> Remember me</label>
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>
    </div>
<?php
include_once "inc/footer.php";
?>