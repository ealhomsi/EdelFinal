
var body = 0 ;
var NavBarShit = 0;
var userName = 0;
var actionButtons;
function registerBody() {
    body = document.getElementsByTagName("body")[0];
    NavBarShit = document.getElementById("navbar-background");
    userName = document.getElementById("user-name-id");
    actionButtons = document.getElementsByClassName("action-button");

    NavBarShit.style.borderWidth = '0';
   	NavBarShit.style.backgroundColor = "rgba(255,255,255,0.5)";
    NavBarShit.style.color = "black";
}

function colorBlack() {
	NavBarShit.style.backgroundColor = "black";
    NavBarShit.style.opacity = "0.99";
    NavBarShit.style.color = "white";
    if(userName) {
      userName.style.color = "white";   
    }

    NavBarShit.style.borderWidth = '0';
   	for(var count =0; count < actionButtons.length; count++) {
   		colorBorderWhite(actionButtons[count]);
   	}
}

function update() {
    if(body.scrollTop > 355.45452880859375) {
        NavBarShit.style.backgroundColor = "black";
        NavBarShit.style.opacity = "0.99";
        NavBarShit.style.color = "white";
        if(userName) {
          userName.style.color = "white";   
        }

    	NavBarShit.style.borderWidth = '0';
       	for(var count =0; count < actionButtons.length; count++) {
       		colorBorderWhite(actionButtons[count]);
       	}
    } else { 
      NavBarShit.style.backgroundColor = "rgba(255,255,255,0.5)";
      NavBarShit.style.color = "black";
      if(userName){
        userName.style.color = "black";    
      }
    	NavBarShit.style.borderWidth = '0';

		for(var count =0; count < actionButtons.length; count++) {
		    colorBorderBlack(actionButtons[count]);
		 }

    }
}



function colorBorderWhite(item) {
	item.style.borderColor = "white";
}

function colorBorderBlack(item) {
	item.style.borderColor = "black";
}