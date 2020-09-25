<?php
// update one post 
    // get ID of the post to be edited
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

    //set ID property of product to be edited
    $post->id = $id;
    
    //read the details of product to be edited
    $post->readOne();

  
// set page header
$page_title = "Update Post";
include_once '../../includeFiles/head_section.php';

//including validation
include_once '../../includeFiles/postValidation.php';
  
    echo  "<button class='update-redirec'><a href='../../index.php'>Read Posts</a></button>";
    
    ?>
        <?php

    //setting the conditions for a post to be updated
if (isset($_POST["title"]) && isset($_POST["author"]) && isset($_POST["body"]) && isset($_FILES['image']['name'])){
        if(empty($titleErr) && empty($authorErr) && empty($bodyErr)){

        // set post property values
        $post->title = $title;
        $post->body = $body;
        $post->author = $author;
        if(!empty($_POST['image'])){
        $post->image = $image;}
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
    } }
     ?>         
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . "?id={$id}");?>" method='POST' enctype = "multipart/form-data" class ='update-wrapper'>
        <div class ='update-inner-wrapper'>
        <h4 class = 'text-wrapper'> Title </h4>
        <span class ="error"> <?php echo $titleErr;?></span> 
        <input type='text' name='title' value='<?php echo $post->title; ?>' class='form-control' />
            
        <h4 class = 'text-wrapper'>Author </h4>
        <span class ="error"> <?php echo $authorErr;?></span>
        <input type='text' name='author' value='<?php echo $post->author; ?>' class='form-control' />
                
        <h4 class = 'text-wrapper'>Body </h4>
        <span class ="error"> <?php echo $bodyErr;?></span>
        <textarea name='body' class='form-control'><?php echo $post->body; ?></textarea>

        <h4 class = 'text-wrapper'>Image </h4>
        <input type='file' name='image' class='form-control' />
            
        <h4 class = 'text-wrapper'>Category </h4>
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
            echo "<br/><button type='submit' name = 'update' class='btn btn-primary'>Update</button>"
        ?>          
    </div>
</form>  
        <?php        

 //adding page footer
    include_once '../../includeFiles/footer.php';
    ?> 