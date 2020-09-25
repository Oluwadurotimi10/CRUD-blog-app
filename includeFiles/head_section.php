<!DOCTYPE html>
<html lang ="en">

    <head>
        <!-- showing page title-->
        <title><?php echo $page_title; ?></title>  

        <!-- Styling for public area -->
        <link rel='stylesheet' type= 'text/css' href= "<?php echo BASE_URL .'/others/style_nav.css' ?>">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"/>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Latest compiled and minified Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
        
        <!-- meta tags -->
        <meta charset = "UTF-8">
        <meta name = "viewport" content ="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie-edge">
        <!-- Font Awesome -->

        <!--Jquery-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" ></script>
        
        <!--custom script 
        <script>
        $(document).ready(function(){
            $('.toggle').click(function(){
                $('.menu').toggleClass('show');
            });
        });
        </script>-->

</head>
<body>

<!-- container -->
    <!--<div class="container"> </div> -->
    <?php include_once 'navBar.php'; 

    // search_template contains the search form 
    if($page_title == "Read Posts"){
    include_once(ROOT_PATH. "/backEnd/api/search_template.php"); 
}
        // show page header
        echo "<div class='page-header'>
                <h3>{$page_title}</h3>
            </div>";
         //<script src="../others/javascript/script.js">

          
        ?>
        
  