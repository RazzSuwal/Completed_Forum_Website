<?php session_start(); ?>
<?php
include '_dbconnect.php';
echo'
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="partials/script.js"></script>
<link rel="stylesheet" href="/FORUM/css/style_header.css">
<script src="/FORUM/partials/script.js"></script>
</head>

<body>
<nav>
    <div id="logo_navbar">
        <a class = "mylogo myanker" style="background-color: purple;" href="/FORUM/index.php">𝕮-sOLUTION</a>
    </div>
    <div id="navbar">
        <a class = "mylogo1 myanker" style="background-color: purple;" href="/FORUM/index.php">𝕮-sOLUTION</a>
        <a class ="respnse myanker" href="/FORUM/index.php">Home</a>
        <a class ="respnse myanker" href="/FORUM/about.php">About</a>
        <div class="dropdown">
        <p class="dropbtn" onclick= "myFunction()" >Catagories▼
        </p>
        <div id="myDropdown" class="dropdown-content">';

        $sql = "SELECT catagories_name, catagories_id FROM `catagories` LIMIT 5";
        $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                echo'
                <a href="/FORUM/threadlist.php?catid='.$row['catagories_id'].'">'.$row['catagories_name'].'</a>
                ';
            }

        echo'
        </div>
        </div>
        <a class ="respnse myanker" href="/FORUM/contact.php">Contact</a>
        ';
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            if ($_SESSION['email'] == "admin@gmail.com") {
                echo '
                <a class ="respnse myanker" href="/FORUM/partials/admin.php">Admin</a>
                ';
            }
        }
    echo '
    </div>
    <div id="left">
        <div id="bar" onclick="myFunction2()">
            <div id = "rectangle">
            <div class="rectangle"></div>
            <div class="rectangle"></div>
            <div class="rectangle"></div>
            </div>
            <div id = "cross"><b>✖</b>
            </div>
        </div>

        <form action="/FORUM/search.php" method = "get">
        <input id= "searchform" class="yu" name="search" type="text" placeholder="Search.......">
        <button class="yu" type="submit">Search</button>
        </form>
        ';

        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            echo'
            <h4 class = "h4">Welcome to 𝕮-sOLUTION </h4>
            <a class="myclass" id ="logout" onclick="return question()" href="/FORUM/partials/_logout.php">Logout</a>
            ';
        }

        else {
            echo'
            <a class = "myclass" href="/FORUM/partials/_login.php">Login</a>
            <a class = "myclass" href="/FORUM/partials/_signup.php">Signup</a>';
        }
        echo'
    </div>
</nav>
</body>
</html>
';
