<header>
<div class="navbar">
    <div class ="logo">
        <h2 class = "logo-text"><span>Myrrh</span>Bloggs</h2>
    </div>
   <!-- <label class="toggle" id ="js-navbar-toggle"><i class="fas fa-bars"></i></label>-->
   <input type="checkbox" id ="check">
   <label for ="check" class="checkbtn">
        <i class="fas fa-bars"></i>
    </label>
    <ul class = "menu" id = "js-menu">
        <li ><a href="<?php echo BASE_URL .'/index.php' ?>" class=" list active">Home</a></li>
        
            <!--conditions for when a user is logged in-->
            <?php if(isset($_SESSION['id'])): ?>
                <!--conditions for when a post can be created-->
                <li ><a  href="<?php echo BASE_URL .'/backEnd/api/create.php'?>" class = "list">CreatePost</a></li>
                <li> 
                    <a href="#" class="options">
                        <i class= "fa fa-user" ></i>
                        <?php echo $_SESSION['username']; ?>
                        <span class="drop"><i class="fa fa-chevron-down"></i></span>
                    </a>
                    <ul>
                        <li><a href="<?php echo BASE_URL .'/backEnd/users/logout.php'?>" class="logout">LogOut</a></li>
                        <!--<li><a href="#" >Dashboard</a></li>-->
                    </ul>
                </li>
            <?php else: ?>
                <li><a href ="<?php echo BASE_URL .'/backEnd/users/register.php'?>" class="list">SignUp</a></li>
                <li><a href ="<?php echo BASE_URL .'/backEnd/users/login.php'?>" class="list">LogIn</a></li>
            <?php endif;?>
    </ul>
</div>
</header>

