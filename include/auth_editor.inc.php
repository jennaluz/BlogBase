<?php
    session_start();
    if(!isset($_SESSION["username"])) {
        header("Location: ../content/design.php");
        header("Location: ../content/need_to_sign_in.php");
        exit();
    }

?>
