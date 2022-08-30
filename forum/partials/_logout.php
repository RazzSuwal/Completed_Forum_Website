<?php

session_start();
session_unset();

session_destroy();
header ("location: /FORUM/index.php");
exit;



?>