<?php
require_once "./connect.inc.php";

$sql = "DELETE FROM `Articles`
        WHERE article_id = '" . $_GET["postID"] . "'";

if (mysqli_query($con, $sql)) {
    header("Location: ../content/design.php");
} else {
    echo "Error deleting record: " . mysqli_error($con);
}
?>
