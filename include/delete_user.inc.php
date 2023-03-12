<?php
include_once "./connect.inc.php";

$sql = "DELETE FROM `Users`
        WHERE userid = '" . $_GET["userid"] . "'";

if (mysqli_query($con, $sql)) {
    header("Location: ../content/admin.php");
} else {
    echo "Error deleting record: " . mysqli_error($con);
}
?>
