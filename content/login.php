<?php require_once "../include/connect.inc.php"; ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, inital-scale=1">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
        <link rel="stylesheet" href="./css/styles.css">
        <link rel="stylesheet" href="./css/enter.css">

        <title>BlogBase Login</title>
    </head>

    <body>
        <nav class="flex-div">
            <?php include "./views/header.php" ?>
        </nav>
        <div class="sidebar">
            <?php include "./views/sidebar.php" ?>
        </div>

        <div class="container mt-5 mb-3 text-center">
            <h1 class="display-3">BlogBase</h1>
        </div>
        <?php
        if (isset($_POST['username'])) {
            $username = stripslashes($_REQUEST['username']);
            $username = mysqli_real_escape_string($con, $username);
            $password = stripslashes($_REQUEST['password']);
            $password = mysqli_real_escape_string($con, $password);

            $query = "SELECT * 
                      FROM `users` 
                      WHERE username='$username' AND password='" .md5($password) . "' AND is_approved!=0";
            $result = mysqli_query($con, $query) or die(mysql_error());
            $rows = mysqli_num_rows($result);

            if ($rows == 1) {
                $_SESSION['username'] = $username;
                header("Location: ./index.php");
            } else{
                header("Location: ./login_error.php");
            }
        } else{
        ?>

        <div class="row">
            <div class="col"></div>
            <div class="col-5">
                <form method="post" name="login">
                    <div class="mt-2 mb-3">
                        <label for="username">Username</label>
                        <input class="form-control" type="text" id="username" name="username" required />
                    </div>
                    <div class="mt-2 mb-4">
                        <label for="password">Password</label>
                        <input class="form-control" type="password" id="password" name="password" required />
                    </div>
                </form>

                <div class="row">
                    <div class="col-auto">
                        <button class="btn btn-outline-dark mb-2" type="submit" name="submit">Login</button>
                    </div>
                    <div class="col-auto pt-2">
                        <p>Don't have an account?&emsp;<a href="./register.php">Register Now</a></p>
                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>
        <?php
        }
        ?>

        <script src="./js/script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    </body>
</html>
