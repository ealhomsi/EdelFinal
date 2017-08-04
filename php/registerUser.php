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
	$user =  "";
	$password = "";
	$imei = "";
	$name = "";
	// fetch credentials thorugh post
	if(isset($_POST["userEmail"])){
		$user = $_POST["userEmail"];
	}
	if(isset($_POST["userPassword"])) {
		$password = $_POST["userPassword"];
	}
	if(isset($_POST["userImei"])) {
		$imei = $_POST["userImei"];
	}
	if(isset($_POST["userName"])) {
		$name = $_POST["userName"];
	}

	//create pp keys
	$keys = createPPKeys();

	//create hashed password
	$salt = generateSalt();
	$hash = hashPassword($password, $salt);

	// Check connection
	if ($conn->connect_error) {
    	die("Connection failed: " . $conn->connect_error);
	}

	// making the querry
	$dbQuery = "INSERT INTO Users (user_name, user_imei, user_email, user_hashed_password, user_salt, user_private_key, user_public_key, user_karma)
VALUES ('" . mysqli_real_escape_string($conn,$name) . "', '" . mysqli_real_escape_string($conn,$imei) ."', '" . mysqli_real_escape_string($conn,$user) ."', '" . mysqli_real_escape_string($conn,$hash) ."', '" . mysqli_real_escape_string($conn,$salt) ."', '" . mysqli_real_escape_string($conn,$keys['pri']) ."', '" . mysqli_real_escape_string($conn,$keys['pub']) ."' , 1)";
	$result = $conn->query($dbQuery);

	// checking for errors
	if(!$result) {
		echo "Error: " . $dbQuery . "<br>" . $conn->error;
	}

	//close connection
	$conn->close();

	
	// clear the session
	unset($_SESSION["userName"]);
	unset($_SESSION["userID"]);

	echo "<br>" . $user . "<br>";
	//set things
	$_SESSION['userID'] =  querrySomethingFromUsers($user, "user_email", "user_id");
	$_SESSION['userName'] = $name;

	//forward back to the index page
	header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

//calling the main function
main();

?>