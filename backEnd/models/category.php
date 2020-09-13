<?php 

    class Category{
        //DB stuff
        private $conn;
        private $table = 'categories';

        // category Properties/ Attributes
        public $id;
        public $name;
        
        public function __construct($db){
            $this->conn = $db;
        }
        // get category names for the dropdown
        function read(){
            $query = "SELECT
                        c.id,
                        c.name
                        FROM 
                        ". $this->table ." c
                        ORDER BY 
                        c.name";
            
            //prepare statement
            $stmt = $this->conn->prepare($query);

            //execute query
            $stmt->execute();

            return $stmt;
        }

        //used to read category name by its ID
        function readName(){
            $query = "SELECT
                     name
                     FROM
                     ". $this->table ." 
                     WHERE 
                     id=? 
                     limit 0,1";
            
            //prepare statement
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->id);
            //execute query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $this->name = $row['name'];
        }
    }

?>
