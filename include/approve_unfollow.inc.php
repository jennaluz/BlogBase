<?php
//include_once('logic.php');
include_once "./connect.inc.php";
$sql = "UPDATE social_follow SET follow_id=1 WHERE unique_number='" . $_GET["unique_number"] . "'";
if (mysqli_query($con, $sql)) {
    echo "Record updated successfully";
    header("Location: ../content/social.php");
} else {
    echo "Error updating record: " . mysqli_error($con);
}
//this is to update someone from following to follow
?>