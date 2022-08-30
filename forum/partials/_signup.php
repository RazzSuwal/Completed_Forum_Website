<?php include '_header.php'; ?>
<?php
$showAlert = false;
$showError = false;
$showError2 = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '_dbconnect.php';
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    // Check whether this username exists
    $existSql = "SELECT * FROM `user` WHERE email = '$email'";
    $result = mysqli_query($conn, $existSql);
    $numExistRows = mysqli_num_rows($result);
    if ($numExistRows > 0) {
        // $exists = true;
        $showError2 = true;
    } else {
        // $exists = false; 
        if (($password == $cpassword)) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `user` ( `email`, `password`, `dt`) VALUES ('$email', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $showAlert = true;
            }
        } else {
            $showError = true;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="/FORUM/css/style_form.css">
    <script src="/FORUM/partials/script.js"></script>
</head>

<body>
    <div id="myform">
        <p class="my_para1"> <b> SIGN UP</b> <br> Register your own account, it's quick and easy. </p>
        <form class="form1" name="register" action="_signup.php" onsubmit="return func()" method="post">
            <div>
                <label for="email">Email:</label>
            </div>
            <input type="email" name="email" id="email" placeholder="Enter valid email">
            <br><br>
            <div>
                <label for="password">Password: </label>
            </div>
            <input type="password" name="password" id="password" placeholder="Enter strong password">
            <br><br>
            <div>
                <label for="cpassword">Confirm Password: </label>
            </div>
            <input type="password" name="cpassword" id="cpassword">
            <div>
                <small>Make sure you have type same password</small>
            </div>
            <br>

            <div>
                <button class="buttom" type="submit">Sign Up</button>
            </div>
            <br>
            <a class="users" href="/FORUM/partials/_login.php">Alerady have account</a>

        </form>
    </div>
    <?php
    if ($showAlert) {
        echo '<script> alert("Form have submitted succesfully ,please login your account"); </script';
    }
    if ($showError) {
        echo '<script> alert("password donot match"); </script';
    }
    if ($showError2) {
        echo '<script> alert("username is already taken"); </script';
    }
    ?>
    <?php include "_footer.php"; ?>
</body>

</html>