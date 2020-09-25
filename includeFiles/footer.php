<?php 
//include_once '../path.php';
include_once(ROOT_PATH.'/includeFiles/head_section.php');
?>
<footer>
    <div class="footer-container">
        <div class="social-media">
            <a href=" https://twitter.com/moo_joolaa?s=08"><i class = "fab fa-twitter"></i></a>
            <a href="https://www.linkedin.com/in/jadesola-adedokun-75aa16182"><i class = "fab fa-linkedin"></i></a>
            <a href="https://github.com/Oluwadurotimi10"><i class = "fab fa-github"></i></a>
            <a href="mailto:jadesolaadedokun@gmail.com"><i class = "fa fa-envelope"></i></a>
        </div>
        <p class ="rights-text"> Copyright Jadesola Adedokun 2020 © </p>
    </div>
</footer>








    <!-- </div>/container -->
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
   
   <!-- bootbox library -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
   
      <!-- <script>
           // JavaScript for deleting product
           $(document).on('click', '.delete-object', function(){
       
           var id = $(this).attr('id');
       
           bootbox.confirm({
               message: '<h4>Are you sure?</h4>',
               buttons: {
                   confirm: {
                       label: '<span class='glyphicon glyphicon-ok'></span> Yes',
                       className: 'btn-danger'
                   },
                   cancel: {
                       label: '<span class='glyphicon glyphicon-remove'></span> No',
                       className: 'btn-primary'
                   }
               },
               callback: function (result) {
       
                   if(result==true){
                       $.post('delete.php', {
                           id: id
                       }, function(data){
                           location.reload();
                       }).fail(function() {
                           alert('Unable to delete.');
                       });
                   }
               }
           });
           return false;
           });
           </script> -->

  
</body>
</html>