<?php 

// include database and object files
include_once 'C:\xampp\htdocs\phpdocs\CRUD-blog-app\backEnd\config\Database.php';

// get database connection
$database = new Database();

// defining varaibles and setting them to empty values
      $usernameErr = $emailErr = $passErr = $unidenticalpass = "";
      $username = $email = $pass = $passconfirm = $register =  "";

// if the form was submitted for registration
if (isset($_POST['register'])){

    //form validation
    if(empty($_POST['username'])){
        $usernameErr = "username is required";
    }
    else{
        $username  = test_input($_POST['username']);
        //check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z]*$/",$username)){
        $usernameErr = "Only letters and whitespace allowed";
        } 
    }
    if(empty($_POST['email'])){
        $emailErr = "Email is required";
    }
    else{
        $email = test_input($_POST['email']);
        //check if email is valid
        $exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
        if(!preg_match($exp, $email)){
            $emailErr = "Your email format is invalid";
            } 
        $existingUser = $user->selectOne($email);
        $count = $existingUser->rowCount();
        if($count > 0){
            $emailErr = "This email already exists";
        }
    }

    if(empty($_POST['passcode'])){
        $passErr = "Passcode is required";
    }
    else{
        $pass = $_POST['passcode'];
        // checking if password is valid
        $pattern = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?([^\w\s]|[_])).{6,}$/";
        if(!preg_match($pattern, $pass)){
            $passErr = "The password must have at least one number, a special character, a lower and uppercase letter and a minimum of eight characters";
        }
    }
    if(empty($_POST['passconfirm'])){
        $unidenticalpass = "Please confirm password";
    }
    else{
        $pass = $_POST['passcode'];
        $passconfirm = $_POST['passconfirm'];
        if($passconfirm != $pass){
            $unidenticalpass = "This password does not match the one above";
    } }

    //encrypting the password
    //$_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    //$database->display($_POST);
}

//if the form was submitted for logging in
if (isset($_POST['login'])){

    //form validatipn 
    if(empty($_POST['email'])){
        $emailErr = "Email is required";
    }
    else{
        $email = test_input($_POST['email']);
         }
    
    if(empty($_POST['passcode'])){
        $passErr = "Passcode is required";
    }
    else{
        $pass = $_POST['passcode'];
    }
}

 //function to enusre the data input is valid and secure        
 function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}