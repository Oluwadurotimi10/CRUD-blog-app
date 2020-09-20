<?php 


// defining varaibles and setting them to empty values
      $titleErr = $authorErr = $bodyErr = $imageErr = "";
      $title = $author = $body = $image = "";

//if the post form was submitted for creation

if ((isset($_POST['create'])) || (isset($_POST['update']))) {
    //$database->display($_FILES);
    //form validatipn 
    if(empty($_POST['title'])){
        $titleErr = "Post title is required";
    }
    else{
        $title = test_input($_POST['title']);
         }
    
    if(empty($_POST['author'])){
        $authorErr = "Name of author of post is required";
    }
    else{
        $author = test_input($_POST['author']);
    }
    if(empty($_POST['body'])){
        $bodyErr = "Body of post is required";
    }
    else{
        $body = test_input($_POST['body']);
    }
    if(empty($_FILES['image']['name'])){
        $imageErr = "An image upload is required for the post";
    }
    else{
       $image_name = time() . '_' . $_FILES['image']['name'];
       $image_directory = ROOT_PATH. '/others/images/' . $image_name; 

       $result = move_uploaded_file($_FILES['image']['tmp_name'], $image_directory);

       if($result){
            $_POST['image'] = $image_name;
            $image = $_POST['image'];
       }
       else{
        echo "<div class='alert alert-danger'>Unable to upload image</div>";
       }
    }
}

//function to enusre the data input is valid and secure        
function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}