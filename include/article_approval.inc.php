<?php
require_once "./connect.inc.php";
include_once "./user_info.inc.php";

if ($user_info['designer'] == true) {
    if (isset($_GET['approve_id'])) {
        // requesting to approve article
        $requested_id = $_GET['approve_id'];
        $approval_query = "UPDATE Articles
                           SET approved = 1
                           WHERE article_id = '" . $requested_id . "'";
    } else if (isset($_GET['deny_id'])) {
        // requesting to deny article
        // the designer should be able to send a message to the writer explaining why it was denied
        $requested_id = $_GET['deny_id'];
        $approval_query = "UPDATE Articles
                           SET approved = 0, submitted = 0
                           WHERE article_id = $requested_id";
    } else if (isset($_GET['revoke_id'])) {
        // requesting to revoke the approval of an article
        // the designer should be able to send a message to the write explaining why it was revoked
        $requested_id = $_GET['revoke_id'];
        $approval_query = "UPDATE Articles
                           SET approved = 0
                           WHERE article_id = '" . $requested_id . "'";
    } else {}

    $approval_result = mysqli_query($con, $approval_query);

    if ($approval_result) {
        if (isset($_GET['return_page'])) {
            $return_page = $_GET['return_page'];
        } else {
            $return_page = "article.php?id=" . $requested_id;
        }

        header("Location: ../content/$return_page");
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }
} else {
    // send to "you don't have access" page
    echo "You can't do that!";
}
?>
