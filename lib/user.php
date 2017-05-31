<?php
include_once "database.php";
include_once "seassion.php";
class user {
    private $db;
    public function __construct()
    {
        $this->db=new database();
    }
}

?>