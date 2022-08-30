<?php
$showAlert = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'partials/_dbconnect.php';
    $email = $_POST["email"];
    $details = $_POST["details"];
    $sql = "INSERT INTO `contact` (`email`, `details`, `dt`) VALUES ('$email', '$details', current_timestamp())";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $showAlert = true;
    }
}
?>

<?php include 'partials/_header.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="/FORUM/css/style_form.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    <?php
    if ($showAlert) {
        echo '<script> alert("Your form hasbeen submited") </script>';
    }

    ?>
    <div id="myform" class="contact">
        <p class="my_para"> <b>Contact Us</b> <br> If you have any feedback about our website please be free to         contact us. We will take
            it seriouly and try to improve accordingly. This contact form is especially desgin to make direct communication between admin and user so if you have any feedback and report about website or users be free to contact us by help of this form. Or if you have personal question about website and adimin visit oue website social medias that are given below. We will imporve as the useful feedback you provided. <br>
            Email: <a href="mailto: C-sOLUTIONForum@gmail.com">C-sOLUTIONForum@gmail.com</a><br>
            Other: <a href="https://www.facebook.com/razz.suwal.5" target="_blank" class="fa fa-facebook"></a>
                    <a href="https://www.linkedin.com/in/razz-suwal-977a72209" target="_blank" class="fa fa-linkedin"></a>
                    <a href="https://www.instagram.com/rax_xzz/?hl=en" class="fa fa-instagram"></a>
                    <a href="#" class="fa fa-twitter"></a>
        </p>
        <form class="form1" name="register" action="contact.php" onsubmit="return func5()" method="POST">
            <div>
                <label for="email">Email:</label>
            </div>
            <input type="email" name="email" id="email"  placeholder = "Enter valid email">
            <br><br>
            <div>
                <label for="details">Enter Details: </label>
            </div>
            <textarea name="details" id="details" cols="30" rows="10" placeholder = "Ellaborate your description"></textarea>
            <br><br>
            <div>
                <button class="buttom" type="submit">Submit</button>
            </div>
        </form>
    </div>
    <?php include 'partials/_footer.php'; ?>

</body>

</html>