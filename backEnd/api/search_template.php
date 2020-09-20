<?php

// search form
echo "<form role='search' action='backEnd/api/search.php' class='search-wrapper'>";
    echo "<div class='search-box'>";
        $search_value=isset($search_term) ? "value='{$search_term}'" : "";
        echo "<input type='text' class='search-text' placeholder='Search using title or author's name..' name='s' id='srch-term' required {$search_value} />";
            echo "<button class='search-btn' type='submit'><i class='fas fa-search'></i></button>";       
    echo "</div>";
echo "</form>";
  
/*// create post button
echo "<div class='right-button-margin'>";
    echo "<a href='create_product.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-plus'></span> Create Product";
    echo "</a>";

    input-group col-md-3 pull-right margin-right-1em'
     echo "<div class='input-group-btn'>";
      echo "</div>";
echo "</div>";*/
  
            