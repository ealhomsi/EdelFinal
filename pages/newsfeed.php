<?php 
    //init
    session_start(); 
    include  "../php/functions.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Forum</title>

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
        <h2 style="margin-left: 1.5em;">  Forum</h2> <br>
         <?php
          function listPosts($id, $level) {
            $result = listChildrenPosts($id);
            foreach ($result as $value) {
              if($id == "null") {
                printPostResponsive($value);
              } else {
                printPost2($value, $level);
              }
              #listPosts($value["post_id"], $level+1);
            }
          }

          listPosts("null", 0);
        ?>     
    </div>

    <!-- Login -->
    <?php include '../template/login-non-index.html' ?>
    <!-- Register -->
    <?php include '../template/register-non-index.html' ?>

    <!-- add script -->
    <script src="../js/register-modal.js"> </script>


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
