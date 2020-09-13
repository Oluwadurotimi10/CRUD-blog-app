<?php if(isset($_SESSION['message'])):?>
        <!--displays succes message after login-->
        <div class = "msg <?php echo $_SESSION['type'];?>">
            <span><?php echo $_SESSION['message'];?></span>
            <?php 
                unset($_SESSION['message']);
                unset($_SESSION['type']);
            ?>
        </div>
    <?php endif;?>