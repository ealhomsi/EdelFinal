<?php
// this is a library of common functions

//function send email to a user 
function sendmail($to, $replyer, $msg, $date) {
	$subject = "Your post got a reply from $replyer";

	$message = <<<EOT
		<html>
			<head>
				<title>HTML email</title>
			</head>
			<body>
				<h4> ${msg} </h4>
				<p> posted by ${replyer} on ${date} </p>
			</body>
		</html>
EOT;
	// Always set content-type when sending HTML email
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	// More headers
	$headers .= 'From: <noreply EDEL>' . "\r\n";

	$result =  mail($to,$subject,$message,$headers);
	if(!$result) {
		die("sdfa");
	}
}


//function that generates private and public keys
function createPPKeys() {
	$config = array(
    "digest_alg" => "sha512",
    "private_key_bits" => 1024,
    "private_key_type" => OPENSSL_KEYTYPE_RSA,
	);
    
	// Create the private and public key
	$res = openssl_pkey_new($config);

	// Extract the private key from $res to $privKey
	openssl_pkey_export($res, $privKey);

	// Extract the public key from $res to $pubKey
	$pubKey = openssl_pkey_get_details($res);
	$pubKey = $pubKey["key"];

	$results = array (
		"pub" => $pubKey,
		"pri" => $privKey
		);

	return $results;
}


//function that generates salt
function generateSalt() {
	$numberOfDesiredBytes = 16;
	$salt = random_bytes($numberOfDesiredBytes);
	return $salt;
}

//function that hashes passwords
function hashPassword($password, $salt) {
	$result = password_hash($password . $salt, PASSWORD_DEFAULT);
	return $result;
}

//function thatverifies passwords
function verifyPassword($password, $hash, $salt) {
	//verify a password
	return password_verify($password . $salt, $hash);
}

//signing file contents
function signFile($fileContent, $privKey) {
	//compute signature
	openssl_sign($fileContent, $signature, $privKey);

	return $signature;

}

//getting something from database Users
function querrySomethingFromUsers($search, $which, $column) {
	//connecting to the database
	$conn = new mysqli('localhost','boubou','boubou','edel') or die('Error connecting to MySQL server.');

	// making the querry
	$dbQuery = "SELECT * FROM Users WHERE ". mysqli_real_escape_string($conn,$which) ." = '".mysqli_real_escape_string($conn,$search). "'";
	$result = $conn->query($dbQuery);

	// checking for errors
	if(!$result) {
		echo "Error: " . $dbQuery . "<br>" . $conn->error;
		die();
	}

	//if $result is successful
	$row = $result->fetch_array();  //by now they should have the same email address

	if(!$row) {
		die('FATAL: user was not found find this' . $seatch . ' which is ' . $which .  ' and give me back '. $column);
	}

	// free the results array
	$result->close();
	
	return $row[$column];
}

//getting something from database Posts
function querrySomethingFromPosts($search, $which, $column) {
	//connecting to the database
	$conn = new mysqli('localhost','boubou','boubou','edel') or die('Error connecting to MySQL server.');

	// making the querry
	$dbQuery = "SELECT * FROM Posts WHERE ". mysqli_real_escape_string($conn,$which) ." = '".mysqli_real_escape_string($conn,$search) . "'";
	$result = $conn->query($dbQuery);

	// checking for errors
	if(!$result) {
		echo "Error: " . $dbQuery . "<br>" . $conn->error;
		die();
	}

	//if $result is successful
	$row = $result->fetch_array();  //by now they should have the same email address

	if(!$row) {
		die('FATAL: user was not found');
	}

	// free the results array
	$result->close();
	
	return $row[$column];
}

