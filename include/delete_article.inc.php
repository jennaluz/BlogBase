<?php
require_once "./connect.inc.php";
include_once "./user_info.inc.php";

if ($user_info['writer'] == false) {
    echo "You can't delete this!";
}

$requested_id = $_GET['id'];
$query = "DELETE FROM Articles
          WHERE article_id = $requested_id";
$result = mysqli_query($con, $query);

if ($result) {
    $return_page = $_GET['return_page'];

    header("Location: ../content/$return_page");
} else {
    echo "Error deleting article" . mysqli_error($con);
}
?>
