<?php
class Database{
 
    // specify your own database credentials
    //private $host = "db719225983.db.1and1.com";
    //private $db_name = "db719225983";
    //private $username = "dbo719225983";
    //private $password = "hackathon2018!A";
    public $conn;
 
    // get the database connection
    public function __construct(){
 
        try{
            $this->conn = new PDO("mysql:host=db719225983.db.1and1.com;dbname=db719225983", "dbo719225983", "hackathon2018!A");
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
    }
}
?>