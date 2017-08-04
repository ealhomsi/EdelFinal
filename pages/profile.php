<?php 
//init
session_start(); 
include  "../php/functions.php";

if(!isset($_SESSION['userID'])) 
    die("you should login/register first");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Your Profile <?php echo $_SESSION['userName'] ?> </title>
    <!-- all required includes -->
    <?php include '../template/includes-non-index.html' ?>

    <style>
        #new-post-btn {
            cursor: hand;
            background-color: #2dd0c6;
            color: white;
            margin-left: 3em;
            border-radius: 2em;
            border-color: white;
        }

        #new-post-btn:hover {
            background-color: white;
            border-color: black;
            text-decoration: none;
        }

        #upload-area {
            text-align: center;

        }

        #upload-area .js .inputfile {
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: 1;
        }

        #upload-area .inputfile + label {
            max-width: 80%;
            font-size: 1.25rem;
            /* 20px */
            font-weight: 700;
            text-overflow: ellipsis;
            white-space: nowrap;
            cursor: pointer;
            display: inline-block;
            overflow: hidden;
            padding: 0.625rem 1.25rem;
            /* 10px 20px */
        }

        #upload-area .no-js .inputfile + label {
            position:absolute;
        }

        #upload-area .inputfile:focus + label,
        #upload-area .inputfile.has-focus + label {
            outline: 1px dotted #000;
            outline: -webkit-focus-ring-color auto 5px;
        }

        #upload-area .inputfile {
            z-index: 1;
            opacity: 0;
            position: absolute;
            text-align: center;
            display:inline;
        }
        #upload-area .inputfile + label * {
            /* pointer-events: none; */
            /* in case of FastClick lib use */
        }

        #upload-area .inputfile + label svg {
            width: 1em;
            height: 1em;
            vertical-align: middle;
            fill: currentColor;
            margin-top: -0.25em;
            /* 4px */
            margin-right: 0.25em;
            /* 4px */
        }


        /* style 1 */

        #upload-area .inputfile + label {
            color: #f1e5e6;
            background-color: #d3394c;
        }

        #upload-area .inputfile:focus + label,
        #upload-area .inputfile.has-focus + label,
        #upload-area .inputfile + label:hover {
            background-color: #722040;
        }

        #upload-area .exit-sign{
            font-size: 1.2em;
            cursor: pointer;
            display: inline-block;
            position:relative;
            top:-0.7em;
            z-index: 100;
        }

        .hover-non-decoration:hover {
            text-decoration: none;
        }

    </style>
    <!--[if IE]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>


<body>
    <!-- navbar -->
    <?php include '../template/navbar-non-index.php' ?>

    <!-- Querry the database for all posts listed so far-->
    <div class="w3-content" style="max-width:2000px;margin-top:46px">
    	<br>
    	<br>
        <h2 style="margin-left: 1em;"> Your uploaded posts:</h2>
        <br>
        <a  id="new-post-btn" onclick="cleanAndPost()" class="w3-bar-item w3-button w3-padding-large w3-hide-small">New Post</a>        
        <br>
        <?php
            function listingUserPostsGivenID($id) {
                $result = listPostsUser($id);
                
                echo '<h3 style="margin-left:2em;"><br> You have ' . sizeof($result) . " posts: <br></h3>";
                //getting all posts
                foreach ($result as $value) {
                    printPostResponsive($value, "");
                }
            }
            listingUserPostsGivenID($_SESSION['userID']);
        ?>
        
    </div>

    <!-- New Post -->
    <div id="id01" class="modal">
        <form class="modal-content animate" action="../php/createPost.php" method="post" enctype="multipart/form-data">
            <div class="modal-container">
                <label><b>Post Type</b></label>
                <input type="text" placeholder="Describe the new subEdel" name="postType" required>

                <label><b>Post Text</b></label>
                <input type="text" style="height:9em;" placeholder="text 255 chars left" name="postText" required>

				<label><b> Tags: seperate tags by a ; "semi colon" </b> </label>
				<input type="text" placeholder="Tags: seperate tags by a ; semi colon" name="postTags" required>
                <br>
                <a onclick="addNewUploadBox()" class="hover-non-decoration"> Attach + </a>
                <br>

                <div id="upload-area">
                </div>
                <button type="submit" id="submit-post-btn" value="Submit">Submit</button>
            </div>
            <div class="modal-container">
               
                <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
            </div>
        </form>
    </div>

<!-- hide and show stuff -->
<script>
    // Get the modal
    var modal = document.getElementById('id01');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
    
<!-- Footer -->
<footer class="w3-container w3-padding-64 w3-center w3-opacity w3-light-grey w3-xlarge">
    <i class="fa fa-facebook-official w3-hover-opacity"></i>
    <i class="fa fa-instagram w3-hover-opacity"></i>
    <i class="fa fa-snapchat w3-hover-opacity"></i>
    <i class="fa fa-pinterest-p w3-hover-opacity"></i>
    <i class="fa fa-twitter w3-hover-opacity"></i>
    <i class="fa fa-linkedin w3-hover-opacity"></i>
    <p class="w3-medium">Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
</footer>
</body>

<script>
    //registering handlers
    registerBody();
    var uploadArea = document.getElementById("upload-area");
    var arrayList = [];
    //fixing colors
    colorBlack();

    //adding functions
    function cleanAndPost() {
        uploadArea.innerHTML = '';
        document.getElementById('id01').style.display='block';
    }

    function addNewUploadBox() {
        uploadArea.innerHTML = uploadArea.innerHTML + `
            <div>
                <div class="row" style="postion:relative;">
                    <input type="file"  name="file[]" class="inputfile" required/>
                    <label "><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Choose a file&hellip;</span></label>
                    <span class="exit-sign glyphicon glyphicon-remove"> </span>
                </div>
            </div>

        `;

        //first defining the two functions
        //readding the event handlers for everything
        //function event for closing the thing 
        close = (e) => {
            var targetElement = event.target || event.srcElement;
            targetElement.parentElement.parentElement.outerHTML = "";
        }

        //create event for the uploading
        handler = (e) => {
            var targetElement = event.target || event.srcElement;

            var fileName = '';
            var label    = targetElement.nextElementSibling,
            labelVal = label.innerHTML;

            label.style.backgroundColor = "#eeeeee";
            label.style.color = "red";

            fileName = e.target.value.split( '\\' ).pop();
            if( fileName )
                label.querySelector( 'span' ).innerHTML = fileName;
            else
                label.innerHTML = labelVal;
        }

        //for the whole thing
        var arrayList = uploadArea.children;
        for(var count = 0; count < arrayList.length; count++) {
            var input = arrayList[count];
            input.firstElementChild.firstElementChild.addEventListener('change', handler);
            input.firstElementChild.lastElementChild.addEventListener('click', close);
        }
    }
</script>

</html>
