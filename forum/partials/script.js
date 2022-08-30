
//of header javascript
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function (event) {
    if (!event.target.matches(".dropbtn")) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains("show")) {
                openDropdown.classList.remove("show");
            }
        }
    }
}

// signup javasscript
function func() {
    var email = document.register.email.value;
    let password = document.register.password.value;
    let cpassword = document.register.cpassword.value;
    var atposition=email.indexOf("@");  
    var dotposition=email.lastIndexOf(".");  
    if (email == "") {
        alert("please enter email");
        return false;
    }
    
    if (atposition<1 || dotposition<atposition+2 || dotposition+2>=email.length){  
    alert("Please enter a valid e-mail address \n atpostion:"+atposition+"\n dotposition:"+dotposition);  
    return false;  
    }  
    
    if (password == "") {
        alert("please enter password");
        return false;
    }
    if(password.length < 6){
        alert ("please enter strong password");
        return false;
    }
    if (cpassword == "") {
        alert("please confirm your password");
        return false;
    } 

    else {
        // alert("Form have submitted succesfully so go to the login page for login");
        return ture;
    }
}

// login javascript
function func1() {
    let email = document.register.email.value;
    let password = document.register.password.value;
    if (email == "") {
        alert("Enter your user email");
        return false;
    }
    if (password == "") {
        alert("Enter your password");
        return false;
    }
    else {
        return ture;
    }
}

//threadlist form javascript
function func3() {
    let title = document.register.title.value;
    let desc = document.register.desc.value;
    if (title == "") {
        alert("Enter your title");
        return false;
    }
    if (desc == "") {
        alert("Please ellaborate your problem");
        return false;
    }
    else {
        return ture;
    }
}

//thread form javascript
function func4() {
    let comment = document.register.comment.value;
    if (comment == "") {
        alert("Enter your comment");
        return false;
    }
    else {
        return ture;
    }
}

//for contact form
function func5() {
    let email = document.register.email.value;
    if (email == "") {
        alert("Enter your email");
        return false;
    }

    if (details == "") {
        alert("Enter description");
        return false;
    }

    else {
        return ture;
    }
}

//for responsive navigation bar
function myFunction2() {
    let b = document.getElementById("logo_navbar");
    let c = document.getElementById("rectangle");
    let d= document.getElementById("cross");
    let y = document.getElementById("navbar");
    if (y.style.display === "none") {
        y.style.display = "flex";
        c.style.display = "none";
        d.style.display = "block"; 
        y.setAttribute('class', 'blur');  
    } else {
        y.style.display = "none";
        d.style.display = "none";
        c.style.display = "block";
        b.style.display = "flex";
        y.setAttribute('class', null);

    }
}

//for confirm
function question() {
    return confirm("Are you sure ?");
}








