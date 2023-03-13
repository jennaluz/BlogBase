<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: ../content/social.php");
    header("Location: ../content/need_to_sign_in.php");
    exit();
}
?>
