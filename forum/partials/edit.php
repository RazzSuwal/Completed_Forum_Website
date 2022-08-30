<?php
include "_dbconnect.php";
//  for edit threads
$name = $_GET['name'];
if ($name == 'thread') {
    if (isset($_POST['done'])) {
        $idt = $_GET['threadid'];
        $id = $_GET['catid'];
        $th_title = $_POST["title"];
        $th_desc = $_POST["desc"];
        // to replace charaters which stop user to run script
        $th_title = str_replace("<", "&lt;", $th_title);
        $th_title = str_replace(">", "&gt;", $th_title);
        $th_desc = str_replace("<", "&lt;", $th_desc);
        $th_desc = str_replace(">", "&gt;", $th_desc);
        $sql = "UPDATE threads SET `threads_title` = '$th_title', `threads_desc` = '$th_desc.' WHERE `threads`.`threads_id` = $idt";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("location: /FORUM/threadlist.php?catid= $id");
        }
    }
}
//  for edit comments
else if ($name == 'comment') {
    if (isset($_POST['done'])) {
        $id = $_GET['commentid'];
        $idt = $_GET['threadid'];
        $the_desc = $_POST["comment"]; 
        $the_desc = str_replace("<", "&lt;", $the_desc);
        $the_desc = str_replace(">", "&gt;", $the_desc);
        $sql = "UPDATE comments SET `comment_content` = '$the_desc' WHERE `comment_id` = $id";
        mysqli_query($conn, $sql);
        header("location: /FORUM/comments.php?threadid= $idt");
    }
}
//for catagories
else if ($name == 'catagories') {
    if (isset($_POST['done'])) {
        $id = $_GET['catid'];
        $name = $_POST["name"];
        $desc = $_POST["desc"];
        $sql = "UPDATE catagories SET `catagories_name` = '$name', `catagories_desc` = '$desc.' WHERE `catagories`.`catagories_id` = $id";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("location: /FORUM/partials/admin.php");
        }
    }
}
?>
<?php include '_header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
</head>
<link rel="stylesheet" href="/FORUM/css/style_threadslist.css">
<script src="script.js"></script>

<body>
    <div id="edit">
        <div id="myform">
            <h1>Edit Form</h1>
            <form name="register" method="post" onsubmit="return func3()">
            <?php
            // edit threads form
                if ($name == 'thread') {
                    $idt = $_GET['threadid'];
                    $sql = "SELECT * FROM `threads` WHERE threads_id = $idt";
                    $row = mysqli_fetch_assoc(mysqli_query($conn, $sql));
                    $title =  $row['threads_title'];
                    $desc =  $row['threads_desc'];
                    echo'
                    <label for="title">Edit Your Title:</label>
                    <div>
                    <textarea <input type="text" name="title" id="title" >'.$title.'</textarea>
                    </div>
                    <small class="san">Keep your question short and crisp as possible</small>
                    <br>
                    <label for="desc">Edit Your Description: </label>
                    <div>
                        <textarea name="desc" id="desc" cols="110" rows="5">'.$desc.'</textarea>
                    </div>';
                }
                // edit comments form 
                else if ($name == 'comment') {
                    $id = $_GET['commentid'];
                    $sql = "SELECT comment_content FROM comments WHERE comment_id = $id";
                    $row = mysqli_fetch_assoc(mysqli_query($conn, $sql));
                    $c_desc = $row['comment_content'];
                    echo'
                    <label for="comment">Type Your Comment: </label>
                    <div>
                    <textarea name="comment" id="comment" cols="110" rows="5">'.$c_desc.'</textarea>
                    </div>
                ';
                }
                // edit catagories form
                else if ($name == 'catagories') {
                    $id = $_GET['catid'];
                    $sql = "SELECT * FROM `catagories` WHERE catagories_id = $id";
                    $row = mysqli_fetch_assoc(mysqli_query($conn, $sql));
                    $name =  $row['catagories_name'];
                    $desc =  $row['catagories_desc'];
                    echo'
                    <label for="name">Edit Catagories Name:</label>
                    <div>
                    <textarea <input type="text" name="name" id="name" >'.$name.'</textarea>
                    </div>
                    <br>
                    <label for="desc">Edit Your Description: </label>
                    <div>
                        <textarea name="desc" id="desc" cols="110" rows="5">'.$desc.'</textarea>
                    </div>';
                }
            ?>
                <div>
                    <button class="buttom" type="submit" name="done" onclick="return question()"> Submit</button>
                    <button class="buttom" type="reset">Reset</button>
                </div>

            </form>
        </div>
    </div>
</body>

</html>