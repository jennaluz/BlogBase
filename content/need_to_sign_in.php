<?php include "../include/connect.inc.php"; ?>

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
