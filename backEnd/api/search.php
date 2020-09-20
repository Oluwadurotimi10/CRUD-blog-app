<?php
  
// include database and object files
include_once '../config/Database.php';
include_once '../../path.php';
include_once '../models/post.php';
include_once '../models/category.php';
include_once '../models/user.php';

  
// instantiate database and product object
$database = new Database();
$db = $database->connect();
  
// prepare objects
$post = new Post($db);
$category = new Category($db);
$user = new User($db);

  
// get search term
$search_term=isset($_GET['s']) ? $_GET['s'] : '';
  
$page_title = "You searched for {$search_term}";
include_once '../../includeFiles/head_section.php';

// search_template contains the search form 
include_once "search_template.php";
  
// query posts
$results = $post->search($search_term);
$num = $results->rowCount();

/*// specify the page where paging is used
$page_url="search.php?s={$search_term}&";
  
// count total rows - used for pagination
$total_rows=$product->countAll_BySearch($search_term);*/

// display the posts if there are any
echo "<div class = 'blog-wrapper clearfix'>";
if($num>0){
   
   while ($row = $results->fetch(PDO::FETCH_ASSOC)){
        extract($row);

           echo"<div class = 'each-wrapper'>";
           echo "<img src ='../../others/images/{$image}' alt='' class='post-image'>";
           echo "<div class='preview'>";
           echo "<br/><b><p class = 'title-wrapper'>{$title}</b> </p>";
           echo substr("<p class = 'body-wrapper'>{$body}</p>",0,150);
           echo "<span>...</span>";
           echo "<br/>";
           echo "<a href = read_single.php?id={$id} class = 'btn read-more'>Read more</a>";
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
                   alert("Only the writer of a post can edit the post and ensure you are logged in");    
               }
               function showMessageDelete(){
                   alert("Only the writer of a post can delete the post and ensure you are logged in");    
               }
               </script>';
       
               //ensures user is logged in
            
               if((isset($_SESSION['id'])) && ($_SESSION['id'] == $post->user_id)){
                   echo "<a href='update.php?id={$id}'";}
               echo" <button class='btn btn-info left-margin'";
               if(((isset($_SESSION['id'])) && ($_SESSION['id'] != $post->user_id)) || (!isset($_SESSION['id']))){
               echo "onclick ='showMessage()'";}
               echo"><span class='glyphicon glyphicon-edit'>Edit</span></button> 
                   </a>";
               
              if((isset($_SESSION['id'])) && ($_SESSION['id'] == $post->user_id)){
              echo" <a href = 'delete.php?id={$id}' ";}
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

  

  
/*// layout_footer.php holds our javascript and closing html tags
include_once "layout_footer.php";
?>*/
