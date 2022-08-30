<?php include '_header.php' ?>
<?php include '_dbconnect.php' ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Control Panel</title>
</head>
<link rel="stylesheet" href="/FORUM/css/style_admin.css">
<script src="script.js"></script>

<body>
    <div class="container">
        <table>
            <h1>Catagories</h1>
            <tr>
                <th>ID</th>
                <th>Catagories Name</th>
                <th>Description</th>
                <th>TimeStamp</th>
                <th>Edit|Delete</th>
            </tr>
            <?php
            $sql = "SELECT * FROM `catagories`";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
                $id =  $row['catagories_id'];
                $name =  $row['catagories_name'];
                $desc =  $row['catagories_desc'];
                $time =  $row['dt'];

                //display
                echo '
                    <tr>
                        <td>' . $id . '</td>
                        <td>' . $name . '</td>
                        <td>' . $desc . '</td>
                        <td>' . $time . '</td>
                        <td> <button class="upAndDelt" ><a href="edit.php?catid=' . $id . '&name=catagories">Edit</a></button>
                        <button class="upAndDelt" onclick="return question()" ><a href="delete.php?catid=' . $id . '&name=catagories">Delete</a></button></td>
                    </tr>   
                ';
            }
            ?>
        </table>


        <div id="myform">
            <h2>Upload New Catagories</h2>
            <form action="/FORUM/upload.php" method="post" enctype="multipart/form-data" name="submit">
                Upload a Photo:
                <input type="file" name="the_file" id="fileToUpload">
                <div>
                    <small class="san">Make sure your photo have similar name to category name</small>
                </div>
                <input type="submit" name="submit" value="Upload">
                <br><br>
            </form>

            <form name="register" action="<?php $_SERVER["REQUEST_URI"] ?>" method="POST" onsubmit="return func3()">
                <div>
                    <label for="title">Catagories Name:</label>
                </div>
                <input type="text" name="catagories_name" id="title">
                <br>
                <div>
                    <label for="desc">Description: </label>
                </div>
                <textarea name="catagories_desc" id="desc" cols="110" rows="5"></textarea>
                <br>
                <div>
                    <button class="buttom" type="submit"> Submit</button>
                    <button class="buttom" type="reset">Reset</button>
                </div>
            </form>
        </div>
    </div>
    <?php
    $show = false;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['catagories_name'];
        $desc = $_POST['catagories_desc'];
        $sql = "INSERT INTO `catagories` (`catagories_id`, `catagories_name`,`catagories_desc`, `dt`) VALUES (NULL, '$name', '$desc', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $show = true;
        }
    }
    ?>
    <?php
    if ($show) {
        echo '<script> alert("You have add new catagories please upload a photo") </script>';
    }
    ?>
    <?php include '_footer.php' ?>
</body>

</html>