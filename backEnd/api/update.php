<?php
// update one post 
    // get ID of the post to be edited
    $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
    
    // include database and object files
    include_once 'C:\xampp\htdocs\phpdocs\CRUD-blog-app\backEnd\config\Database.php';
    include_once 'C:\xampp\htdocs\phpdocs\CRUD-blog-app\backEnd\models\post.php';
    include_once 'C:\xampp\htdocs\phpdocs\CRUD-blog-app\backEnd\models\category.php';

    
    // get database connection
    $database = new Database();
    $db = $database->connect();
    
    // prepare objects
    $post = new Post($db);
    $category = new Category($db);

    //set ID property of product to be edited
    $post->id = $id;
    
    //read the details of product to be edited
    $post->readOne();

  
// set page header
$page_title = "Update Post";
include_once 'C:\xampp\htdocs\phpdocs\CRUD-blog-app\includeFiles\head_section.php';
  
    echo  "<button class='update-redirec'><a href='/phpdocs/CRUD-blog-app/index.php'>Read Posts</a></button>";
    
    ?>
        <?php

    // when the form is submitted
    if($_POST){

        // set post property values
        $post->title = $_POST['title'];
        $post->body = $_POST['body'];
        $post->author = $_POST['author'];
        $post->image = $_POST['image'];
        $post->category_id = $_POST['category_id'];
    
        // update the post
        if($post->update()){
            echo "<div class='alert alert-success alert-dismissable'>";
                echo "Post was updated.";
            echo "</div>";
        }
    
        // if unable to update the post, tell the user
        else{
            echo "<div class='alert alert-danger alert-dismissable'>";
                echo "Unable to update product.";
            echo "</div>";
        }
    }
     ?>          
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . "?id={$id}");?>" method='POST' class ='update-wrapper'>
        <div class ='update-inner-wrapper'>
        <h4 class = 'text-wrapper'> Title </h4>
            <input type='text' name='title' value='<?php echo $post->title; ?>' class='form-control' />
            
        <h4 class = 'text-wrapper'>Author </h4>
            <input type='text' name='author' value='<?php echo $post->author; ?>' class='form-control' />
                
        <h4 class = 'text-wrapper'>Body </h4>
            <textarea name='body' class='form-control'><?php echo $post->body; ?></textarea>

        <h4 class = 'text-wrapper'>Image </h4>
        <input type='file' name='image' value='<?php echo $post->image; ?>' class='form-control' />
            
        <h4 class = 'text-wrapper'>Category </h4>"
            <?php
                $stmt = $category->read();
                
                // put them in a select drop-down
                echo "<select class='form-control' name='category_id'>";
                
                    echo "<option>Please select...</option>";
                    while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)){
                        $category_id=$row_category['id'];
                        $category_name = $row_category['name'];
                
                        // current category of the product must be selected
                        if($post->category_id==$category_id){
                            echo "<option value='$category_id' selected>";
                        }else{
                            echo "<option value='$category_id'>";
                        }
                
                        echo "$category_name</option>";
                    }
                echo "</select>";
            echo "<br/><button type='submit' class='btn btn-primary'>Update</button>"
        ?>          
    </div>
</form>  
        <?php        

/* //adding page footer
    include_once "includeFiles/footer.php"
    ?> */