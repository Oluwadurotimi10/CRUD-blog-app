<?php 

     // include database and object files
    include_once 'backEnd/config/Database.php';
    include_once 'backEnd/models/post.php';
    include_once 'backEnd/models/category.php';
    include_once 'backEnd/models/user.php';
    
    // instantiate classes and objects
    $database = new Database();
    $db = $database->connect();
    
    $post = new Post($db);
    $category = new Category($db);

    // query products
    $results = $post->read();
    $num = $results->rowCount();

    //adding page header
    $page_title = "Read Posts";
    include_once "includeFiles/head_section.php";
    include_once "includeFiles/messagesPopup.php";

    
    //contents
    //button for creating post
    /*echo "<div class='right-button-margin'>
    <a href='backEnd/api/create.php' class='btn btn-default pull-left'>Create Post</a>
    </div>";*/

        // display the posts if there are any
    if($num>0){
    
            while ($row = $results->fetch(PDO::FETCH_ASSOC)){
                 extract($row);
    
                echo "<div class = 'blog-wrapper'>";
                    echo"<div class = 'each-wrapper'>";
                    echo "<br/><p class = 'title-wrapper'>Title:{$title} </p>";
                    echo substr("<p class = 'body-wrapper'>{$body} </p>",0,150);
                    echo "<a href = backEnd/api/read_single.php?id={$id} > <br/ class = 'more'>Read more.....</a>";
                    echo "<p class = 'author-wrapper'>Author: {$author} </p>";
                    "$id = {$id}";
                    $category->id = $category_id;
                    $category->readName();
                    echo "<p class = 'category-wrapper'> Category: $category->name </p>";

                    echo "<p class='date-wrapper'>Created at: {$created_at} </p>";

                echo "<div class = 'buttons'>";
                    // read one, edit and delete button will be here
                    /*echo "<a href='backEnd/api/read_single.php?id={$id}' class='btn btn-primary left-margin'>
                        <span class='glyphicon glyphicon-list'></span> Read
                        </a>*/

                         // set ID property of post to be read
                         $post->id = $id;

                        //read the details of product to be edited
                        $post->readOne();
                       
                        //alerts if the edit or delete buttons are clicked
                        echo '<script type="text/javascript">
                        function showMessage(){
                            alert("Only the writer of a post can edit the post");    
                        }
                        function showMessageDelete(){
                            alert("Only the writer of a post can delete the post");    
                        }
                        </script>';
                
                        //ensures user is logged in
                     
                        if((isset($_SESSION['id'])) && ($_SESSION['id'] == $post->user_id)){
                            echo "<a href='backEnd/api/update.php?id={$id}'";}
                        echo" <button class='btn btn-info left-margin'";
                        if((isset($_SESSION['id'])) && ($_SESSION['id'] != $post->user_id)){
                        echo "onclick ='showMessage()'";}
                        echo"><span class='glyphicon glyphicon-edit'>Edit</span></button> 
                            </a>";
                        
                       if((isset($_SESSION['id'])) && ($_SESSION['id'] == $post->user_id)){
                       echo" <a href = 'backEnd/api/delete.php?id={$id}' ";}
                       echo"<button class='btn btn-danger delete-object'";
                       if((isset($_SESSION['id'])) && ($_SESSION['id'] != $post->user_id)){
                        echo "onclick ='showMessageDelete()'";}
                        echo"><span class='glyphicon glyphicon-remove'>Delete</span></button> 
                        </a>";

                echo "</div>";
                echo "</div>";
        echo "</div>";
        
            }
        }  
    
  
        // tell the user there are no pts
    else{
        echo "<div class='alert alert-info'>No posts found.</div>";
    }
 
    /* //adding page footer
    include_once "includeFiles/footer.php"
    ?> */

    