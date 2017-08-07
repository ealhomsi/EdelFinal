<?php 
//init
session_start(); 
include  "functions.php";
?>


<?php
	// logging out by swiping the session
	unset($_SESSION['userName']);
	unset($_SESSION['userID']);
	header('Location: ' . 'https://localhost/new/index.php');
    exit();
?>