<?php
require_once "./connect.inc.php";

$sql = "UPDATE Users
        SET approved = 1
        WHERE user_id = '" . $_GET["id"] . "'";

if (mysqli_query($con, $sql)) {
    echo "Record updated successfully";
    header("Location: ../content/admin.php");
} else {
    echo "Error updating record: " . mysqli_error($con);
}
?>
