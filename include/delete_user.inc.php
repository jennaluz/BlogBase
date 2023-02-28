<?php
//include_once('logic.php');
include_once "./connect.inc.php";
$sql = "DELETE FROM users WHERE userid='" . $_GET["userid"] . "'";
if (mysqli_query($con, $sql)) {
    header("Location: admin.php");
} else {
    echo "Error deleting record: " . mysqli_error($con);
}
?>
