<?php
$filepath= realpath(dirname(__FILE__));
include_once $filepath."/../lib/session.php";
session::init();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Registration System</title>
    <link rel="stylesheet" href="inc/css/bootstrap.min.css">
    <link rel="stylesheet" href="inc/css/bootstrap-theme.min.css">
    <script src="inc/js/bootstrap.min.js"></script>
    <script src="inc/js/jquery-3.2.1.min.js"></script>
</head>
<?php
    if (isset($_GET['action'])&& $_GET['action']=="logout"){
        session::destroy();
    }
?>
<body>
<div class="container">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php">Login Register System</a>
            </div>
            <ul class="nav navbar-nav pull-right">
                <?php
                $id=session::get('id');
                $userLogin=session::get('login');
                if ($userLogin== true){ ?>
                    <li><a href="profile.php?id=<?php echo $id; ?>">Profile</a></li>
                    <li><a href="?action=logout">Log Out</a></li>
                <?php
                }
                else {
                    ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Register</a></li>
                <?php
                }
                ?>

            </ul>
        </div>
    </nav>