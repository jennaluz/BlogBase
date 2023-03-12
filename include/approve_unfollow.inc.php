<?php
require_once "./connect.inc.php";

// this is to update someone from following to follow
$sql = "UPDATE `Followers`
        SET follow_id = 1
        WHERE unique_number = '" . $_GET["unique_number"] . "'";

if (mysqli_query($con, $sql)) {
    echo "Record updated successfully";
    header("Location: ../content/social.php");
} else {
    echo "Error updating record: " . mysqli_error($con);
}
?>
