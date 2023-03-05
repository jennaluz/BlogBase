<?php
include "../include/connect.inc.php";
?>
<!DOCTYPE html>
<html lang="eng">
    <head>
        <meta charset="utf-8">
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
      <br><br>
        <center>
          <h3><p>You have logged out successfully.</p></h3>
          <br>
          <h3><p>Would you like to return to the <a href="./index.php">home</a> page?</p></h3>
        </center>
    </body>
    <script src="./js/script.js"></script>
</html>
