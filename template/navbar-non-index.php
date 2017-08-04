<?php
    $fileName = basename($_SERVER["SCRIPT_FILENAME"], '.php');

    function selectedMenu($fileName, $current) {
        if($fileName == $current) {
            echo "selectedMenu";
        }
    }
?>


<!-- Navbar -->
<div id="navbar-container" class="w3-top">
    <nav class="w3-bar w3-card-2 navbar navbar-default" id="navbar-background">
        <div id="logo"> <a href="../index.php" class="w3-bar-item w3-button w3-padding-large col-sm-4" id="logo">EDEL</a> </div>
           
        <ul id="menu-bar" class="row">
            <li> <a class="w3-bar-item w3-button w3-padding-large w3-hide-medium w3-hide-large w3-right col-sm-1" href="javascript:void(0)" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a> </li>
            <li> <a href="../index.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small col-sm-1">HOME</a> </li>
            <li> <a href="newsfeed.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small col-sm-1 <?php selectedMenu($fileName, "newsfeed") ?> ">FORUM</a> </li>
            <li> <a href="tags.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small col-sm-1 <?php selectedMenu($fileName, "tags") ?>">TAGS</a> </li>
            <li id="last-menu"> <a href="aboutus.php" class="w3-bar-item w3-button w3-padding-large w3-hide-small col-sm-1 <?php selectedMenu($fileName, "aboutus") ?> ">ABOUT US</a> </li>
            
             <?php
                $result = '';
                
                if(isset($_SESSION['userName'])) {
                    $userName = $_SESSION['userName'];
                    $result = <<< EOT
                    
                    <li>
                    <a class="w3-bar-item w3-button w3-padding-large col-sm-1  action-button w3-hide-small" href="../php/logout.php">     
                        <span> Logout </span>
                    </a> </li>


                    <li>
                    <a  href="profile.php" class="w3-bar-item w3-button w3-padding-large col-sm-1  w3-hide-small action-button">     
                        <span> Profile </span>
                    </a> </li>

                    <li>
                    <a class='w3-bar-item w3-padding-large w3-hide-small w3-button col-sm-1 w3-hide-small' style="float:right;" href="profile.php">
                        <p style="color:gray;"> hello  <span id="user-name-id" style="color: black;"> $userName </span> </p>
                    </a> </li>
EOT;

                } else {
                    $result = <<< EOT
                
                    <li>
                    <a class="w3-bar-item w3-button w3-padding-large col-sm-1 w3-hide-small action-button" onclick="document.getElementById('id01').style.display='block'">     
                        <span> Login </span>
                    </a> </li>

                    <li>
                    <a class="w3-bar-item w3-button w3-padding-large col-sm-1 w3-hide-small action-button" onclick="document.getElementById('id02').style.display='block'">     
                        <span> Sign up </span>
                    </a> </li>
EOT;
                }
                echo $result;
            ?>
            
            <li>
            <div>
                <a href="javascript:void(0)" class="col-sm-1 w3-padding-large w3-hover-gray w3-hide-small w3-right"><i class="fa fa-search"></i></a>
            </div> </li>

        </ul>
    </nav>
</div>
