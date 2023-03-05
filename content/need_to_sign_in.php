<?php
//include 'logic.php';
include "../include/connect.inc.php";
?>
<html lang="eng">
    <head>
        <meta charset="utf-8"><!-- comment -->
        <meta name="viewport" content="width=device-width, intitial-scale=1.0">
        <title>Blog Base e-newspaper</title>
        <link rel="stylesheet" href="./css/styles.css">
    </head>

    <body>

      <nav class="flex-div">
        <?php include "./views/header.php" ?>
      </nav>

      <div class="sidebar">
        <?php include "./views/sidebar.php" ?>
      </div>



        <center>
        <br><br>
        <p><h3>You do not have access to that page.<br>Would you like to <a href="./login.php">login?</a></h3></p>
        <br>
        <p><h3>Don't have an account? <a href="./register.php">Sign up</a></h3></p>
        <br>
        <p><h3>Just want to browse?<br>Return to <a href="./index.php">home</a></h3></p>
      </center>

      <script src="./js/script.js"></script>


</body>
</html>
