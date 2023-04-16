<?php
require_once "../include/connect.inc.php";
include_once "../include/user_info.inc.php";

$action = $_POST['action'];
$article_id = $_POST['id'];

if ($action == "save") {
    $update_saved = "INSERT INTO SavedArticles (article_id, user_id)
                     VALUES ('" . $article_id . "', '" . $user_info['user_id'] . "')";
    $result = mysqli_query($con, $update_saved);
    if ($result) {
        echo true;
    } else {
        echo false;
    }
} else if ($action == "unsave") {
    $update_saved = "DELETE
                     FROM SavedArticles
                     WHERE article_id = '" . $article_id . "' AND user_id = '" . $user_info['user_id'] . "'";
    $result = mysqli_query($con, $update_saved);
    if ($result) {
        echo true;
    } else {
        echo false;
    }
} else {
    echo false;
}
