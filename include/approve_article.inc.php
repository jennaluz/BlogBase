<?php
//include_once('logic.php');
include_once "./connect.inc.php";

$sql = "UPDATE blog_posts SET is_approved=1 WHERE postID='" . $_GET["postID"] . "'";
if (mysqli_query($con, $sql)) {
    echo "Record updated successfully";
    header("Location: ../content/design.php");
} else {
    echo "Error updating record: " . mysqli_error($con);
}
?>
