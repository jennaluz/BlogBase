<?php
session_start();

// destroy session
if(session_destroy()) {
    // redirect to homepage
    header("Location: ../content/logout.php");
}
?>
