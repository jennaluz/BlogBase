<?php require "../include/connect.inc.php"; ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, intitial-scale=1">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <link rel="stylesheet" href="./css/styles.css">

        <title>BlogBase</title>
    </head>

    <body>
        <div class="header">
            <?php include "./views/header.php" ?>
        </div>
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
    <script src="./js/script.js"></script>
</html>
