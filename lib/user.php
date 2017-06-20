<?php
include_once "database.php";
include_once "session.php";
class user {
    private $db;
    public function __construct()
    {
        $this->db=new database();
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
    public function userRegistration($data){
        $full_name=$data['full_name'];
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
            $msg="<div class='alert alert-danger'><strong>Error !</strong> this user email already registered </div>";
            return $msg;
        }
        $sql="INSERT INTO user (full_name, user_name, email, password)
              VALUES (:full_name, :user_name, :email, :password)";
        $query=$this->db->pdo->prepare($sql);
        $query->bindValue(':full_name',$full_name);
        $query->bindValue(':user_name',$user_name);
        $query->bindValue(':email',$email);
        $query->bindValue(':password',$password);
        $result=$query->execute();
        if ($result){
            $msg="<div class='alert alert-success'><strong>Success !</strong> thank you, you have registerd</div>";
            return $msg;
        }else{
            $msg="<div class='alert alert-danger'><strong>Error !</strong>
             sorry ! there is a problem to insert your data. try again later</div>";
            return $msg;
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

    public function userLogin($data){
        
 
        $email=$data['email'];
        $pass=$data['password'];
        $password=md5($pass);

        $chk_email=$this->emailCheck($email);

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
            session::init();
            session::set("login",true);
            session::set("id",$result->id);
            session::set("full_name",$result->full_name);
            session::set("user_name",$result->user_name);
            session::set("email",$result->email);
            session::set("loginmsg","<div class='alert alert-success'><strong>Success !</strong> You are loggedIn</div>");
            header("location:index.php");
        }
        else{
            $msg="<div class='alert alert-danger'><strong>Error !</strong> Email and password doesn't match</div>";
            return $msg;
        }
    }
    public function getUserData(){
        $sql= "SELECT * FROM `user` ORDER BY id DESC";
        $query=$this->db->pdo->prepare($sql);
        $query->execute();
        $result=$query->fetchAll();
        return $result;
    }
    public function getUserDataById($userId){
        $sql= "SELECT * FROM `user` WHERE id= :id LIMIT 1";
        $query=$this->db->pdo->prepare($sql);
        $query->bindValue(':id',$userId);
        $query->execute();
        $result=$query->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    public function updateUserData($data){
        $id=$data['id'];
        $full_name=$data['full_name'];
        $user_name=$data['user_name'];
        $email=$data['email'];
        if($full_name=="" OR $user_name=="" OR $email==""){
            $msg="<div class='alert alert-danger'><strong>Error !</strong> Field must not be empty</div>";
            return $msg;
        }
        if (filter_var($email, FILTER_VALIDATE_EMAIL)=== false){
            $msg="<div class='alert alert-danger'><strong>Error !</strong> Enter a valid email address</div>";
            return $msg;
        }

        $sql="UPDATE  user set
                full_name= :full_name,
                user_name= :user_name,
                email = :email
                WHERE id= :id";

        $query=$this->db->pdo->prepare($sql);
        $query->bindValue(':full_name',$full_name);
        $query->bindValue(':user_name',$user_name);
        $query->bindValue(':email',$email);
        $query->bindValue(':id',$id);
        $result=$query->execute();
        if ($result){
            $msg="<div class='alert alert-success'><strong>Success !</strong> your data has been updated </div>";
            return $msg;
        }else{
            $msg="<div class='alert alert-danger'><strong>Error !</strong>
             sorry ! there is a problem to update your data. try again later</div>";
            return $msg;
        }
    }

    public function checkPassword($id,$old_pass){
        $sql="SELECT * FROM user WHERE id= :id";
        $query=$this->db->pdo->prepare($sql);
        $query->bindParam(':id',$id);
        $query->execute();
        $result=$query->fetch(PDO::FETCH_OBJ);
        $o_pass=$result->password;
        if($o_pass==$old_pass){
            return true;
        }
        else{
            return false;
        }
    }

    public function updatepassword($id,$data){
        $o_pass=$data['old_pass'];
        $old_pass=md5($o_pass);
        $n_pass=$data['new_pass'];
        $new_pass=md5($n_pass);

        $chk_pass= $this->checkPassword($id,$old_pass);

        if ($o_pass== "" OR $n_pass== ""){
            $msg="<div class='alert alert-danger'><strong>Error !</strong>
             Field must not be empty</div>";
            return $msg;
        }

        if($chk_pass==false){
            $msg="<div class='alert alert-danger'><strong>Error !</strong>
             Password doesn't match</div>";
            return $msg;
        }

        if(strlen($n_pass) < 6){
            $msg="<div class='alert alert-danger'><strong>Error !</strong> Password must be at least 6 Characters</div>";
            return $msg;
        }
        elseif (preg_match('/[^a-z0-9_-]+/i', $n_pass)){
            $msg="<div class='alert alert-danger'><strong>Error !</strong> Characters must be a-z,0-9,_,-</div>";
            return $msg;
        }

        $sql="UPDATE  user set
                password= :password
                WHERE id= :id";

        $query=$this->db->pdo->prepare($sql);
        $query->bindValue(':password',$new_pass);
        $query->bindValue(':id',$id);
        $result=$query->execute();
        if ($result){
            $msg="<div class='alert alert-success'><strong>Success !</strong> your password has been changed </div>";
            return $msg;
        }else{
            $msg="<div class='alert alert-danger'><strong>Error !</strong>
             sorry ! there is a problem to update your data. try again later</div>";
            return $msg;
        }
    }
}

?>