//getting a specific post
function getSpecificPost($postID) {
	//connecting to the database
	$conn = new mysqli('localhost','boubou','boubou','edel') or die('Error connecting to MySQL server.');

	$which = 'post_id';
	$search = $postID;

	// making the querry
	$dbQuery = "SELECT * FROM Posts WHERE ". mysqli_real_escape_string($conn,$which) ." = ".mysqli_real_escape_string($conn,$search);
	$result = $conn->query($dbQuery);

	// checking for errors
	if(!$result) {
		echo "Error: " . $dbQuery . "<br>" . $conn->error;
		die();
	}

	//if $result is successful
	$row = $result->fetch_array();  //by now they should have the same email address

	if(!$row) {
		die('FATAL: user was not found');
	}

	// free the results array
	$result->close();
	$conn->close();
	return array($row);
}

//getting something from database Posts
function querrySomethingFromTags($search, $which, $column) {
	//connecting to the database
	$conn = new mysqli('localhost','boubou','boubou','edel') or die('Error connecting to MySQL server.');

	// making the querry
	$dbQuery = "SELECT * FROM Tags WHERE ". mysqli_real_escape_string($conn,$which) ." = '".mysqli_real_escape_string($conn,$search) . "'";
	$result = $conn->query($dbQuery);

	// checking for errors
	if(!$result) {
		echo "Error: " . $dbQuery . "<br>" . $conn->error;
		die();
	}

	//if $result is successful
	$row = $result->fetch_array();  //by now they should have the same email address

	if(!$row) {
		die('FATAL: user was not found');
	}

	// free the results array
	$result->close();
	
	return $row[$column];
}

//getting something from database
function querryLastPost($column) {
	//connecting to the database
	$conn = new mysqli('localhost','boubou','boubou','edel') or die('Error connecting to MySQL server.');

	// making the querry
	$dbQuery = "SELECT * FROM Posts ORDER BY post_id DESC LIMIT 1";
	$result = $conn->query($dbQuery);

	// checking for errors
	if(!$result) {
		echo "Error: " . $dbQuery . "<br>" . $conn->error;
		die();
	}

	//if $result is successful
	$row = $result->fetch_array();  //by now they should have the same email address

	if(!$row) {
		die('FATAL: user was not found');
	}

	// free the results array
	$result->close();
	
	return $row[$column];
}

//getting something from database
function querryLastTag($column) {
	//connecting to the database
	$conn = new mysqli('localhost','boubou','boubou','edel') or die('Error connecting to MySQL server.');

	// making the querry
	$dbQuery = "SELECT * FROM Tags ORDER BY tag_id DESC LIMIT 1";
	$result = $conn->query($dbQuery);

	// checking for errors
	if(!$result) {
		echo "Error: " . $dbQuery . "<br>" . $conn->error;
		die();
	}

	//if $result is successful
	$row = $result->fetch_array();  //by now they should have the same email address

	if(!$row) {
		die('FATAL: user was not found');
	}

	// free the results array
	$result->close();
	
	return $row[$column];
}

//getting all Posts related to a specific post id
//input $id is really the father post id gotton from the relation ship
function listChildrenPosts($id) {
	//connecting to the database
	$conn = new mysqli('localhost','boubou','boubou','edel') or die('Error connecting to MySQL server.');

	// making the querry
	$dbQuery = "SELECT post_id, post_type, post_date, user_id, post_rating, post_text FROM Posts INNER JOIN ChildrenPosts ON ChildrenPosts.child_post_id = Posts.post_id WHERE father_post_id='".mysqli_real_escape_string($conn,$id). "' ORDER BY Posts.post_rating DESC";

	if($id == "null") {
		$dbQuery = "SELECT post_id, post_type, post_date, user_id, post_rating, post_text FROM Posts INNER JOIN ChildrenPosts ON ChildrenPosts.child_post_id = Posts.post_id WHERE father_post_id is null ORDER BY Posts.post_rating DESC";
	}
	$result = $conn->query($dbQuery);
	
	// filling up the listing array
	$listing = array();
	$i = 0;
	$row = $result->fetch_array();
    while($row) {
    	$listing[$i] = $row;
    	$i++;
    	$row = $result->fetch_array();
    }

    //closing the connection 
    $conn->close();

    return $listing;
}

