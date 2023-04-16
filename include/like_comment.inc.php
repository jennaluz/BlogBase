<?php
require_once "../include/connect.inc.php";
include_once "../include/user_info.inc.php";

$action = $_POST['action'];
$comment_id = $_POST['comment_id'];

if ($action == "like") {
    $update_saved = "INSERT INTO LikedComments (comment_id, user_id)
                     VALUES ($comment_id, '" . $user_info['user_id'] . "')";
    $result = mysqli_query($con, $update_saved);
    if ($result) {
        echo true;
    } else {
        echo false;
    }
} else if ($action == "unlike") {
    $update_saved = "DELETE
                     FROM LikedComments
                     WHERE comment_id = '$comment_id' AND user_id = '" . $user_info['user_id'] . "'";
    $result = mysqli_query($con, $update_saved);
    if ($result) {
        echo true;
    } else {
        echo false;
    }
} else {
    echo false;
}
