<?php include "partials/_header.php"?>
<!-- sql query for search enable should hel@p for future -->
<!-- alter table threads add FULLTEXT(`threads_title`, `threads_desc`) -->

<!-- search query in sql
SELECT * FROM threads WHERE MATCH (threads_title, threads_desc) against ('I am'); -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <link rel="stylesheet" href="/FORUM/css/searchstyle.css">
</head>

<body>

    <?php include "partials/_dbconnect.php"?>

    <div class="container">
        <div class="boxes">
            <?php
            $noResult = true;
            $query = $_GET['search'];
            echo'<h1>Search Results for <em>"'.$query.'" </em></h1>';
            //joining 3 tables for searching
            // $sql = "SELECT c.catagories_id, c.catagories_name, c.catagories_desc, t.threads_cat_id, t.threads_id, t.threads_title, t.threads_desc, c1.thread_id, c1.comment_id, c1.comment_content FROM catagories AS c LEFT JOIN threads AS t ON c.catagories_id = t.threads_cat_id LEFT JOIN comments AS c1 ON t.threads_id = c1.thread_id WHERE `catagories_name`='$query' or `threads_title`='$query' or `threads_desc`='$query' or `comment_content`='$query'";
            $sql = "SELECT * FROM threads WHERE MATCH (threads_title, threads_desc) against ('$query')";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $title =  $row['threads_title'];
            $desc =  $row['threads_desc'];
            $thread_id =  $row['threads_id'];
            $url = "comments.php?threadid=". $thread_id;
            echo'
                <div class="result">
                <h2> <a class ="a-primary" href="'.$url.'"> '.$title.' </a></h2>
                <p>'.$desc.'</p>
                </div>
                <hr style="margin: 10px 0px;">
                ';
            }
            if ($noResult) {
                echo '
                <div class="result">
                <p class = "p-primary"> No Results Found! </p>
                <p1>It looks like there arent many great matches for your search
                Tip: Try using words that might appear on the page you’re looking for. For example, "cake recipes" instead of "how to make a cake."</p1>
                </div>
                ';
            }
            ?>
        </div>
    </div>

    <?php include "partials/_footer.php"?>
</body>

</html>