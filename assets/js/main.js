//Global variables
var elem, modal, screen_detect, count = 0;


//Scroll down
window.onscroll = function() {scrollFunction()};
function scrollFunction() {
    if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
        document.getElementById("roll_back").style.display = "flex";
    } else {
        document.getElementById("roll_back").style.display = "none";
    }
}


//Detect keys
document.addEventListener("keydown", ({key}) => {
    if (key === "Escape"){
        window.location.href="#";
        document.getElementById("open-modal").remove();
    }
});

function RemoveModal(){
     document.getElementById("open-modal").remove();
}

if (window.matchMedia("(max-width: 920px)").matches){
    nav();
}


//Screen resize detect
window.addEventListener('resize', function(event) {
    if (window.matchMedia("(max-width: 920px)").matches){
        nav();
    } else {
        document.getElementById("nav").remove();
        count = 0;
    }
}); 


//Nav
function nav() {
    if (count == "0"){ 
        count++;
        elem = document.createElement("div");
        elem.setAttribute("id","nav");
        elem.innerHTML = "<a href='#'><i class='fa fa-home medium'></i></a> <a href='#'><i class='fa fa-gear medium'></i></a> <a href='#'><i class='fa fa-pencil medium'></i></a> <a href='#'><i class='fa fa-phone medium'></i></a> <a href='#open-modal'><i class='fa fa-sign-in medium login'></i></a>";
        document.body.appendChild(elem);
    }
}


//Detect sign-in/register button click & open modal
$(".modal").click(function(){
    modal = document.createElement("div");
    modal.setAttribute("id","open-modal");
    modal.setAttribute("class","modal-window");
    if ($(this).hasClass("login")){
        modal.innerHTML = '<div class="padding_2x"><a href="#" onclick="RemoveModal()"  title="Close" class="modal-close">Close</a><div><h1 class="small">LogIn</h1><form id="login_form"><input type="text" name="usname" placeholder="Username" maxlength="80"><input type="password" name="pssd" placeholder="Password" maxlength="30"><button class="btn1" id="login_btn">LogIn</button></form><a href="javascript:{}" onclick="Modal_content(2)">Create new account</a></div></div>';
    }
    document.body.appendChild(modal);
});


//Modal content changer
function Modal_content(type){
    type == "1" ? 
    $("#open-modal").html('<div class="padding_2x"><a href="#" onclick="RemoveModal()"  title="Close" class="modal-close">Close</a><div><h1 class="small">LogIn</h1><form id="login_form"><input type="text" name="usname" placeholder="Username" maxlength="80"><input type="password" name="pssd" placeholder="Password" maxlength="30"><button class="btn1" id="login_btn">LogIn</button></form><a href="javascript:{}" class="register_content" onclick="Modal_content(2)">Create new account</a></div></div>') 
    :
    $("#open-modal").html('<div class="padding_2x"><a href="#" onclick="RemoveModal()"  title="Close" class="modal-close">Close</a><div><h1 class="small">Register</h1><form id="register_form"><input type="text" name="usname" placeholder="Username" maxlength="80"><input type="email" name="email" placeholder="Email" maxlength="100"><input type="password" name="pssd" placeholder="Password" maxlength="30"><button class="btn1" id="register_btn">Register</button></form><a href="javascript:{}" onclick="Modal_content(1)">LogIn</a></div></div>');
}

//Popup messages
function popup(message){
    var popup = document.createElement("div");
    popup.setAttribute("id","popup");
    popup.setAttribute("class","show");
    if (message.match(/success:/g)){ 
        popup.innerHTML = message.replace(/success:/g,"<i class='fa fa-check-circle-o'></i>");
        popup.classList.add("success");
    } else {
        popup.innerHTML = message.replace(/failure:/g,"<i class='fa fa-times-circle-o'></i>");
        popup.classList.add("failure");
    }
    document.body.appendChild(popup);
    setTimeout(function(){
            popup.className = popup.className.replace("show", "");
            popup.remove();
            }, 5000);
    return 1;
}

