<?php
require_once "./connect.inc.php";

// this is to update someone from follow to following
$sql = "UPDATE `Followers`
        SET follow_id = 0
        WHERE unique_number = '" . $_GET["unique_number"] . "'";

if (mysqli_query($con, $sql)) {
    echo "Record updated successfully";
    header("Location: ../content/social.php");
} else {
    echo "Error updating record: " . mysqli_error($con);
}
?>
