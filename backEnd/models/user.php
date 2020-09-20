<?php 
    class User{
        //DB stuff
        private $conn;
        private $table = 'users';

        // users Properties/ Attributes
        public $id;
        public $username;
        public $email;
        public $passcode;
        public $created_at;
        
        public function __construct($db){
            $this->conn = $db;
        }
//Create user
        public function create(){
            //Create query
            $query = 'INSERT INTO
                '. $this->table .'
                SET 
                username = :username,
                email = :email,
                passcode = :passcode';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean data
            $this->username = htmlspecialchars(strip_tags($this->username));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->passcode = htmlspecialchars(strip_tags($this->passcode));

            //hashing password for protection
            $this->passcode = password_hash($this->passcode,PASSWORD_DEFAULT);

            //Bind data
            $stmt->bindParam(':username', $this->username);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':passcode', $this->passcode);
        
            //Execute query
            if($stmt->execute()){
                return true; 
            }
            //Print error if something goes wrong
            printf("Error: %s.\n",$stmt->error);

            return false;
        }

        //reading id and username
        // get category names for the dropdown
        function read(){
            $query = "SELECT
                        u.id,
                        u.username
                        FROM 
                        ". $this->table ." u
                        ORDER BY 
                        u.username";
            
            //prepare statement
            $stmt = $this->conn->prepare($query);

            //execute query
            $stmt->execute();

            return $stmt;
        }

        //for checking if an email exists already
        public function selectOne($email){
  
            $query = "SELECT
                        id,
                        username,
                        email,
                        passcode
                    FROM
                        " . $this->table . "
                    WHERE
                        email = ?
                    LIMIT
                        0,1";
            //prepare statement
            $stmt = $this->conn->prepare( $query );

            //binding the first email to the variable
            //$stmt->bindParam(1, $this->email);

            // execute query
            $stmt->execute([$email]);
          
            return $stmt;
        }
        //Update user data
        public function update(){
            //Create query
            $query = "UPDATE 
                    ". $this->table ."
                    SET 
                    passcode = :passcode,
                    WHERE   
                    email = :email";

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //clean data
            $this->passcode = htmlspecialchars(strip_tags($this->passcode));
            $this->email = htmlspecialchars(strip_tags($this->email));

            //hashing password for protection
            $this->passcode = password_hash($this->passcode,PASSWORD_DEFAULT);

            //Bind data
            $stmt->bindParam(':passcode', $this->passcode);
            $stmt->bindParam(':email', $this->email);
            
            //Execute query
            if($stmt->execute()){
                return true;
            }else{
            //Print error if something goes wrong
            printf("Error: %s.\n",$stmt->error);

            return false; }
        }
    }
