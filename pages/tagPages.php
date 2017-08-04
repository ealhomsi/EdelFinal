<?php 
    //init
    session_start(); 
    include  "../php/functions.php";
    $tagID = $_GET['tagID'];
    $tagName = querrySomethingFromTags($tagID, 'tag_id', 'tag_name');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tag <?php echo $tagName; ?>  </title>
    <!-- all required includes -->
    <?php include '../template/includes-non-index.html' ?>

</head>

<body>
    <!-- navbar -->
    <?php include '../template/navbar-non-index.php' ?>


    <!-- Navbar on small screens -->
    <div id="navDemo" class="w3-bar-block w3-black w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:46px">
        <a href="#band" class="w3-bar-item w3-button w3-padding-large">BAND</a>
        <a href="#tour" class="w3-bar-item w3-button w3-padding-large">TOUR</a>
        <a href="#contact" class="w3-bar-item w3-button w3-padding-large">CONTACT</a>
        <a href="#" class="w3-bar-item w3-button w3-padding-large">MERCH</a>
    </div>

    
    
    <br>

     <!-- Querry the database for all posts listed in those tags-->
    <div class="w3-content" style="max-width:2000px;margin-top:46px">
        <br>
        <br>
        <h2 style="margin-left: 1.5em;"> Posts with tag of #<?php echo $tagName; ?>:</h2> <br>
        <?php
            function printByTag($tagID) {
                $result = listOfPostsRelatedToATag($tagID);
                //getting all posts
                foreach ($result as $value) {
                    printPostResponsive($value, "");
                }
            }
            printByTag($tagID);
        ?>
        
    </div>

    <!-- Login -->
    <div id="id01" class="modal">
        <form class="modal-content animate" action="../php/verifyCredentials.php" method="post">
            <div class="imgcontainer">
                <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
                <img src="../images/img_avatar2.png" alt="Avatar" class="avatar">
            </div>
            <div class="modal-container">
                <label><b>Email</b></label>
                <input type="email" placeholder="Enter Email" name="userEmail" required>
                <label><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="userPassword" required>
                <button type="submit" style="background-color: #456990">Login</button>
                <input type="checkbox" checked="checked"> Remember me
            </div>
            <div class="modal-container" style="background-color:#f1f1f1">
                <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
                <span class="psw" style="float:right;"> <a style="color: blue;" onclick="hideAndShow()" > <span style="background-color:#2dd0c6; border-radius: 1em; padding:0.5em 1em; color:white; margin-left: 2em; display:block; float:right; position:relative; bottom:1.1em;"> Sign up <span> </a></span>
            </div>
        </form>
    </div>
    <!-- Register -->
    <div id="id02" class="modal">
        <form class="modal-content animate" action="../php/registerUser.php" method="post">
            <div class="imgcontainer">
                <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
                <img src="../images/img_avatar2.png" alt="Avatar" class="avatar">
            </div>
            <div class="modal-container">

                <label><b>Name</b></label>
                <input type="text" placeholder="Enter Name" name="userName" required>

                <label><b>Email</b></label>
                <input type="email" placeholder="Enter Email" name="userEmail" required>

                <label><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="userPassword" required>

                <label><b>IMEI</b></label>
                <input type="text" placeholder="Enter IMEI" name="userImei" required>

                <button type="submit" style="background-color: #456990">Register</button>
               
            </div>
            <div class="modal-container" style="background-color:#f1f1f1">
                <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
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

        var modal2 = document.getElementById('id02');

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal2) {
                modal.style.display = "none";
            }
        }
    </script>

    <!-- Footer -->
    
    <script>
        // Automatic Slideshow - change image every 4 seconds
        var myIndex = 0;
        carousel();

        function carousel() {
            var i;
            var x = document.getElementsByClassName("mySlides");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            myIndex++;
            if (myIndex > x.length) {
                myIndex = 1
            }
            x[myIndex - 1].style.display = "block";
            setTimeout(carousel, 4000);
        }

        // Used to toggle the menu on small screens when clicking on the menu button
        function myFunction() {
            var x = document.getElementById("navDemo");
            if (x.className.indexOf("w3-show") == -1) {
                x.className += " w3-show";
            } else {
                x.className = x.className.replace(" w3-show", "");
            }
        }

        // When the user clicks anywhere outside of the modal, close it
        var modal = document.getElementById('ticketModal');
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
    colorBlack();
</script>
</html>
