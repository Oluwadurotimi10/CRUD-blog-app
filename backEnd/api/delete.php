<?php
 // check if value was posted
 $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

  
   // include database,path and object files
   include_once '../config/Database.php';
   include_once '../../path.php';
   include_once '../models/post.php';

  
    // get database connection
    $database = new Database();
    $db = $database->connect();
  
    // prepare post object
    $post = new Post($db);
      
    // set product id to be deleted
    $post->id = $id;


    //set page header
    $page_title = "Deleted Post Notification";
    include_once '../../includeFiles/head_section.php';

    echo "<button class='read-redirec'><a href='../../index.php'>Read Posts</a></button>";
      
    // delete the post
    if($post->delete()){
        echo "<p class = 'delete-noti'>Post has been deleted</p>";
    }   
    // if unable to delete the post
    else{
        echo "<p class = 'delete-noti'>Unable to delete post</p>";
    }

include_once '../../includeFiles/footer.php';  
?>
