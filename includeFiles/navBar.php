<header>
<div class="navbar">
    <div class ="logo">
        <h1 class = "logo-text"><span>Myrrh</span>Bloggs</h1>
    </div>
    <span class="toggle" id ="js-navbar-toggle"><i class="fas fa-bars menu-toggle"></i></span>
    <ul class = "menu" id = "js-menu">
        <li ><a href="/phpdocs/CRUD-blog-app/index.php" class=" list active-nav-link">Home</a></li>
        
            <!--conditions for when a user is logged in-->
            <?php if(isset($_SESSION['id'])): ?>
                <!--conditions for when a post can be created-->
                <li ><a  href="/phpdocs/CRUD-blog-app/backEnd/api/create.php" class = "list">CreatePost</a></li>
                <li> 
                    <a href="#" class="options">
                        <i class= "fa fa-user" ></i>
                        <?php echo $_SESSION['username']; ?>
                        <span class="drop"><i class="fa fa-chevron-down"></i></span>
                    </a>
                    <ul>
                        <li><a href="/phpdocs/CRUD-blog-app/backEnd/users/logout.php" class="logout">LogOut</a></li>
                        <!--<li><a href="#" >Dashboard</a></li>-->
                    </ul>
                </li>
            <?php else: ?>
                <li><a href ='/phpdocs/CRUD-blog-app/backEnd/users/register.php' class="list">SignUp</a></li>
                <li><a href ="/phpdocs/CRUD-blog-app/backEnd/users/login.php" class="list">LogIn</a></li>
            <?php endif;?>
    </ul>
</div>
</header>