//this function would return the last result
// 0 means that the user did nothing yet to the post
// 1 means that the user did upvote the post
//-1 means that the user down vote the post
function checkUserStatus($postID, $userID) {
	//connecting to the database
	$conn = new mysqli('localhost','boubou','boubou','edel') or die('Error connecting to MySQL server.');

	// querry the 
	// making the querry
	$dbQuery = "SELECT * From Votes WHERE post_id=".mysqli_real_escape_string($conn,$postID). " AND user_id=". mysqli_real_escape_string($conn,$userID);

	$result = $conn->query($dbQuery);
	
	$row = $result->fetch_array();

    //closing the connection 
    $conn->close();

    if($row) {
    	//the vote was already registered
    	return $row['vote_value'];
    }
    return 0;
}

//delete the user pariticpation on a specific post
function deleteUserParticipation($postID, $userID, $value) {
	//connecting to the database
	$conn = new mysqli('localhost','boubou','boubou','edel') or die('Error connecting to MySQL server.');

	// making the querry
	$dbQuery = "DELETE From Votes WHERE post_id=".mysqli_real_escape_string($conn,$postID). " AND user_id=". mysqli_real_escape_string($conn,$userID);

	$result = $conn->query($dbQuery);
	
	// checking for errors
	if(!$result) {
		echo "Error: " . $dbQuery . "<br>" . $conn->error;
		die();
	}

    //closing the connection 
    $conn->close();

    //get the rating
   	$rating = querrySomethingFromPosts($postID, 'post_id', 'post_rating');
   	$rating = $rating + $value;

   	//connecting to the database
	$conn = new mysqli('localhost','boubou','boubou','edel') or die('Error connecting to MySQL server.');

	// making the querry
    $dbQuery = 'UPDATE  Posts SET post_rating='. mysqli_real_escape_string($conn,$rating) .  ' WHERE post_id=' . mysqli_real_escape_string($conn,$postID) ;

	$result = $conn->query($dbQuery);
	
	// checking for errors
	if(!$result) {
		echo "Error: " . $dbQuery . "<br>" . $conn->error;
		die();
	}

    //closing the connection 
    $conn->close();
}


//getting all uploaded posts
function listPostsUser($id) {
	//connecting to the database
	$conn = new mysqli('localhost','boubou','boubou','edel') or die('Error connecting to MySQL server.');

	// making the querry
	$dbQuery = "SELECT * FROM Posts WHERE user_id='".mysqli_real_escape_string($conn,$id). "' ORDER BY Posts.post_rating DESC";
	$result = $conn->query($dbQuery);

	$row = $result->fetch_array();
    $i = 0;
    $listing = array();
    while($row) {
    	$listing[$i] = $row;
    	$i++;
    	$row = $result->fetch_array();
    }
    //closing the connection 
    $conn->close();

    return $listing;
}


//insertTag
function insertTag($value) {
	//being consistent
	$value = strtolower($value); 
	if($value == "") {
		$value = "empty";
	}


	//connecting to the database
	$conn = new mysqli('localhost','boubou','boubou','edel') or die('Error connecting to MySQL server.');

	// making the querry
	$dbQuery = "SELECT * FROM Tags WHERE tag_name='".mysqli_real_escape_string($conn,$value). "'";
	$result = $conn->query($dbQuery);

	$row = $result->fetch_array();

    //closing the connection 
    $conn->close();	

   	if($row) {
   		return $row['tag_id'];
   	} 
    
    //if it does not exist insert it
    //connecting to the database
	$conn = new mysqli('localhost','boubou','boubou','edel') or die('Error connecting to MySQL server.');

	// making the querry
	$dbQuery = "INSERT INTO Tags (tag_name) VALUES ('".mysqli_real_escape_string($conn,$value). "')";
	$result = $conn->query($dbQuery);

	if(!$result) {
		die("error inserting a new tag of " . $value . " with this error " . $conn->error);
	}

    //closing the connection 
    $conn->close();	

    //now get the last id and return it
    $lastID = querryLastTag('tag_id');
    return $lastID;
}

