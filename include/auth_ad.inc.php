<?php
    session_start();

    if(!isset($_SESSION["username"])) {
        header("Location: ../content/ads.php");
        header("Location: ../content/need_to_sign_in.php");
        exit();
    }
?>
