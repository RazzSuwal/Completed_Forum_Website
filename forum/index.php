<?php include 'partials/_header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>𝕮-sOLUTION</title>
</head>
<link rel="stylesheet" href="css/homestyle.css">

<body id="blur">
    <?php include 'partials/_dbconnect.php'; ?>
    <div id="container">
        <div class="s_description">
            <h1>
                Let's Discuss Our Problems.
            </h1>
            <h2>Let's Discuss Our Problems.</h2>
        </div>
        <!-- <img id="codeimg" src="image/coding1.jpg" alt="#"> -->
    </div>
    <h2 class="heading">𝕮-sOLUTION>Browse Catagories</h2>

    <div id="row">
        <!-- Fetch all the catagories -->
        <?php $sql = "SELECT * FROM `catagories`";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $id =  $row['catagories_id'];
            $cat =  $row['catagories_name'];
            $dog =  $row['catagories_desc'];
            echo '
            <a href="threadlist.php?catid=' . $id . '">
            <div class="card">
            <img id = "cardimg" src="image/' . $cat . '.png" alt="loading....">
            <div class="card-body">
            <h2> <a class = "ahover" href = "threadlist.php?catid=' . $id . '">' . $cat . ' </a> </h2>
            <p>' . substr($dog, 0, 90) . '.....</p>
            <a class = "bootn" href="threadlist.php?catid=' . $id . '">View Threads</a>
            </div>
            </div></a>';
        }

        ?>
    </div>
    <?php
    if (isset($_GET['loginsucess']) && $_GET['loginsucess'] == "true") {
        echo '<script> alert("SUCESS! login sucessfuly") </script>';
    }
    ?>
    <div id="about">
        <div id="imagepart">
            <img src="image/myart.jpg" width="500" height="390">
        </div>
        <section>
            <br><br>
            <h1> <a href="about.php" class="ACheading">About Us</a></h1>
            <p class="aboutpara">Since beginning of my jounery in Bachelor on Computer Application(BCA), I always feel like there is lack of mentor. Solution of errors, bugs and other problems in my code is hard to slove. So i always feel like there should be website where I can communicate with my college teachers, seniors, friends and juniors. And as introduces of our first project in fourth semester, at first I have no idea of what project should be. Then I decided why shouldn't  I create a website where I can discuss about it. So I create a website name 𝕮-sOLUTION where '𝕮' mean Code and 'sOLUTION' means it's remedy....</p>
            <a id="seemore" href="about.php">See More</a>
        </section>
    </div>
    <section>
        <h1> <a href="contact.php" class="ACheading">Our Contact</a></h1>
        <p class="aboutpara">If you have any feedback about our website please be free to contact us. We will take it seriouly and try to improve accordingly. This contact is especially desgin to make direct communication between adimin and user so if you have any feedback be free to contact. You can contact us by using form which are in the contact page or if you have personal question with adimin visit their social media...</p>
    </section>
  
    <?php include 'partials/bigfooter.php'; ?>
    <?php include 'partials/_footer.php'; ?>
    
</body>

</html>