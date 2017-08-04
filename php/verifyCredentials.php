<?php 
//init
session_start(); 
include  "functions.php";
?>


<?php
function main() {
	//connecting to the database
	$conn = new mysqli('localhost','boubou','boubou','edel') or die('Error connecting to MySQL server.');

	// fetch credentials through post	
	$email =  "";
	$password = "";
	if(isset($_POST["userEmail"])){
		$email = $_POST["userEmail"];
	}
	if(isset($_POST["userPassword"])) {
		$password = $_POST["userPassword"];
	}

	// Check connection
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	}


	// making the querry
	$dbQuery = "SELECT user_hashed_password, user_salt, user_email, user_name, user_id FROM Users WHERE user_email='".mysqli_real_escape_string($conn,$email) . "'";
	$result = $conn->query($dbQuery);

	// checking for errors
	if(!$result) {
		echo "Error: " . $dbQuery . "<br>" . $conn->error;
	}

	// clear the session
	unset($_SESSION["userName"]);
	unset($_SESSION["userID"]);

	//if $result is successful
	$row = $result->fetch_array();  //by now they should have the same email address

	if(!$row) {
		die('user was not found');
	}

	if(verifyPassword($password, $row['user_hashed_password'], $row['user_salt'])) {
		echo 'welcome ' . $row['user_name'] . ' your email is: ' . $row['user_email'] . '<br>';
		$_SESSION['userName'] = $row['user_name'];
		$_SESSION['userID'] = $row['user_id'];
		header("Location: https://192.168.1.116/new/index.php"); /* Redirect browser */
		exit();

	} else {
		echo 'password mismtach for users: ' . $row['user_name'] . '<br>';
	}
	
	// free the results array
	$result->close();
}


//calling the main function
main();
?>