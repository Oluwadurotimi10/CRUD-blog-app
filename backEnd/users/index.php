<?php
    
// include database and object files
include_once '../config/Database.php';
include_once '../../path.php';
include_once(ROOT_PATH.'/backEnd/models/user.php');

// set page headers
$page_title = "Reset password";
include_once(ROOT_PATH.'/includeFiles/head_section.php');
//including validation
include_once(ROOT_PATH.'/includeFiles/validation.php');

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require_once(ROOT_PATH.'/vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createUnsafeImmutable(ROOT_PATH);
$dotenv->load();

// get database connection
$database = new Database();
$db = $database->connect();

// prepare objects
$user = new User($db);
$table = "passreset";

date_default_timezone_set('Africa/Lagos');

//checking if email was entered
if((isset($_POST["email"])) && (!empty($_POST["email"])) && (empty($emailErr))){

    //checking if the email is registered
   $result = $user->selectOne($userEmail);
   $count = $result->rowCount();
         
    if($count > 0){
        $expFormat = mktime(
        date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y")
        );
        $expDate = date("Y-m-d H:i:s",$expFormat);
        $token = md5($userEmail);
        $addToken = substr(md5(uniqid(rand(),1)),3,10);
        $token = $token . $addToken;

        // Insert into passreset Table
        
            $query =  'INSERT INTO                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           
                        ' . $table . '
                        SET
                        passResetEmail = :passResetEmail,
                        passResetToken = :passResetToken,
                        passResetExpires = :passResetExpires';

            //Prepare statement
            $stmt = $db->prepare($query);

            //Bind data
            $stmt->bindParam(':passResetEmail', $userEmail);
            $stmt->bindParam(':passResetToken', $token);
            $stmt->bindParam(':passResetExpires', $expDate);

            //execute query
            $stmt->execute();

            //message to be sent in recovery mail
            
            $message='<p>Dear user,</p>';
            $message.='<p>A password reset was requested for your account.</p>';
            $message.='<p>Please click the link below to reset your password.</p>';
            $message .= "<p><a href="; BASE_URL .'/backEnd/users/reset_password.php?email='.$userEmail.'&token='.$token."&action=reset>";
            $message .= "Reset password";
            $message .= "</a></p>";
            $message.='<p>The link expires after one day for security reasons.</p>';
            $message.='<p>If you did not request this forgotten password email, no action 
            will be taken. However, you may want to log into your account and 
            change your password as someone may have guessed it.</p>';   
            $message.='<p>Kind regards,</p>';
            $message.='<p>MyrrhBloggs Team</p>';

            //creating a function to send mail
            function send_mail($to, $subject, $message){
            // Instantiation and passing `true` enables exceptions
                $mail = new PHPMailer(true);

                try {
                    //Server settings
                    $mail->SMTPDebug = 0;                                       // Enable verbose debug output
                    $mail->isSMTP();                                            // Set mailer to use SMTP
                    $mail->Host       = 'smtp.gmail.com;';                      //  Specify main and backup SMTP servers
                    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                    $mail->Username   = getenv('MAIL_USERNAME');                   // SMTP username
                    $mail->Password   = getenv('MAIL_PASSWORD');                  // SMTP password
                    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
                    $mail->Port       = 587;                                    // TCP port to connect to
 
                    //Recipents
                    $mail->setFrom(getenv('MAIL_USERNAME'), getenv('MAIL_NAME'));
                    $mail->addAddress($to);
                    // Content
                    $mail->isHTML(true);             // Set email format to HTML
                    $mail->Subject = $subject;
                    $mail->Body    = $message;

                    $mail->send();
                    echo 'Message has been sent';
                    } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                }
                //calling the send message function
                send_mail($userEmail, "Reset password", $message);
            }
   else{
    echo "<div class='alert alert-danger'>No user is registered with this email address!</div>";
   }
}   
?>


<!-- HTML form for resetting the password -->
<div class='reset-wrapper'>
<h3> An email will be sent to you with instructions on how to reset your password </h3>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" name="reset" method="POST" >
    <div class="reset-wrapper-inner">
    <h4 class = "text-wrapper" for="email"> Email </h4>
    <span class ="error"><?php echo $emailErr;?></span>
    <input type = 'text' name='email'class = 'form-control' /><br/>
    <button type='submit' name='reset-request' class="btn btn-big"> Submit your email</button>
    </div>
</form>
</div>

<?php
//including footer
include_once(ROOT_PATH.'/includeFiles/footer.php');