<?php
// get mail and token of the user 
//$userEmail = isset($_GET['email']) ? $_GET['email'] : die('ERROR: missing email.');
//$token  = isset($_GET['token ']) ? $_GET['token '] : die('ERROR: missing token.');

// include database and object files
include_once '../config/Database.php';
include_once '../../path.php';
include_once(ROOT_PATH.'/models/user.php');

// set page headers
$page_title = "Reset password";
include_once(ROOT_PATH.'/includeFiles/head_section.php');
//including validation
include_once(ROOT_PATH.'/includeFiles/validation.php');

// get database connection
$database = new Database();
$db = $database->connect();
$table = "passreset";
$user = new User($db);


// this page updates the database
//updating the users table and deleting the token after reset
//setting the conditions for a user to be created
if ((isset($_POST["pwd"])) && (isset($_POST["pwd_repeat"]))){
    if((!empty($_POST["pwd"])) && (!empty($_POST["pwd_repeat"]))){
        if((empty($passErr)) && (empty($unidenticalpass))){

            $user->email = $userEmail;
            $user->passcode = $pass;

             // updating user 
        if($user->update()){

            $query = " DELETE 
                        FROM
                    " . $table . "
                        WHERE
                        passResetEmail=?";

                //prepare statements
                $stmt = $db->prepare($query);

                //bind data
                $stmt->bindParam(1, $userEmail);

                $stmt->execute();

            echo "<div class='alert alert-success'>Update successful.</div>";

            //redirecting to the login page
            echo "<p><a href="; echo BASE_URL . 'backEnd/users/login.php>
            Click here</a> to Login.</p>';  
        }

        // if unable to create the user, tell the user
        else{
            echo "<div class='alert alert-danger'>Unable to update user's password.</div>";
            }
        }
    }
}

//ensuring the user got to this page accurately
if (isset($_GET["token"]) && isset($_GET["email"]) && isset($_GET["action"]) 
&& ($_GET["action"]=="reset") && !isset($_POST["action"])){
    $token= $_GET["token"];
    $userEmail = $_GET["email"];
    $curDate = date("Y-m-d H:i:s");

    //getting data from the passreset table
    $query = "SELECT *
            FROM
            " . $table . "
            WHERE
            passResetEmail = ?
            LIMIT
                0,1";

            //prepare statement
            $stmt = $db->prepare($query);

            // execute query
            $result = $stmt->execute([$userEmail]);

            $count = $result->rowCount();
            //confirming the reset link contains a registered email and if reset was requested
            if($count > 0){
                //fetching statemrnt
                $row = $result->fetch(PDO::FETCH_ASSOC);
                extract($row);
                if (($passResetToken == $token) && ($passResetExpires > $curDate)){
                    ?>
                    <div class ="passreset-wrapper">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method ="POST">
                            <div class="passreset-wrapper-inner">
                            <input type="hidden" name="email" value ="<?php echo $userEmail ?>">
                            <input type="hidden" name="token" value ="<?php echo $token ?>">
                            <h3 class = "text-wrapper" for="email">Enter a new password </h3>
                            <span class ="error"> <?php echo $passErr;?></span>
                            <input type="password" name="pwd" class='form-control'/>
                            <h3 class = "text-wrapper" for="email">Confirm the new password </h3>
                            <span class ="error"><?php echo $unidenticalpass;?></span>
                            <input type="password" name="pwd_repeat" class='form-control'/>
                            <button type="submit" name = "passResetSubmit" class="btn btn-big">Reset password</button>
                            </div>
                        </form>
                        </div>
                    <?php 
                }
            else{
                echo '<h2>Invalid Link</h2>
                    <p>The link is invalid/expired. Either you did not copy the correct link
                    from the email, or you have already used the token in which case it is 
                    deactivated.</p>
                    <p><a href='; echo BASE_URL . 'backEnd/users/index.php>
                    Click here</a> to reset password.</p>';     
            }
        }
            else{
                echo "This recovery email link has expired";
                echo '<p><a href='; echo BASE_URL . 'backEnd/users/index.php>
                    Click here</a> to reset password.</p>';  
            }
        }
    

    