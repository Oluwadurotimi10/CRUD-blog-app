<?php
    
    // include database and object files
    include_once '../config/Database.php';
    include_once '../../path.php';
    include_once '../models/post.php';
    include_once '../models/category.php';
    include_once '../models/user.php';
    
    // get database connection
    $database = new Database();
    $db = $database->connect();
    
    // prepare objects
    $post = new Post($db);
    $category = new Category($db);
    $user = new User($db);

// set page headers
$page_title = "Create Post";
include_once '../../includeFiles/head_section.php';
//including validation
include_once '../../includeFiles/postValidation.php';
  
echo "<button class='read-redirec'><a href='../../index.php'>Read Posts</a></button>";
  

    
    //setting the conditions for a post to be created
if (isset($_POST["title"]) && isset($_POST["author"]) && isset($_POST["body"]) && isset($_FILES['image']['name'])){
    if(!empty($_POST["title"]) && !empty($_POST["author"]) && !empty($_POST["body"]) && !empty($_FILES['image']['name'])){
        if(empty($titleErr) && empty($authorErr) && empty($bodyErr) && empty($imageErr)){
              
        // set product property values
        $post->title = $title;
        $post->author = $author;
        $post->body = $body;
        $post->image = $image;
        $post->user_id = $_SESSION['id'];
        $post->category_id = $_POST['category_id'];
    
        // create the product
        if($post->create()){
            echo "<div class='alert alert-success'>Post was created.</div>";
        }
    
        // if unable to create the post, tell the user
        else{
            echo "<div class='alert alert-danger'>Unable to create post.</div>";
        }
    }
 }
} 
?>
 
<!-- HTML form for creating a post -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype = "multipart/form-data" class = "create-wrapper">
<div class = "create-inner-wrapper">
            <h4 class = "text-wrapper"> Title </h4>
            <span class ="error"> <?php echo $titleErr;?></span> 
            <input type='text' id='title' name='title' value = '<?php echo $title ?>' class='form-control' />

            <h4 class = "text-wrapper">Author </h4>
            <span class ="error"> <?php echo $authorErr;?></span>
            <input type='text' id='author' name='author' value = '<?php echo $author ?>' class='form-control' />

            <h4 class = 'text-wrapper'>Body </h4>
            <span class ="error"> <?php echo $bodyErr;?></span>
            <textarea name='body' class='form-control'><?php if(!empty($_POST["body"])){ echo $body; } ?></textarea>

            <h4 class = "text-wrapper">Image </h4>
            <span class ="error"> <?php echo $imageErr;?></span>
            <input type='file' name='image' class='form-control' />

            <h4 class = "text-wrapper">Category </h4>
            <?php
                // read the categories from the database
                $stmt = $category->read();
                
                // put them in a select drop-down
                echo "<select class='form-control' name='category_id'>";
                    echo "<option>Select category...</option>";
                
                    while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)){
                        extract($row_category);
                        echo "<option value='{$id}'>{$name}</option>";
                    }
                echo "</select>";

                echo "<br/><button type='submit' name='create'  class='btn btn-primary'>Create</button>";
            ?>
           </div>
</form>
  
<?php

  //adding page footer
  include_once '../../includeFiles/footer.php';
    ?> 