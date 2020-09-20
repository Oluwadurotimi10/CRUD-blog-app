<?php
include_once '../../path.php';

session_start();
unset($_SESSION['id']);
unset($_SESSION['username']);
unset($_SESSION['message']);
unset($_SESSION['type']);

session_destroy();

//redirecting to the home page
header('location: ../../index.php');