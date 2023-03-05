<?php
require "../include/connect.inc.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Blogbase - Sign Up</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, inital-scale=1">
        <link rel="stylesheet" href="./css/styles.css">
    </head>
    <body>
      <nav class="flex-div">
        <?php include "./views/header.php" ?>
      </nav>
      <div class="sidebar">
        <?php include "./views/sidebar.php" ?>
      </div>
      <br><br>
      <center>
        <p><h3>That username has already been used.</h3></p>
        <br>
        <p><h3>Would you like to register <a href="./register.php">again?</a><br>Or<br>Would you like to <a href="./index.php">return</a> to home?</h3></p>
      </center>
    </body>
</html>
