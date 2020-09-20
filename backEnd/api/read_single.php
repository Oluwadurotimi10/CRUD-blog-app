<?php
// get ID of the post to be read
    $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
    
     // include database,path and object files
     include_once '../config/Database.php';
     include_once '../../path.php';
     include_once '../models/post.php';
     include_once '../models/category.php';
       
    // get database connection
    $database = new Database();
    $db = $database->connect();
    
    // prepare objects
    $post = new Post($db);
    $category = new Category($db);
    
    // set ID property of post to be read
    $post->id = $id;
    
    // read the details of post to be read
    $post->readOne();

// set page headers
    $page_title = "Viewing A Single Post";
    include_once '../../includeFiles/head_section.php';

    //ensures user is logged in
    if(isset($_SESSION['id'])){

    // read products button
    echo "<button class='read-redirec'><a href='../../index.php'>Read Posts</a></button>";

    //table displaying a single post
    // HTML table for displaying a product details
    echo "<div class = 'Rone-wrapper'>";
            echo "<img src ='../../others/images/{$post->image}' alt='' class='post-image'>";

            echo "<h3>Title </h3>";
            echo "<p>{$post->title}</p>";
    
            echo "<h3>Body</h3>";
            echo "<p>{$post->body}</p>";
       
            echo "<h3>Author</h3>";
            echo "<p>{$post->author}</p>";
       
            echo "<h3>Category</h3></p>";
            
                // display category name
                $category->id=$post->category_id;
                $category->readName();
                echo "<p> $category->name</p>";

            echo "<h3>Created_at</h3>";
            echo "<p>{$post->created_at}</p>";
        echo "</div>" ; 
    }
    else{
        echo "<div class='alert alert-danger'>Please ensure you are logged in</div>";
    }  
    
   /* //adding page footer
    include_once 'C:\xampp\htdocs\phpdocs\CRUD blog app\includeFiles\footer.php';
    ?> */