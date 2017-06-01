<?php
include_once "inc/header.php";
include_once "lib/user.php";
$user = new user();
?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h2>User List <span class="pull-right"><strong>Welcome !</strong> Sayem</span></h2>
        </div>
    </div>
    <div class="container">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Seriel</th>
                <th>Full Name</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td>John</td>
                <td>Doe</td>
                <td>john@example.com</td>
                <td><a class="btn btn-primary" href="profile.php?id=1">View</a></td>
            </tr>
            <tr>
                <td>1</td>
                <td>John</td>
                <td>Doe</td>
                <td>john@example.com</td>
                <td><a class="btn btn-primary" href="profile.php?id=1">View</a></td>
            </tr>
            <tr>
                <td>1</td>
                <td>John</td>
                <td>Doe</td>
                <td>john@example.com</td>
                <td><a class="btn btn-primary" href="profile.php?id=1">View</a></td>
            </tr>
            </tbody>
        </table>
    </div>

<?php
include_once "inc/footer.php";
?>