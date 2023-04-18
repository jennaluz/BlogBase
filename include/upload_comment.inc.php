<?php
require_once "./connect.inc.php";
include_once "./user_info.inc.php";

$article_id = $_POST['article_id'];
$parent_id = $_POST['parent_id'];
$submitter_id = $user_info['user_id'];
$content = $_POST['content'];

if ($submitter_id == null) {
    $submitter_id = "null";
}

if (isset($article_id) && isset($content)) {
    $upload_comment  = "INSERT INTO Comments (article_id, parent_id, submitter_id, content)
                        VALUES ($article_id, $parent_id, $submitter_id, ?)";

    $result = mysqli_execute_query($con, $upload_comment, [$content]);
    if ($result) {
        echo true;
    } else {
        echo false;
    }
} else {
    echo false;
}
