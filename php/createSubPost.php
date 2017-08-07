<?php 
//init
session_start(); 
include  "functions.php";

if(!isset($_SESSION['userID'])) 
    die("LOGIN / REGISTER FIRST!!!");
?>

<?php
//this file does just the uploading routine
//upload routine and listing files of some organiztion.
function main() {
    // fetch credentials through post   
    $postType =  "";
    $postText = "";
 
    $postFatherID = $_POST['fatherPostID'];
    // fetch credentials thorugh post
    if(isset($_POST["reply".$postFatherID])){
        $postText = $_POST["reply".$postFatherID];
    }
     
    //error no login
    if(!isset($_SESSION["userName"])){
        die("please login or register first");
    }


    //create mysql time
    $phptime = time();
    echo $phptime;

    //send email to a user
    $email = getUserEmailPostID($postFatherID);
    $replyer = $_SESSION["userName"];
    sendmail($email, $replyer, $postText, $phptime);

    //inserting
    $conn = new mysqli('localhost','boubou','boubou','edel') or die('Error connecting to MySQL server.');

    //building querry to the database
    $dbQuery = "INSERT INTO Posts (user_id, post_type, post_date, post_text, post_rating) VALUES ('" . mysqli_real_escape_string($conn, $_SESSION['userID']) . "', '" . mysqli_real_escape_string($conn, $postType) ."', FROM_UNIXTIME('" . mysqli_real_escape_string($conn, $phptime) ."'), '". mysqli_real_escape_string($conn, $postText)  ."', 1)";

    $result = $conn->query($dbQuery);

    if(!$result) {
        die("something went wrong" . $conn->error);
    }

    //closing connection
    $conn->close();


    //building querry to the database
    $lastID = querryLastPost('post_id');
    echo "<br> " . $lastID ."<br>" . $postFatherID . "<br>"; 
    

    //inserting
    $conn = new mysqli('localhost','boubou','boubou','edel') or die('Error connecting to MySQL server.');

    $dbQuery = 'INSERT INTO ChildrenPosts (father_post_id, child_post_id) VALUES (' . mysqli_real_escape_string($conn, $postFatherID) . ' , ' . mysqli_real_escape_string($conn, $lastID) . ')';
            
    $result = $conn->query($dbQuery);

    if(!$result) {
        die("something went wrong" . $conn->error);
    }

    //closing connection
    $conn->close();


    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
        
}

//calling main()
main();
  
?>
