<?php
require_once "../include/connect.inc.php";
include_once "../include/user_info.inc.php";

ob_start();

if ($user_info) {
    header("Location: ./index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, inital-scale=1">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
        <link rel="stylesheet" href="./css/styles.css">
        <link rel="stylesheet" href="./css/enter.css">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

        <title>BlogBase Login</title>
    </head>

    <body>
        <div class="container mt-5 mb-3 text-center">
            <h1>
                <a class="text-decoration-none text-reset" href="./index.php">BlogBase</a>
            </h1>
        </div>

        <?php
        if (isset($_POST['username'])) {
            $username = stripslashes($_REQUEST['username']);
            $username = mysqli_real_escape_string($con, $username);
            $password = stripslashes($_REQUEST['password']);
            $password = mysqli_real_escape_string($con, $password);

            $query = "SELECT *
                      FROM `Users`
                      WHERE username = ? AND approved != 0";
            $result = mysqli_execute_query($con, $query, [$username]);
            $rows = $result->num_rows;

            if ($rows == 1) {
                $requested_user = $result->fetch_assoc();
                if (password_verify($password, $requested_user['password'])) {
                    $_SESSION['username'] = $username;
                    header("Location: ./index.php");
                    die();
                }
            }
            header("Location: ./login_error.php");
            ob_end_flush();
        } else { ?>
            <div class="col-10 col-lg-5  mx-auto">
                <form method="post" name="login">
                    <div class="mt-2 mb-3">
                        <label for="username">Username</label>
                        <input class="form-control" type="text" id="username" name="username" required />
                    </div>
                    <div class="mt-2 mb-4">
                        <label for="password">Password</label>
                        <input class="form-control" type="password" id="password" name="password" required />
                    </div>
                    <div class="row">
                        <div class="col-auto">
                            <button class="btn btn-outline-dark mb-2" type="submit" name="submit">Login</button>
                        </div>
                        <div class="col-auto pt-2">
                            <p>Don't have an account?&emsp;<a href="./register.php">Register Now</a></p>
                        </div>
                    </div>
                </form>
            </div>
        <?php
        }
        ?>

    </body>
</html>
