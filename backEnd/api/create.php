<?php
    
    // include database and object files
    include_once 'C:\xampp\htdocs\phpdocs\CRUD-blog-app\backEnd\config\Database.php';
    include_once 'C:\xampp\htdocs\phpdocs\CRUD-blog-app\backEnd\models\post.php';
    include_once 'C:\xampp\htdocs\phpdocs\CRUD-blog-app\backEnd\models\category.php';
    include_once 'C:\xampp\htdocs\phpdocs\CRUD-blog-app\backEnd\models\user.php';
    
    // get database connection
    $database = new Database();
    $db = $database->connect();
    
    // prepare objects
    $post = new Post($db);
    $category = new Category($db);
    $user = new User($db);

// set page headers
$page_title = "Create Post";
include_once 'C:\xampp\htdocs\phpdocs\CRUD-blog-app\includeFiles\head_section.php';
  
echo "<button class='read-redirec'><a href='/phpdocs/CRUD-blog-app/index.php'>Read Posts</a></button>";
  

    // if the form was submitted 
    if($_POST){
    
        // set product property values
        $post->title = $_POST['title'];
        $post->author = $_POST['author'];
        $post->body = $_POST['body'];
        $post->image = $_POST['image'];
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
?>
  
<!-- HTML form for creating a post -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" class = "create-wrapper">
<div class = "create-inner-wrapper">
            <h4 class = "text-wrapper"> Title </h4>
            <input type='text' name='title' class='form-control' />

            <h4 class = "text-wrapper">Author </h4>
            <input type='text' name='author' class='form-control' />

            <h4 class = "text-wrapper">Body </h4>
            <textarea name='body' class='form-control'></textarea>

            <h4 class = "text-wrapper">Image </h4>
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

                echo "<br/><button type='submit' class='btn btn-primary'>Create</button>";
            ?>
           </div>
</form>
  
<?php

 /* //adding page footer
    include_once "includeFiles/footer.php"
    ?> */