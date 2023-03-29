<?php
require_once "./connect.inc.php";
include_once "./user_info.inc.php";

$return_page = "create.php";

if ($user_info['writer'] == false) {
    echo "You can't do this!";
}

if (isset($_POST['create_article'])) {
    $article_id = $_GET['id'];
    $user_id = $user_info['user_id'];

    $title = $_POST['title'];
    $content = $_POST['article_draft'];
    $description = substr($content, 0, 253);
    $submitted = 1;

    if ($article_id == -1) {
        $query = "INSERT INTO Articles (author_id, title, description, content, submitted)
                  VALUES ('$user_id', '$title', '$description', '$content', '$submitted')";
    } else {
        $query = "UPDATE Articles
                  SET title = '$title', description = '$description', content = '$content', submitted = '$submitted'
                  WHERE author_id = $user_id AND article_id = $article_id";
    }

    mysqli_query($con, $query);
    $return_page = "article.php?id=$article_id";
}

if (isset($_POST['save_article'])) {
    $article_id = $_GET['id'];
    $user_id = $user_info['user_id'];

    $title = $_POST['title'];
    $content = $_POST['article_draft'];
    $description = substr($content, 0, 253);
    $submitted = 0;

    if ($article_id == -1) {
        $query = "INSERT INTO Articles (author_id, title, description, content, submitted)
                  VALUES ('$user_id', '$title', '$description', '$content', '$submitted')";
    } else {
        $query = "UPDATE Articles
                  SET title = '$title', description = '$description', content = '$content', submitted = '$submitted'
                  WHERE author_id = $user_id AND article_id = $article_id";
    }

    mysqli_query($con, $query);
    $return_page = "writer.php";
}

header("Location: ../content/$return_page");
?>
