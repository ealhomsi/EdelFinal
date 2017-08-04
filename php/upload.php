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
     //error no login
    if(!isset($_SESSION["userName"])){
        die("please login or register first");
    }

    //getting the new upload
    $targetDir = "../uploads/";
    $targetFile = $targetDir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 0;

    //check if image file is an actual image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
                $uploadOK = 1;

                //storing documents in a database
                $type = $_POST['docType'];
               
                $mysqltime = date("Y-m-d h:i:sa");

                $fileName = $targetFile;
                $fileHandle = fopen($targetFile, "r");
                $fileSize = filesize($targetFile);
                $fileContent = fread($fileHandle, $fileSize);
                $fileContent = addslashes($fileContent);
                $fileContent = signFile($fileContent, querrySomething($_SESSION['userID'], 'user_private_key'));
                fclose($fileHandle);

                //things that has to be done
                if(!get_magic_quotes_gpc())
                {
                    $fileName = addslashes($fileName);
                }

                //building querry to the database
                $dbQuery = "INSERT INTO Posts (user_id, post_type, post_date_uploaded, post_document_content, post_text, post_document_type, post_document_size, post_document_name) VALUES ('" . mysqli_real_escape_string($conn,$_SESSION['userID']) . "', '" . mysqli_real_escape_string($conn,$type) ."', '" . mysqli_real_escape_string($conn,$mysqltime) ."', '" . mysqli_real_escape_string($conn,$fileContent) ."', '" . mysqli_real_escape_string($conn,$_POST['docDescription']) ."', '" . mysqli_real_escape_string($conn,$_FILES["fileToUpload"]["type"]) . "', '" . mysqli_real_escape_string($conn,$fileSize) . "', '" . mysqli_real_escape_string($conn,$fileName)  ."')";
            

                //inserting
                $conn = new mysqli('localhost','boubou','boubou','edel') or die('Error connecting to MySQL server.');
                $result = $conn->query($dbQuery);

                if(!$result) {
                    die("something went wrong" . $conn->error);
                }
            } else {
                echo "the file is an image however was not uploaded";
                $uploadOk = 0;
            }
        }else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    if($uploadOk) {
        echo "<br>Upload was successful!";
    } else {
        echo "<br>Upload failed!";
        
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit(); 
}

//calling main()
main();
  
?>
