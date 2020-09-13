<?php
 // check if value was posted
 $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

  
   // include database and object files
   include_once 'C:\xampp\htdocs\phpdocs\CRUD-blog-app\backEnd\config\Database.php';
   include_once 'C:\xampp\htdocs\phpdocs\CRUD-blog-app\backEnd\models\post.php';

  
    // get database connection
    $database = new Database();
    $db = $database->connect();
  
    // prepare post object
    $post = new Post($db);
      
    // set product id to be deleted
    $post->id = $id;


    //set page header
    $page_title = "Deleted Post Notification";
    include_once 'C:\xampp\htdocs\phpdocs\CRUD-blog-app\includeFiles\head_section.php';

    echo "<button class='read-redirec'><a href='/phpdocs/CRUD-blog-app/index.php'>Read Posts</a></button>";
      
    // delete the post
    if($post->delete()){
        echo "<p class = 'delete-noti'>Post has been deleted</p>";
    }   
    // if unable to delete the post
    else{
        echo "<p class = 'delete-noti'>Unable to delete post</p>";
    }

?>
