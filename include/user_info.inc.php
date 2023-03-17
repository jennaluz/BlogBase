<?php
session_start();

if (isset($_SESSION['username'])) {
    $user_query = "SELECT *
                   FROM Users
                   WHERE username = '" . $_SESSION['username'] . "';";
    $user_result = mysqli_query($con, $user_query);
    $user_info = $user_result->fetch_assoc();

    $_SESSION['user_info'] = $user_info;
}
?>
