<?php
require_once "./connect.inc.php";
include_once "./user_info.inc.php";

$return_page = "create.php";

if ($user_info['writer'] == false) {
    echo "You can't do this!";
}

if (isset($_POST['submit_article'])) {
    $article_id = $_GET['id'];
    $user_id = $user_info['user_id'];

    $title = $_POST['title'];
    $content = $_POST['article_draft'];
    $description = $_POST['description'];
    $submitted = 1;

    if ($article_id == -1) {
        $submit_query = "INSERT INTO Articles (author_id, title, description, content, submitted)
                         VALUES ('$user_id', '$title', '$description', '$content', '$submitted')";
    } else {
        $submit_query = "UPDATE Articles
                         SET title = '$title', description = '$description', content = '$content', submitted = '$submitted'
                         WHERE author_id = $user_id AND article_id = $article_id";
    }

    mysqli_query($con, $submit_query);
    $return_page = "article.php?id=$article_id";
} else if (isset($_POST['save_article'])) {
    $article_id = $_GET['id'];
    $user_id = $user_info['user_id'];

    $title = $_POST['title'];
    $content = $_POST['article_draft'];
    $description = $_POST['description'];
    $submitted = 0;

    if ($article_id == -1) {
        $save_query = "INSERT INTO Articles (author_id, title, description, content, submitted)
                       VALUES ('$user_id', '$title', '$description', '$content', '$submitted')";
    } else {
        $save_query = "UPDATE Articles
                       SET title = '$title', description = '$description', content = '$content', submitted = '$submitted'
                       WHERE author_id = $user_id AND article_id = $article_id";
    }

    mysqli_query($con, $save_query);
    $return_page = "writer.php";
} else if (isset($_GET['submit_article'])) {
    $article_id = $_GET['submit_article'];
    $user_id = $user_info['user_id'];

    $submit_query = "UPDATE Articles
                     SET submitted = 1
                     WHERE article_id = $article_id AND author_id = $user_id";

    mysqli_query($con, $submit_query);
    $return_page = "article.php?id=$article_id";
} else if (isset($_GET['withdraw_article'])) {
    $article_id = $_GET['withdraw_article'];
    $user_id = $user_info['user_id'];

    $withdraw_query = "UPDATE Articles
                       SET submitted = 0
                       WHERE article_id = $article_id AND author_id = $user_id";

    mysqli_query($con, $withdraw_query);
    $return_page = "writer.php";
} else {}

header("Location: ../content/$return_page");
?>
