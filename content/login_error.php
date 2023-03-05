<html lang="eng">
<?php require "../include/connect.inc.php"; ?>
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

        <br>
        <center>
          <h3>ERROR: Incorrect Username or Password<br>Or<br>You are trying to log into the system too soon after account creation.</h3>
          <br>
          <h3>Click <a href="./login.php">here</a> to login again<br>or<br>Click <a href="./index.php">here</a> to return to home.</h3>
        </center>
        <script src="./js/script.js"></script>

    </body>
</html>
