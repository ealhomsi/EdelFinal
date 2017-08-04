<?php 
	//init
	session_start(); 
	include  "php/functions.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>EDEL</title>
    <?php include './template/includes.html' ?>
</head>

<body>
    <!-- navbar -->
    <?php include 'template/navbar.php' ?>


    <!-- Navbar on small screens -->
    <div id="navDemo" class="w3-bar-block w3-black w3-hide w3-hide-large w3-hide-medium w3-top" style="margin-top:46px">
        <a href="#band" class="w3-bar-item w3-button w3-padding-large">BAND</a>
        <a href="#tour" class="w3-bar-item w3-button w3-padding-large">TOUR</a>
        <a href="#contact" class="w3-bar-item w3-button w3-padding-large">CONTACT</a>
        <a href="#" class="w3-bar-item w3-button w3-padding-large">MERCH</a>
    </div>

    <!-- big screen -->
    <div id="splashScreen">
        <img src="https://storage.moqups.com/repo/iNXjFx1a/images/iPCgz6naJD.png" id="imgSplashScreen">
      
        <h2 id="slogan"> Built for Refugees and Asylum Seekers </h2>

        <h4 id="subSlogan"> Get answers fast and confidentially </h4>
        <div class="downloadApp">
            <img class="downloadAppImages" src="https://storage.moqups.com/repo/iNXjFx1a/images/jsgz4kcW2q.png">
            <img class= "downloadAppImages" src="https://storage.moqups.com/repo/iNXjFx1a/images/A6v9HOv8On.png">
        </div>
    </div>

    <!-- phone in hand -->
    <div >
        <img id="phoneInHand" src="images/phoneInHand.png">
    </div>

    <!-- Login -->
    <?php include './template/login.html' ?>
    <!-- Register -->
    <?php include './template/register.html' ?>
    
    <!-- add script -->
    <script src="js/register-modal.js"> </script>
    <!-- Page content -->
    <div class="w3-content" class="newStyle">
        <!-- The Band Section -->
        <div class="w3-container w3-content w3-center w3-padding-64" style="max-width:800px" id="band">
            <h2 class="w3-wide">EDEL</h2>
            <p class="w3-opacity"><i>We love refugees</i></p>
            <p class="w3-justify">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse molestie arcu volutpat est interdum, at egestas orci facilisis. Praesent vitae est vel nibh finibus consequat eget non erat. Cras vulputate tincidunt mauris nec facilisis. Integer mollis maximus tristique. Proin ac libero a orci ornare suscipit. Sed tempor nunc eu nisl venenatis, ac feugiat sem maximus. Maecenas enim lorem, pulvinar elementum dolor et, feugiat faucibus massa. Phasellus eu gravida quam, non euismod diam.</p>
            <div class="w3-row w3-padding-32">
                <div class="w3-third">
                    <p>Name</p>
                    <img src="images/here.png" class="w3-round w3-margin-bottom" alt="Random Name" style="width:60%">
                </div>
                <div class="w3-third">
                    <p>Name</p>
                    <img src="images/here.png" class="w3-round w3-margin-bottom" alt="Random Name" style="width:60%">
                </div>
                <div class="w3-third">
                    <p>Name</p>
                    <img src="images/here.png" class="w3-round" alt="Random Name" style="width:60%">
                </div>
            </div>
        </div>
        <!-- The Tour Section -->
        <div class="w3-black" id="tour">
            <div class="w3-container w3-content w3-padding-64" style="max-width:800px; width:100%;">
                <h2 class="w3-wide w3-center">SOMETHING</h2>
                <p class="w3-opacity w3-center"><i>Remember to book your tickets!</i></p>
                <br>
                <ul class="w3-ul w3-border w3-white w3-text-grey">
                    <li class="w3-padding">September <span class="w3-tag w3-red w3-margin-left">Sold out</span></li>
                    <li class="w3-padding">October <span class="w3-tag w3-red w3-margin-left">Sold out</span></li>
                    <li class="w3-padding">November <span class="w3-badge w3-right w3-margin-right">3</span></li>
                </ul>
                <div class="w3-row-padding w3-padding-32" style="margin:0 -16px">
                    <div class="w3-third w3-margin-bottom">
                        <div class="w3-container w3-white">
                            <p><b>New York</b></p>
                            <p class="w3-opacity">Fri 27 Nov 2016</p>
                            <p>Praesent tincidunt sed tellus ut rutrum sed vitae justo.</p>
                            <button class="w3-button w3-black w3-margin-bottom" onclick="document.getElementById('ticketModal').style.display='block'">Buy Tickets</button>
                        </div>
                    </div>
                    <div class="w3-third w3-margin-bottom">
                        <div class="w3-container w3-white">
                            <p><b>Paris</b></p>
                            <p class="w3-opacity">Sat 28 Nov 2016</p>
                            <p>Praesent tincidunt sed tellus ut rutrum sed vitae justo.</p>
                            <button class="w3-button w3-black w3-margin-bottom" onclick="document.getElementById('ticketModal').style.display='block'">Buy Tickets</button>
                        </div>
                    </div>
                    <div class="w3-third w3-margin-bottom">
                        <div class="w3-container w3-white">
                            <p><b>San Francisco</b></p>
                            <p class="w3-opacity">Sun 29 Nov 2016</p>
                            <p>Praesent tincidunt sed tellus ut rutrum sed vitae justo.</p>
                            <button class="w3-button w3-black w3-margin-bottom" onclick="document.getElementById('ticketModal').style.display='block'">Buy Tickets</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ticket Modal -->
        <div id="ticketModal" class="w3-modal">
            <div class="w3-modal-content w3-animate-top w3-card-4">
                <header class="w3-container w3-teal w3-center w3-padding-32">
                    <span onclick="document.getElementById('ticketModal').style.display='none'" class="w3-button w3-teal w3-xlarge w3-display-topright">×</span>
                    <h2 class="w3-wide"><i class="fa fa-suitcase w3-margin-right"></i>Tickets</h2>
                </header>
                <div class="w3-container">
                    <p>
                        <label><i class="fa fa-shopping-cart"></i> Tickets, $15 per person</label>
                    </p>
                    <input class="w3-input w3-border" type="text" placeholder="How many?">
                    <p>
                        <label><i class="fa fa-user"></i> Send To</label>
                    </p>
                    <input class="w3-input w3-border" type="text" placeholder="Enter email">
                    <button class="w3-button w3-block w3-teal w3-padding-16 w3-section w3-right">PAY <i class="fa fa-check"></i></button>
                    <button class="w3-button w3-red w3-section" onclick="document.getElementById('ticketModal').style.display='none'">Close <i class="fa fa-remove"></i></button>
                    <p class="w3-right">Need <a href="#" class="w3-text-blue">help?</a></p>
                </div>
            </div>
        </div>

        <!-- The Contact Section -->
        <div class="w3-container w3-content w3-padding-64" style="max-width:800px" id="contact">
            <h2 class="w3-wide w3-center">CONTACT</h2>
            <p class="w3-opacity w3-center"><i>Fan? Drop a note!</i></p>
            <div class="w3-row w3-padding-32">
                <div class="w3-col m6 w3-large w3-margin-bottom">
                    <i class="fa fa-map-marker" style="width:30px"></i> Chicago, US
                    <br>
                    <i class="fa fa-phone" style="width:30px"></i> Phone: +00 151515
                    <br>
                    <i class="fa fa-envelope" style="width:30px"> </i> Email: mail@mail.com
                    <br>
                </div>
                <div class="w3-col m6">
                    <form action="/action_page.php" target="_blank">
                        <div class="w3-row-padding" style="margin:0 -16px 8px -16px">
                            <div class="w3-half">
                                <input class="w3-input w3-border" type="text" placeholder="Name" required name="Name">
                            </div>
                            <div class="w3-half">
                                <input class="w3-input w3-border" type="text" placeholder="Email" required name="Email">
                            </div>
                        </div>
                        <input class="w3-input w3-border" type="text" placeholder="Message" required name="Message">
                        <button class="w3-button w3-black w3-section w3-right" type="submit">SEND</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- End Page Content -->
    </div>

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
    window.addEventListener("scroll", update);
</script>
</html>