//tag a post
function tagAPost($postID, $arrayOfTags) {
	//connecting to the database
	$conn = new mysqli('localhost','boubou','boubou','edel') or die('Error connecting to MySQL server.');


	//multiple inserts
	foreach($arrayOfTags as $value) {		
		// making the querry
		$dbQuery = "INSERT INTO TagPosts (tag_id, post_id) VALUES (" . mysqli_real_escape_string($conn,$value) . " ," . mysqli_real_escape_string($conn,$postID) . ")";
		$result = $conn->query($dbQuery);

		if(!$result) {
			die("error inserting a new tagpost of " . $value . " with this error " . $conn->error);
		}
	}
	//closing the connection 
	$conn->close();	
}

//get a list of tags
function listOfTags($postID) {
	//connecting to the database
	$conn = new mysqli('localhost','boubou','boubou','edel') or die('Error connecting to MySQL server.');

	// making the querry
	$dbQuery = "SELECT * FROM TagPosts INNER JOIN Tags ON TagPosts.tag_id = Tags.tag_id WHERE post_id='".mysqli_real_escape_string($conn,$postID). "' ORDER BY Tags.tag_name";
	$result = $conn->query($dbQuery);

	if(!$result) {
			die("error listing tagpost of " . $value . " with this error " . $conn->error);
		}
	//checking the result array for results
	$row = $result->fetch_array();

	//tag names array
	$tagNames = array();
	$i = 0;
	while($row) {
		$tagNames[$i] = array("#".$row['tag_name'], $row['tag_id']);
		$i++;
		$row = $result->fetch_array();
	}
	
	//closing the connection 
	$conn->close();	

	//return stuff
	return $tagNames;
}


//get a list of posts following a tag #listOfPostsRelatedToATag
function listOfPostsRelatedToATag($tagID) {
	//connecting to the database
	$conn = new mysqli('localhost','boubou','boubou','edel') or die('Error connecting to MySQL server.');

	// making the querry
	$dbQuery = "SELECT * FROM TagPosts INNER JOIN Posts ON TagPosts.post_id = Posts.post_id WHERE TagPosts.tag_id='".mysqli_real_escape_string($conn,$tagID). "' ORDER BY Posts.post_rating DESC";
	$result = $conn->query($dbQuery);

	if(!$result) {
			die("error listing tagpost of " . $tagID . " with this error " . $conn->error);
		}
	//checking the result array for results
	$row = $result->fetch_array();

	//tag names array
	$posts = array();
	$i = 0;
	while($row) {
		$posts[$i] = $row;
		$i++;
		$row = $result->fetch_array();
	}
	
	//closing the connection 
	$conn->close();	

	//return stuff
	return $posts;
}

//return a list of all tags
function listOfAllTags() {
	//connecting to the database
	$conn = new mysqli('localhost','boubou','boubou','edel') or die('Error connecting to MySQL server.');

	// making the querry
	$dbQuery = "SELECT * FROM Tags ORDER BY Tags.tag_name";
	$result = $conn->query($dbQuery);

	if(!$result) {
			die("error listing tagpost of " . $value . " with this error " . $conn->error);
		}
	//checking the result array for results
	$row = $result->fetch_array();

	//tag names array
	$tags = array();
	$i = 0;
	while($row) {
		$tags[$i] = array("#". $row['tag_name'], $row['tag_id']);
		$i++;
		$row = $result->fetch_array();
	}
	
	//closing the connection 
	$conn->close();	

	//return stuff
	return $tags;
}


