<?php
$showError0 = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '_dbconnect.php';
    $email = $_POST["email"];
    $password = $_POST["password"];
    // $sql = "SELECT * from user where username = '$username' AND password = '$password'";
    // check the email
    $sql = "SELECT * from user where email = '$email'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1) {
        while ($row = mysqli_fetch_assoc($result)) {
            {
                if (password_verify($password, $row['password'])) {
                    //session start hunxa aaba-->session is similar to cookies but it store in server site and it is more private than cookiees
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['email'] = $email;
                    $_SESSION['SN'] = $row['SN'];
                    header("location: /FORUM/index.php?loginsucess=true"); //yesle chai login vaye paxi welcome page ma pathaedinxa
                } else {
                    $showError = true;
                }
            }
        }
    } else {
        $showError0 = true;
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
    <title>Loginin</title>
    <link rel="stylesheet" href="/FORUM/css/style_form.css">
    <script src="script.js"></script>
</head>

<body>
    <?php
    if ($showError) {
        echo '<script> alert("Password Incorrect") </script>';
    }
    if ($showError0) {
        echo '<script> alert("Please signup your account first") </script>';
    }
    ?>

    <div id="myform">
        <p class="my_para1"> <b> LOG IN</b> <br> Connect with people and share your ideas. </p>
        <form class="form1" name="register" action="_login.php" onsubmit="return func1()" method='post'>
            <div>
                <label for="email">Email:</label>
            </div>
            <input type="email" name="email" id="email" placeholder = "Enter valid email">
            <br><br>
            <div>
                <label for="password">Password: </label>
            </div>
            <input type="password" name="password" id="password" placeholder = "Enter correct password">
            <div>
                <small class="san">Make sure you have type correct password</small>
            </div>
            <br>
            <div>
                <button class="buttom" type="submit">Log In</button>
            </div>
            <br>
            <a class="users" href="/FORUM/partials/_signup.php">Register new account</a>

        </form>
    </div>


    <?php include '_footer.php'; ?>
</body>

</html>