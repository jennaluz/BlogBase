<?php
    session_start();
    if(!isset($_SESSION["username"])) {
        header("Location: ../content/profile.php");
        header("Location: ../content/need_to_sign_in.php");
        exit();
    }

?>