//print normal post
function printPostResponsive($row) {
	#this is where we print the post
	$rating = $row['post_rating'];
	$postID = $row['post_id'];
	$postText = $row['post_text'];
	$postUserID = $row['user_id'];
	$userName = querrySomethingFromUsers($postUserID, 'user_id' , 'user_name');
	$date = $row['post_date'];

$result= <<< EOT
	<div class="row forum-main">
			<div class="col-sm-12 well" style="padding-bottom:1.5em; padding-top:0em;">
			<!-- sexy up and down vote -->
			<div class="col-sm-1 sexy-vote shrink row">
				<div>
						<a href="../php/upRatePost.php?ratedPostID=$postID"> <span class="arrows glyphicon glyphicon-chevron-up"> </span>  </a> 
					
					<div class="rating">
						<span> $rating </span>
					</div>
					
					<a style="margin: auto 0; display:block;" href="../php/downRatePost.php?ratedPostID=$postID"> <span class="arrows glyphicon glyphicon-chevron-down"> </span>  </a> 
					
				</div>
			</div>

			<!-- the main piece of sexy post -->
			<div class="col-sm-10 post-text shrink row">
				<div class="shrink">
					<div class="post-text-div">
						<a  href="postPage.php?postID=${postID}" > <p style="word-wrap: break-word;"> $postText </p> </a>

						<!-- username and date -->
						<div class="username row"> 
							<span style="color: gray;"> asked by </span> <span> $userName </span>
							<span style="color: gray;"> on $date </span>
						</div>
						
					</div>
				

					<!-- comment -->
					<div class="reply-and-tags row">
						<span onclick="document.getElementById('subpost$postID').style.display='block'" class="glyphicon glyphicon-comment" style="font-size: 0.8em; margin-right:0.4em; color: black; cursor: hand; position: relative; top:0.6em; margin-left: 0.7em; float:left; "> </span>

						<span style="font-size:0.8em; cursor: hand;" onclick="document.getElementById('subpost$postID').style.display='block'">
							reply
						</span>
						<div class="tags-container row" style="margin-left: 0.7em">
EOT;
						$tagsArray = listOfTags($postID);
    					foreach($tagsArray as $oneTag) {
		    				$result .= '<a href="tagPages.php?tagID=' . $oneTag[1]  .'">';
		    				$result .='<li class="tags">' . $oneTag[0] . '</li>';
		    				$result .=  '</a>';
    					}

$result .= <<< EOT
						<br>

    				    </div>
					</div>

					<!-- documents -->
					<div class="documents">
EOT;
					$documentsArray = listDocumentsRelatedToAPost($postID);
					foreach($documentsArray as $oneDocument) {
							$documentName = $oneDocument[1];
							$documentID = $oneDocument[0];
							$masterType = $oneDocument[2];
							$firstSlash = preg_split("/\//", $masterType)[0];
							$secondSlash= preg_split("/\//", $masterType)[1];

							//switch based on document type
							if($firstSlash == "image") {
								#insert modal
								$result .= <<< EOT
									<div class="imagePreview" style="display:inline;">
										<a  id="myImg${documentID}" onclick="document.getElementById('myModal${documentID}').style.display='block'"> <span class="glyphicon glyphicon-zoom-in"> </span>  ${documentName} </a>

										<!-- The Modal -->
											<div id="myModal${documentID}" class="modalImagePreview" onclick="this.style.display='none'";>

											  <span class="close" onclick="document.getElementById('myModal${documentID}').style.display='none'">&times;</span>

											  <!-- Modal Content (The Image) -->
											  <img style="z-index:100;" src="../uploads/${documentName}" class="modal-content-image-preview img-rounded" id="img${documentID}" onclick="event.stopPropagation(); return false;">

											  <!-- Modal Caption (Image Text) -->
											  <div style="text-align:center;">
											  <a class="downloadButton" id="caption${documentID}" href="../php/download.php?id=${documentID}"> download &mapstodown;: ${documentName} </a> </div>
											</div>

									</div>
EOT;
							}else if($secondSlash == "pdf") {
								#give them a link to the viewerhtml thing
								$urlName = rawurlencode($documentName);
								$result .='<a href="../uploads/'. $urlName .'" target="_blank"> <span class="glyphicon glyphicon-zoom-in"> </span>' . $documentName .'</a>';
							}
							else {
								$result .='<a href="../php/download.php?id=' . $documentID .'"> <span class="glyphicon glyphicon-file"> </span>' . $documentName .'</a>';
							}
					}

$result .= <<< EOT
					</div>
				</div>
			</div>

			 <!-- Login -->
			    <div id="subpost$postID" class="modal">
			        <form class="modal-content modal-container animate" action="../php/createSubPost.php" method="post">
	                   	<input type="text" style="height: 9em;" placeholder="255 characters" name="reply$postID" required>
		              	<input style="display: none;" type="text" value="$postID" name="fatherPostID">
		              	<button type="submit" value="post" style="text-weight: bold; border-radius:2em; margin-bottom:1em;"> post </button>
		           		<div style="background-color:#f1f1f1">
		                	<button type="button" onclick="document.getElementById('subpost$postID').style.display='none'" class="cancelbtn" style="border-radius: 2em;">Cancel</button>
	            		</div>
			        </form>
			    </div>
			</div>
	</div>
EOT;

	echo $result;
}

