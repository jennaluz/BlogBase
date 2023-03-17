<?php
require_once "./connect.inc.php";

if (isset($_GET['save_id'])) {
    // requesting to save an article
    $requested_id = $_GET['save_id'];
    $update_saved = "UPDATE SavedArticles
                     SET saved = 1
                     WHERE saved_id = '" . $requested_id . "'";
} else {
    // requesting to unsave an article
    $requested_id = $_GET['unsave_id'];
    $update_saved = "UPDATE SavedArticles
                     SET saved = 0
                     WHERE saved_id = '" . $requested_id . "'";
}

if (mysqli_query($con, $update_saved)) {
    header("Location: ../content/article.php?id=" . $requested_id . "");
} else {
    echo "Error updating record: " . mysqli_error($con);
}
?>
