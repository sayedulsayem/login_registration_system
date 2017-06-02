<?php
include_once "database.php";
include_once "seassion.php";
class user {
    private $db;
    public function __construct()
    {
        $this->db=new database();
    }
    public function user_registration($data){
        $full_name=$data['name'];
        $user_name=$data['user_name'];
        $email=$data['email'];
        $pass=$data['password'];
        $password=md5($pass);

        $chk_email=$this->emailCheck($email);

        if($full_name=="" OR $user_name=="" OR $email=="" OR $pass== ""){
            $msg="<div class='alert alert-danger'><strong>Error !</strong> Field must not be empty</div>";
            return $msg;
        }
        if(strlen($pass) < 6){
            $msg="<div class='alert alert-danger'><strong>Error !</strong> Password must be at least 6 Characters</div>";
            return $msg;
        }
        elseif (preg_match('/[^a-z0-9_-]+/i', $pass)){
            $msg="<div class='alert alert-danger'><strong>Error !</strong> Characters must be a-z,0-9,_,-</div>";
            return $msg;
        }
        if (filter_var($email, FILTER_VALIDATE_EMAIL)=== false){
            $msg="<div class='alert alert-danger'><strong>Error !</strong> Enter a valid email address</div>";
            return $msg;
        }
        if ($chk_email==true){
            $msg="<div class='alert alert-danger'><strong>Error !</strong> this email address is already exist</div>";
            return $msg;
        }

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
}

?>