//print subpost post
function printPostResponsive2($row, $level) {
	#this is where we print the post
	$level *=3;
	$rating = $row['post_rating'];
	$postID = $row['post_id'];
	$postText = $row['post_text'];
	$postUserID = $row['user_id'];
	$userName = querrySomethingFromUsers($postUserID, 'user_id' , 'user_name');
	$date = $row['post_date'];

$result= <<< EOT
	<div class="row forum-main" style="margin-left: ${level}em; padding:0em;">
		<div class="col-sm-11 " style="border-bottom: 1px solid #eeeeee; padding-top: 0em; padding-bottom: 1em;">
			<!-- sexy up and down vote -->
			<div class="col-sm-1 sexy-vote row">
				<div class="">
						<a href="../php/upRatePost.php?ratedPostID=$postID"> <span class="arrows glyphicon glyphicon-chevron-up"> </span>  </a> 
					
					<div class="rating">
						<span> $rating </span>
					</div>
					
					<a style="margin: auto 0; display:block;" href="../php/downRatePost.php?ratedPostID=$postID"> <span class="arrows glyphicon glyphicon-chevron-down"> </span>  </a> 
					
				</div>
			</div>

			<!-- the main piece of sexy post -->
			<div class="col-sm-8 post-text row">
				<div class=" shrink" style="padding: 0em;">
					<div class="post-text-div">
						<p style="word-wrap: break-word; font-size: 0.6em;"> $postText </p> 
						<!-- username and date -->
						<div class="username row"> 
							<span style="color: gray;"> by </span> <span> $userName </span>
							<span style="color: gray;"> on $date </span>
						</div>
					</div>

				
					<!-- comment -->
					<div class="reply-and-tags row" style="position:relative; top:-0.4em; left:0.3em;">
						<span onclick="document.getElementById('subpost$postID').style.display='block'" class="glyphicon glyphicon-comment" style="font-size: 0.8em; color: black; cursor: hand;position: relative; top:0.6em; float:left"> </span>

						<span style="font-size:0.7em; margin-left:0.4em; cursor: hand; position: relative; bottom: 0.1em;" onclick="document.getElementById('subpost$postID').style.display='block'">
							  reply
						</span>

    				    </div>
					</div>
				</div>
			</div>

			 <!-- Login -->
			    <div id="subpost$postID" class="modal">
			        <form class="modal-content modal-container animate" action="../php/createSubPost.php" method="post">
	                   	<input type="text" style="height: 9em;" placeholder="255 characters" name="reply$postID" required>
		              	<input style="display: none;" type="text" value="$postID" name="fatherPostID">
		              	<button type="submit" value="post" style="text-weight: bold; border-radius:2em; margin-bottom:1em;"> post </button>
		           		<div style="background-color:#f1f1f1">
		                	<button type="button" onclick="document.getElementById('subpost$postID').style.display='none'" class="cancelbtn" style="border-radius: 2em;">Cancel</button>
	            		</div>
			        </form>
			    </div>
		</div>
	</div>
EOT;

	echo $result;
}


