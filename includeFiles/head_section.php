<!DOCTYPE html>
<html lang ="en">

    <head>
        <!-- showing page title -->
        <title><?php echo $page_title; ?></title>

        <!-- Styling for public area -->
        <link rel="stylesheet" type="text/css" href='/phpdocs/CRUD blog app/others/style_nav.css'>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"/>

        <!-- Latest compiled and minified Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
        
        <!-- meta tags -->
        <meta charset = "UTF-8">
        <meta name = "viewport" content ="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie-edge">
        <!-- Font Awesome -->

</head>
<body>

    <!-- container -->
    <div class="container">

    <?php include_once 'navBar.php' ?>
        
    </div>
        <?php 
        // show page header
        echo "<div class='page-header'>
                <h1>{$page_title}</h1>
            </div>";
        ?>
    