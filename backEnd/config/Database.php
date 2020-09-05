<?php
    class Database {
        //DB Params
        private $host = 'localhost';
        private $dbname = 'myblog';
        private $username = 'root';
        private $password = '#thankFUL02';
        public $conn;
    
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
}

?>