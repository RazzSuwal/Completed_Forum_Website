<?php include 'partials/_header.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Threads</title>
</head>
<link rel="stylesheet" href="css/style_threadslist.css">
<script src="partials/script.js"></script>

<body>
    <?php include 'partials/_dbconnect.php'; ?>
    <?php
        $id = $_GET['catid'];
        // $id = (isset($_GET['catid']));
        // echo $id;
        $sql = "SELECT * FROM `catagories` WHERE catagories_id=$id";
        $result = $conn->query($sql);
        while($row = mysqli_fetch_assoc($result)){
            // $cat_id =  $row['catagories_id'];
            $cat_name =  $row['catagories_name'];
            $cat_desc =  $row['catagories_desc'];
        }
    ?>

    <!-- for threads from submision -->
    <?php
        $show = false;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include "partials/_dbconnect.php";
            $th_title = $_POST["title"];
            $th_desc = $_POST["desc"];
            // to replace charaters which stop user to run script
            $th_title = str_replace("<", "&lt;", $th_title);
            $th_title = str_replace(">", "&gt;", $th_title);
            $th_desc = str_replace("<", "&lt;", $th_desc);
            $th_desc = str_replace(">", "&gt;", $th_desc);
            $SN = $_POST["SN"];
            $sql = "INSERT INTO `threads` (`threads_id`, `threads_title`, `threads_desc`, `threads_cat_id`, `threads_user_id`, `timestamp`) VALUES (NULL, '$th_title', '$th_desc', '$id', '$SN', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $show = true;
            }

        }
    ?>

    <?php
    if ($show) {
        echo '<script> 
        var audio = new Audio();
        audio.src = "image/sucess.mp3";
        audio.play();
         </script>';
    }
    ?>
    

    <div class="height">
        <div class="container">
            <div class="jumr">
                <h1>Welcome to <?php echo $cat_name?> Forum</h1>
                <p><?php echo $cat_desc?> </p>
                <hr style="margin: 10px 0px;">
                <p>This is the peer to peer forum. No Spam / Advertising / Self-promote in the forums. Do not post
                    copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross post
                    questions. Do not PM users asking for help</p>
            </div>
        </div>

        <div class="container">
            <h2>Ask-Questions</h2>
            <?php
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            echo '
            <div id="myform">
            <form name="register" action="'. $_SERVER["REQUEST_URI"] . '" method="post" onsubmit="return func3()">
            <label for="title">Problem Title:</label>
            <div>
            <input type="text" name="title" id="title">
            </div>
            <small class="san">Keep your question short and crisp as possible</small>
            <br>
            <label for="desc">Ellaborate Your Description: </label>
            <div>
            <textarea name="desc" id="desc" cols="110" rows="5"></textarea>
            <input type="hidden" name="SN" value ="'.$_SESSION["SN"].'">
            </div>
            <div>
            <button class="buttom" type="submit"> Submit</button>
            <button class="buttom" type="reset">Reset</button>
            </div>
            
            </form>
            </div>
            ';
        }
        else {
            echo'
            <h3>You are not login. Please login to start Discussion!</h3>';
        }
            ?>
        <h2 style = "margin-top: 20px;">Browse-Questions</h2>
        <?php
        $id = $_GET['catid'];
        $sql = "SELECT * FROM `threads` WHERE threads_cat_id = $id";
        $result = mysqli_query($conn, $sql);
        $noResult= true;
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
        $my_id = $_SESSION["SN"];}
        else{$my_id = -1;}
        while($row = mysqli_fetch_assoc($result)){
            $noResult = false;
            $id2 =  $row['threads_id'];
            $title =  $row['threads_title'];
            $desc =  $row['threads_desc'];
            $time =  $row['timestamp'];
            $user_id =  $row['threads_user_id'];
            $sql2 = "SELECT email FROM `user` WHERE SN='$user_id'";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            if($my_id == $user_id){$emailName = 'you';}
            else{$emailName = $row2['email'];}
            echo'
            <div class="media">
            <img src="image/userdefault.png" width="30px" alt="....">
            <p> -posted by <em>'. $emailName .'</em> at <em>'.$time.'</em></p>
            <div class="media-body">
            <h3> <a class = "arrange " href = "comments.php?threadid='.$id2.'"> '. $title .' </h3>
            <p> -'.$desc.'</p>
            </div>
            <a class="bootn" href="comments.php?threadid='.$id2.'">Comment</a>
            ';
            if ($emailName == 'you') {
                echo '<button class="upAndDelt" ><a href="partials/edit.php?threadid='.$id2.'&catid='.$id.'&name=thread">Edit</a></button>
                <button class="upAndDelt" onclick="return question()" ><a href="partials/delete.php?threadid='.$id2.'&catid='.$id.'&name=thread">Delete</a></button>';
            }
            echo'
            </div>
            <hr>
            ';
        }
        if ($noResult) {
            echo '
            <div class="result">
            <p> No thread found! </p>
            <p1>Be the first one to ask question.</p1>
            </div>
            ';
        }

        ?>
        
    </div>
    </div>
    
    <?php include 'partials/_footer.php'; ?>
</body>

</html>