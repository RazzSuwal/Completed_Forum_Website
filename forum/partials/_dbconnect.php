<?php

$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'myforum';

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die ("cannot connect ");
}
// echo "connect";
?>
