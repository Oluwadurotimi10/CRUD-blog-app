<?php
    
// include database and object files
include_once '../config/Database.php';
include_once '../../path.php';
include_once '../models/user.php';

// get database connection
$database = new Database();
$db = $database->connect();

// prepare objects
$user = new User($db);

// set page headers
$page_title = "Registration Form";
include_once '../../includeFiles/head_section.php';

//echo "<button class='read-redirec'><a href='/phpdocs/CRUD-blog-app/index.php'>Read Posts</a></button>";

//including validation
include_once '../../includeFiles/validation.php';


//setting the conditions for a user to be created
if (isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["passcode"]) && isset($_POST["passconfirm"]) ){
    if(!empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["passcode"]) && !empty($_POST["passconfirm"]) ){
        if(empty($usernameErr) && empty($emailErr) && empty($passErr) && empty($unidenticalpass)){
           
            // set user property values
        $user->username = $username;
        $user->email = $email;
        $user->passcode = $pass;
        $_POST['admin'] = 0;

            // create the user
        if($user->create()){
            echo "<div class='alert alert-success'>User was created.</div>";
        }

        // if unable to create the user, tell the user
        else{
            echo "<div class='alert alert-danger'>Unable to create user.</div>";
        }
 
        //selecting the newly created user
        $stmt = $user->selectOne($email); 
         //fetching statement
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        extract($row);
        //logging user in after creating an account
        $_SESSION['id'] = $id;
        $_SESSION['username'] = $username;
        $_SESSION['message'] = 'You are now logged in';
        $_SESSION['type'] = 'alert alert-success';
        header('location: ../../index.php');
        exit();
        }
    }
}
   
?>


<!-- HTML form for creating a user -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" class = "register-wrapper">
    <div class = "register-inner-wrapper">
        <p><span class = "error">* required field </span></p>

        <h4 class = "text-wrapper" for = "username"> Username <span class ="error">*</span></h4>
        <span class ="error"> <?php echo $usernameErr;?></span> 
        <input type='text' id ='username' name='username' value = '<?php echo $username ?>'class='form-control' />
       

        <h4 class = "text-wrapper" for="email"> Email <span class ="error">* </span></h4>
        <span class ="error"><?php echo $emailErr;?></span>
        <input type='text' id ='email' name='email' value = '<?php echo $email ?>' class='form-control' />
        
        <h4 class = "text-wrapper" for="passcode"> Password <span class ="error">*</span></h4>
        <span class ="error"> <?php echo $passErr;?></span>
        <input type='password' name='passcode' class='form-control' />
        
        <h4 class = "text-wrapper" for="passconfirm"> Password Confimation<span class ="error">*</span></h4> 
        <span class ="error"><?php echo $unidenticalpass;?></span>
        <input type='password' name='passconfirm' class='form-control'/>
        
        <br/><button type="submit" name="register" id="btn" class="btn btn-big">Register</button>
        <br/><p class="login-redirec"> Or an existing user <a href="<?php echo 'login.php' ?>">LogIn</a></p>

    </div>
</form>
