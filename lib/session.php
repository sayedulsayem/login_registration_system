<?php

class session {
    public static function init()
    {
        if (version_compare(phpversion(),'5.4.0','<')){
            if (session_id()==""){
               /// session_start();
            }
            else{
                if (session_status()== PHP_SESSION_NONE){
                    //session_start();
                }
            }
        }
    }
    public static function set($key,$value){
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION[$key]=$value;
    }
    public static function get($key){
       if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
        if (isset($_SESSION[$key])){
            return $_SESSION[$key];
        }
        else{
            return false;
        }
    }
    public static function destroy(){
        session_destroy();
        session_unset();
        header("Location: login.php");
    }
}

?>