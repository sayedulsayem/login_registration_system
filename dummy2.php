<?php
include_once "lib/database.php";
include_once "lib/session.php";
include_once "dummy.php";
class test2
{
    private $db;

    public function __construct()
    {
        $this->db = new database();
    }
    public function emailCheck($email){
        $sql= "SELECT email FROM `user` WHERE email = :email";
        $query=$this->db->pdo->prepare($sql);
        $query->bindValue(':email',$email);
        $query->execute();
        if($query->rowCount()>0){
            return true;
        }
        else{
            return false;
        }
    }

    public function getLoginUser($email,$password){
        $sql= "SELECT * FROM `user` WHERE email = :email AND password= :password LIMIT 1";
        $query=$this->db->pdo->prepare($sql);
        $query->bindValue(':email',$email);
        $query->bindValue(':password',$password);
        $query->execute();
        $result=$query->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function userLogin(){
        $email="sayedulsayem@yahoo.com";
        $pass="sayedul";
        $password=md5($pass);

        $chk_email=$this->emailCheck($email);;

        if($email=="" OR $pass== ""){
            $msg="<div class='alert alert-danger'><strong>Error !</strong> Field must not be empty</div>";
            return $msg;
        }
        if (filter_var($email, FILTER_VALIDATE_EMAIL)=== false){
            $msg="<div class='alert alert-danger'><strong>Error !</strong> Enter a valid email address</div>";
            return $msg;
        }
        if ($chk_email==false){
            $msg="<div class='alert alert-danger'><strong>Error !</strong> this email address does not exist</div>";
            return $msg;
        }

        $result= $this->getLoginUser($email,$password);
        if ($result){
            test::init();
            test::set("login",true);

            test::set("id",$result->id);

            test::set("full_name",$result->full_name);

            test::set("user_name",$result->user_name);

            test::set("email",$result->email);

            test::set("loginmsg","<div class='alert alert-success'><strong>Success !</strong> You are loggedIn</div>");

        }
        else{
            $msg="<div class='alert alert-danger'><strong>Error !</strong> Email and password doesn't match</div>";
            return $msg;
        }
    }
}
$o=new test2();
$o->userLogin();

test::get(true);
test::get("id");
test::get("full_name");
test::get("user_name");
test::get("email");
?>