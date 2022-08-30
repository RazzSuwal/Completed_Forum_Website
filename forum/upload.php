<?php
if(isset($_POST['submit'])){
$currentDirectory = getcwd();
$uploadDirectory = "/image/";

$errors = []; // Store errors here

$fileExtensionsAllowed = ['png']; // These will be the only file extensions allowed 

$fileName = $_FILES['the_file']['name'];
$fileSize = $_FILES['the_file']['size'];
$fileTmpName  = $_FILES['the_file']['tmp_name'];
$fileType = $_FILES['the_file']['type'];
$fileExtension = strtolower(end(explode('.', $fileName)));

$uploadPath = $currentDirectory . $uploadDirectory . basename($fileName);

if (isset($_POST['submit'])) {

  if (!in_array($fileExtension, $fileExtensionsAllowed)) {
    $errors[] = "This file extension is not allowed. Please upload a PNG file";
  }

  if ($fileSize > 4000000) {
    $errors[] = "File exceeds maximum size (4MB)";
  }

  if (empty($errors)) {
    $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

    if ($didUpload) {
      echo "The file " . basename($fileName) . " has been uploaded";
      
    } else {
      echo "An error occurred. Please contact the administrator.";
    }
  } else {
    foreach ($errors as $error) {
      echo $error . "These are the errors" . "\n";
    }
  }
}
}
?>
<!-- <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>PHP File Upload</title>
</head>

<body>
  <form action="/FORUM/upload.php" method="post" enctype="multipart/form-data" name="submit">
    Upload a Photo:
    <input type="file" name="the_file" id="fileToUpload">
    <div>
      <small class="san">Make sure you have similar photo name to the category name</small>
    </div>
    <input type="submit" name="submit" value="Upload">
    <br><br>
  </form>
</body>

</html>
<style>
  small {
    color: red;
  }
</style> -->