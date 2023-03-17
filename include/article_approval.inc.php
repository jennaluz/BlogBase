<?php
require_once "./connect.inc.php";
include_once "./user_info.inc.php";

if ($user_info['designer'] == true) {
    if (isset($_GET['approve_id'])) {
        // requesting to approve article
        $requested_id = $_GET['approve_id'];
        $update_approval = "UPDATE Articles
                            SET approved = 1
                            WHERE article_id = '" . $requested_id . "'";
    } else if (isset($_GET['deny_id'])) {
        // requesting to deny article
        // the designer should be able to send a message to the writer explaining why it was denied
        $requested_id = $_GET['deny_id'];
        $update_approval = "UPDATE Articles
                            SET approved = 0
                            WHERE article_id = '" . $requested_id . "'";
    } else if (isset($_GET['revoke_id'])) {
        // requesting to revoke the approval of an article
        // the designer should be able to send a message to the write explaining why it was revoked
        $requested_id = $_GET['revoke_id'];
        $update_approval = "UPDATE Articles
                            SET approved = 0
                            WHERE article_id = '" . $requested_id . "'";
    } else {
    }

    if (mysqli_query($con, $update_approval)) {
        header("Location: ../content/article.php?id=" . $requested_id . "");
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }
} else {
    // send to "you don't have access" page
    echo "You can't do that!";
}
?>
