<?php 

     // include database and path file
    include_once 'backEnd/config/Database.php';
    include_once 'path.php';
    
    
    //including model files
    include_once(ROOT_PATH.'/backEnd/models/post.php');
    include_once(ROOT_PATH.'/backEnd/models/category.php');
    include_once(ROOT_PATH.'/backEnd/models/user.php');
   
     //adding page header
     $page_title = "Read Posts";

     include_once "includeFiles/head_section.php";
     include_once "includeFiles/messagesPopup.php";
    
    // instantiate classes and objects
    $database = new Database();
    $db = $database->connect();
    
    $post = new Post($db);
    $category = new Category($db);

     // search_template contains the search form 
     //include_once "backEnd/api/search_template.php";

    // query products
    $results = $post->read();
    $num = $results->rowCount();

    
    //contents
    //button for creating post
    /*echo "<div class='right-button-margin'>
    <a href='backEnd/api/create.php' class='btn btn-default pull-left'>Create Post</a>
    </div>";*/

    


    echo "<div class = 'blog-wrapper clearfix'>";
if($num>0){
   
   while ($row = $results->fetch(PDO::FETCH_ASSOC)){
        extract($row);

            echo"<div class = 'each-wrapper'>";
            echo "<img src ='others/images/{$image}' alt='' class='post-image'>";
            echo "<div class='preview'>";
            echo "<br/><b><p class = 'title-wrapper'>{$title}</b> </p>";
            echo substr("<p class = 'body-wrapper'>{$body}</p>",0,150);
            echo "<span>...</span>";
            echo "<br/>";
            echo "<a href = backEnd/api/read_single.php?id={$id} class = 'btn read-more'>Read more</a>";
            echo "<p class = 'author-wrapper'><i class='fa fa-pencil-square'> {$author}</i></p>";
            "$id = {$id}";
            $category->id = $category_id;
            $category->readName();
            echo "<p class = 'category-wrapper'> Category: $category->name </p>";
            echo "<i class='fa fa-calendar' aria-hidden ='true'> {$created_at}</i>";
            

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
                    alert("Only the writer of a post can edit the post and also ensure you are logged in");    
                }
                function showMessageDelete(){
                    alert("Only the writer of a post can delete the post and also ensure you are logged in");    
                }
                </script>';
        
                //ensures user is logged in
                
                if((isset($_SESSION['id'])) && ($_SESSION['id'] == $post->user_id)){
                    echo "<a href='backEnd/api/update.php?id={$id}'";}
                echo" <button class='btn btn-info left-margin'";
                if(((isset($_SESSION['id'])) && ($_SESSION['id'] != $post->user_id)) || (!isset($_SESSION['id']))){
                echo "onclick ='showMessage()'";}
                echo"><span class='glyphicon glyphicon-edit'>Edit</span></button> 
                    </a>";
                
                if((isset($_SESSION['id'])) && ($_SESSION['id'] == $post->user_id)){
                echo" <a href = 'backEnd/api/delete.php?id={$id}' ";}
                echo"<button class='btn btn-danger delete-object'";
                if(((isset($_SESSION['id'])) && ($_SESSION['id'] != $post->user_id)) || (!isset($_SESSION['id']))){
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
    echo "</div>";

     //adding page footer
    include_once "includeFiles/footer.php"
    ?> 

    