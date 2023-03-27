<?php
require_once "./connect.inc.php";
include_once "./user_info.inc.php";

if (isset($_GET['return_page'])) {
    $return_page = $_GET['return_page'];
} else {
    $return_page = "index.php";
}
if (isset($_GET['save_id'])) {
    // requesting to save an article
    $requested_id = $_GET['save_id'];
    $update_saved = "INSERT INTO SavedArticles (article_id, user_id)
                     VALUES ('" . $requested_id . "', '" . $user_info['user_id'] . "')";
} else if (isset($_GET['unsave_id'])) {
    // requesting to unsave an article
    $requested_id = $_GET['unsave_id'];
    $update_saved = "DELETE
                     FROM SavedArticles
                     WHERE article_id = '" . $requested_id . "' AND user_id = '" . $user_info['user_id'] . "'";
    echo $update_saved;
} else {
    header("Location: ../content/$return_page");
}

if (mysqli_query($con, $update_saved)) {
    //header("Location: ../content/article.php?id=" . $requested_id . "");
    if (isset($_GET['return_page'])) {
        $return_page = $_GET['return_page'];
    } else {
        $return_page = "article.php?id=" . $requested_id;
    }
    header("Location: ../content/$return_page");
} else {
    echo "Error updating record: " . mysqli_error($con);
}
?>
