<?php

//starting session here, since this file is included in every other file
session_start();

//including the path
include (__DIR__ .'/../../path.php');

// Load Composer's autoloader
require_once(ROOT_PATH.'/vendor/autoload.php');


$dotenv = Dotenv\Dotenv::createUnsafeImmutable(ROOT_PATH);
$dotenv->load();

//creating the database class
  class Database {
         
        //DB Params 
        private $host; 
        private $dbname ;
        private $username; 
        private $password ;
        public $conn;

        public function __construct(){
            $this->host = getenv('DB_HOST');
            $this->dbname = getenv('DB_DBNAME');
            $this->username = getenv('DB_USER');
            $this->password = getenv('DB_PASSWORD');
        }
    
     //DB Connect
     public function connect(){
        $this->conn = null;
        try{
             //Set DSN 
            $dsn = 'mysql:host='.$this->host . ';dbname='. $this->dbname;
             //Create a PDO instance
            $this->conn = new PDO($dsn, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }
        return $this->conn;
    }
    //gives output in a more readable form
    public function display($value){
        echo"<pre>",print_r($value,true),"</pre>";
        die();
    }
}
//$hi = new Database;
//echo($hi->host);
?>