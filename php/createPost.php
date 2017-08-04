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
    $postTags = "";
    
    // fetch credentials thorugh post
    if(isset($_POST["postText"])){
        $postText = $_POST["postText"];
    }
    if(isset($_POST["postType"])) {
        $postType = $_POST["postType"];
    }
    if(isset($_POST["postTags"])) {
    	$postTags = $_POST['postTags'];
    }
 
    //error no login
    if(!isset($_SESSION["userName"])){
        die("please login or register first");
    }


    //create mysql time
    $phptime = time();
    echo $phptime;
   	echo $postTags;
    //inserting
    $conn = new mysqli('localhost','boubou','boubou','edel') or die('Error connecting to MySQL server.');

    //building querry to the database
    $dbQuery = "INSERT INTO Posts (user_id, post_type, post_date, post_text, post_rating) VALUES ('" . mysqli_real_escape_string($conn, $_SESSION['userID']) . "', '" . mysqli_real_escape_string($conn, $postType) ."', FROM_UNIXTIME('" . $phptime ."'), '". mysqli_real_escape_string($conn, $postText)  ."', 1)";
            

    $result = $conn->query($dbQuery);

    if(!$result) {
        die("something went wrong with " . $conn->error);
    }

    //closing connection
    $conn->close();


    //building querry to the database
    $lastID = querryLastPost('post_id');
    echo "<br> " . $lastID ."<br>"; 
            

    //inserting
    $conn = new mysqli('localhost','boubou','boubou','edel') or die('Error connecting to MySQL server.');

    //building a querry
    $dbQuery = "INSERT INTO ChildrenPosts (child_post_id) VALUES (" . mysqli_real_escape_string($conn, $lastID) .")";
  
    $result = $conn->query($dbQuery);

    if(!$result) {
        die("something went wrong" . $conn->error);
    }

    //closing connection
    $conn->close();

    //getting a list of tags
    $tags = preg_split("/\s*;\s*/", $postTags);
    $listOfTagsIDs = array();
    $i = 0; 

    foreach ($tags as $oneTag) {
    	$listOfTagsIDs[$i] = insertTag($oneTag);
    	$i++;
    }

    #tagging
    tagAPost($lastID, $listOfTagsIDs);

    #adding documents
    attachDocuments($lastID);

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
        
}

//calling main()
main();
  
?>
