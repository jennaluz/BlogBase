<?php
include_once "../include/user_info.inc.php";

if (isset($_REQUEST['create_article'])) {
    $title = $_REQUEST['title'];
    $content = $_REQUEST['article_draft'];
    $description = substr($content, 0, 253);
    $author_id = $user_info['user_id'];

    $query = "INSERT INTO Articles (author_id, title, description, content)
            VALUES ('$author_id', '$title', '$description', '$content')";
    mysqli_query($con, $query);
}
?>
