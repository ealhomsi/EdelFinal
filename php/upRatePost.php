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
    $postID = "";

    // fetch credentials thorugh GET
    if(isset($_GET['ratedPostID'])){
        $postID = $_GET['ratedPostID'];
    } else {
        die("ratedPostID was not set");
    }
     
    //error no login
    if(!isset($_SESSION["userName"])){
        die("please login or register first");
    }


    //checking the current user participation
    $status = checkUserStatus($postID, $_SESSION['userID']);
    if($status == -1) {
        //if the case is downvote
        deleteUserParticipation($postID, $_SESSION['userID'], 1);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else if ($status == 1) {
        //just forget the user
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }

    //$status here is zero

    //create mysql time
    $phptime = date( 'Y-m-d H:i:s');
    echo $phptime . "<br>";
    echo $postID;
    $voteValue = 1;

    //inserting
    $conn = new mysqli('localhost','boubou','boubou','edel') or die('Error connecting to MySQL server.');

    //building querry to the database
    $dbQuery = "INSERT INTO Votes (user_id, post_id, vote_date, vote_value) VALUES ('" . mysqli_real_escape_string($conn,$_SESSION['userID']) . "', '" . mysqli_real_escape_string($conn,$postID) ."', FROM_UNIXTIME('" . mysqli_real_escape_string($conn,$phptime) ."'), ". mysqli_real_escape_string($conn,$voteValue)  .")";

    $result = $conn->query($dbQuery);

    if(!$result) {
        die("something went wrong inseting a new vote " . $conn->error);
    }

    //closing connection
    $conn->close();


    //get the post current rating
    $rating = querrySomethingFromPosts($postID, 'post_id', 'post_rating');
    $rating = $rating + $voteValue;

    echo "<br>" . $rating . "<br>";
            

    //updating
    $conn = new mysqli('localhost','boubou','boubou','edel') or die('Error connecting to MySQL server.');

    //update the rating on the post
    $dbQuery = 'UPDATE  Posts SET post_rating='. mysqli_real_escape_string($conn,$rating) .  ' WHERE post_id=' . mysqli_real_escape_string($conn,$postID) ;
    
    $result = $conn->query($dbQuery);

    if(!$result) {
        die("something went wrong with updating " . $conn->error);
    }

    //closing connection
    $conn->close();

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}

//calling main()
main();
  
?>
