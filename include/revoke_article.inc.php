<?php
require_once "./connect.inc.php";

$sql = "UPDATE `Articles`
        SET approved = 0
        WHERE article_id = '" . $_GET["postID"] . "'";

if (mysqli_query($con, $sql)) {
    echo "Record updated successfully";
    header("Location: ../content/design.php");
} else {
    echo "Error updating record: " . mysqli_error($con);
}
?>
