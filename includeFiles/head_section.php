<!DOCTYPE html>
<html lang ="en">

    <head>
        <!-- showing page title-->
        <title><?php echo $page_title; ?></title>  

        <!-- Styling for public area -->
        <link rel="stylesheet" type="text/css" href='/phpdocs/CRUD-blog-app/others/style_nav.css'>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"/>

        <!-- Latest compiled and minified Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
        
        <!-- meta tags -->
        <meta charset = "UTF-8">
        <meta name = "viewport" content ="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie-edge">
        <!-- Font Awesome -->

        <!--Jquery-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>

</head>
<body>

    <!-- container -->
    <!--<div class="container"> </div>-->
    <?php include_once 'navBar.php' ?>
        
    
        <?php 
        // show page header
        echo "<div class='page-header'>
                <h1>{$page_title}</h1>
            </div>";
         
        ?>
        <!--custom script -->
        <script src="/phpdocs/CRUD-blog-app/others/javascript/script.js"></script>
</body>
</html>  