// functions
// attach documents
function attachDocuments($postID) {
    $conn = new mysqli('localhost','boubou','boubou','edel') or die('Error connecting to MySQL server.');
    $targetDir = "../uploads/";

    foreach ($_FILES["file"]["error"] as $key => $error) {
        $tmpName =  $_FILES["file"]["tmp_name"][$key];
        $fileName = $_FILES["file"]["name"][$key];
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);
        $fileType = $_FILES["file"]["type"][$key];
     	$targetFile = $targetDir . basename($fileName);
        $fileSize = "";
        #check for erros
        if ($error == UPLOAD_ERR_OK) {
            #storing the uploded files in the upload directory
            move_uploaded_file(
               $tmpName, 
                $targetFile
                ) or die("Problems with upload");


			#reading the file size
            $fileSize = filesize($targetFile);

            #getting extra required data
            $fileHandle = fopen($targetFile, "r");
            $fileContent = fread($fileHandle, $fileSize);

            #create documents and store them in the database
            //building a querry
            $dbQuery = "INSERT INTO Documents (document_type, document_size, document_name, document_content, post_id) VALUES ('" . mysqli_real_escape_string($conn, $fileType) ."', '" . mysqli_real_escape_string($conn, $fileSize) ."', '" . mysqli_real_escape_string($conn, $fileName) ."', '" . mysqli_real_escape_string($conn,$fileContent) ."' , " . $postID . ")";
          
            $result = $conn->query($dbQuery);

            fclose($fileHandle);

            if(!$result) {
                die("something went wrong with inserting a file to database" . $conn->error);
            } if($fileSize == 0) {
            	die("file size is 0");
            }

           
        } else {
            die("upload error ". $fileSize . " error-> " . $error);
        }
    }
    //closing connection
    $conn->close();
}

// get documents linked to a post
// given the post id
function listDocumentsRelatedToAPost($postID) {
	//connecting to the database
	$conn = new mysqli('localhost','boubou','boubou','edel') or die('Error connecting to MySQL server.');

	// making the querry
	$dbQuery = "SELECT document_id, document_name, document_type FROM Posts INNER JOIN Documents ON Documents.post_id = Posts.post_id WHERE Posts.post_id='".mysqli_real_escape_string($conn,$postID). "'";

	$result = $conn->query($dbQuery);

	// filling up the listing array
	$listing = array();
	$i = 0;

	if(!$result) {
		return array();
	}
	$row = $result->fetch_array();
    while($row) {
    	$listing[$i][0] = $row['document_id'];
    	$listing[$i][1] = $row['document_name'];
    	$listing[$i][2] = $row['document_type'];
    	$i++;
    	$row = $result->fetch_array();
    }

    //closing the connection 
    $conn->close();

    return $listing;
}


// get document content given document id
function getDocumentContent($id) {
	//connecting to the database
	$conn = new mysqli('localhost','boubou','boubou','edel') or die('Error connecting to MySQL server.');

	// making the querry
	$dbQuery = "SELECT document_name, document_type, document_size, document_content FROM Documents WHERE document_id='".mysqli_real_escape_string($conn,$id). "'";

	// $result
	$result = $conn->query($dbQuery);

	// checking for errors
	if(!$result) {
		echo "Error: " . $dbQuery . "<br>" . $conn->error;
		die();
	}

	//if $result is successful
	$row = $result->fetch_array();  //by now they should have the same email address

	if(!$row) {
		die('FATAL: document was not found');
	}

	// free the results array
	$result->close();
	$conn->close();

	return $row;
}

// get users email based on post id
function getUserEmailPostID($postID) {
	//connecting to the database
	$conn = new mysqli('localhost','boubou','boubou','edel') or die('Error connecting to MySQL server.');

	// making the querry
	$dbQuery = "SELECT Users.user_email FROM Users INNER JOIN Posts ON Posts.user_id = Users.user_id WHERE post_id='".mysqli_real_escape_string($conn,$postID). "'";

	// $result
	$result = $conn->query($dbQuery);

	// checking for errors
	if(!$result) {
		echo "Error: " . $dbQuery . "<br>" . $conn->error;
		die("result is empty");
	}

	//if $result is successful
	$row = $result->fetch_array();  //by now they should have the same email address

	if(!$row) {
		die('FATAL: document was not found');
	}

	// free the results array
	$result->close();
	$conn->close();

	return $row['user_email'];
}
?>