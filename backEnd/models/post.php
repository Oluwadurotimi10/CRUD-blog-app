<?php
    class Post{
        //DB stuff
        private $conn;
        private $table = 'posts';

        // Post Properties/ Attributes
        public $id;
        public $category_id;
        public $category_name;
        public $title;
        public $body;
        public $author;
        public $created_at;
        public $modified_at;

        //Constructor with DB (just like init method in python)
        public function __construct($db) {
            $this->conn = $db;
        } 

        //Get Posts  (methods)
        public function read(){
            //Create query
        $query = "SELECT 
            c.name as category_name,
            p.id,
            p.category_id,
            p.title,
            p.body,
            p.author,
            p.created_at,
            p.modified_at
            FROM
            ". $this->table ." p
            LEFT JOIN 
            categories c ON p.category_id = c.id
            ORDER BY 
            p.created_at DESC";

            //prepare statement
            $stmt = $this->conn->prepare($query);

            //execute query
            $stmt->execute();

            return $stmt;
        }
        // used for counting the total number of records in the databse for paging
        public function countAll(){
            $query = "SELECT
                     id 
                     FROM
                      " . $this->table . "";
        //prepare statement
            $stmt = $this->conn->prepare( $query );
        
        //execute query
            $stmt->execute();
        
            $num = $stmt->rowCount();
        
            return $num;
        } 
        //for reading the details of post to be edited 
        public function readOne(){
  
            $query = "SELECT
                        title,
                        body,
                        author,
                        category_id
                    FROM
                        " . $this->table . "
                    WHERE
                        id = ?
                    LIMIT
                        0,1";
            //prepare statement
            $stmt = $this->conn->prepare( $query );

            //Clean data
            $this->id = htmlspecialchars(strip_tags($this->id));

            //binding the first id to the variable
            $stmt->bindParam(1, $this->id);

            // execute query
            $stmt->execute();
            
            //fetching statemrnt
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            extract($row);
          
            $this->title = $title;
            $this->body = $body;
            $this->author = $author;
            $this->category_id = $category_id;
        } 

         //Create Post
        public function create(){
            //Create query
            $query = 'INSERT INTO
                '. $this->table .'
                SET 
                title = :title,
                body = :body,
                author = :author,
                category_id = :category_id';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean data
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->body = htmlspecialchars(strip_tags($this->body));
            $this->author = htmlspecialchars(strip_tags($this->author));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id)); 

            //Bind data
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':body', $this->body);
            $stmt->bindParam(':author', $this->author);
            $stmt->bindParam(':category_id', $this->category_id);
        
            //Execute query
            if($stmt->execute()){
                return true;
            }
            //Print error if something goes wrong
            printf("Error: %s.\n",$stmt->error);

            return false;
        }

        //Update Post
        public function update(){
            //Create query
            $query = "UPDATE 
                    ". $this->table ."
                    SET 
                    title = :title,
                    body = :body,
                    author = :author,
                    category_id = :category_id
                    WHERE   
                    id = :id";

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Clean data
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->body = htmlspecialchars(strip_tags($this->body));
            $this->author = htmlspecialchars(strip_tags($this->author));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));
            $this->id = htmlspecialchars(strip_tags($this->id));



            //Bind data
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':body', $this->body);
            $stmt->bindParam(':author', $this->author);
            $stmt->bindParam(':category_id', $this->category_id);
            $stmt->bindParam(':id', $this->id);
            
            //Execute query
            if($stmt->execute()){
                return true;
            }else{
            //Print error if something goes wrong
            printf("Error: %s.\n",$stmt->error);

            return false; }
        }

        // delete the product
        function delete(){
        
            $query = "DELETE FROM
                    " . $this->table . "
                    WHERE 
                    id = ?";

            //prepare statements
            $stmt = $this->conn->prepare($query);

            //Clean data
            $this->id = htmlspecialchars(strip_tags($this->id));

            //bind data
            $stmt->bindParam(1, $this->id);
        
            if($result = $stmt->execute()){
                return true;
            }else{
                return false;
            }
        }
    }