<?php
include_once "./connect.inc.php";

$realSaveID = $_GET["saveID"];
$sql = "UPDATE `SavedArticles`
        SET saved = 1
        WHERE saved_id = '" . $_GET["saveID"] . "'";

if (mysqli_query($con, $sql)) {
    $info = "SELECT article_id FROM `SavedArticles`
            WHERE saveID = '$realSaveID'";
    $getInfo = $con->query($info);
    $realPostID = $getInfo->fetch_assoc();

    header("Location: ../content/post1.php?id=" . $realPostID["postID"] . "");
} else {
    echo "Error updating record: " . mysqli_error($con);
}
?>
